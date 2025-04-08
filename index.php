<?php

require_once 'vendor/autoload.php';

use Game\Character;
use Game\Battle;
use Game\CharacterList;
use Game\Mage;
use Game\Rogue;
use Game\Warrior;
use Game\Healer;
use Smarty\Smarty;

session_start();
$template = new Smarty();
$template->setTemplateDir('templates');
$characterList = $_SESSION['characterList'] ?? new CharacterList();

$page = $_GET['page'] ?? '';
switch($page)
{
    case 'createCharacter':
        $template->display('createCharacterForm.tpl');
        break;
    case 'saveCharacter':
        if(!empty($_POST['name']) && !empty($_POST['role']) && !empty($_POST['health'])
            && !empty($_POST['defense']) && !empty($_POST['range']))
        {
            switch ($_POST['role']) {
                case 'Warrior':
                    $newCharacter = new Warrior( $_POST['name'], $_POST['role'], (int)$_POST['health'],(int)$_POST['attack'],
                        (int)$_POST['defense'],(int)$_POST['range'], (int)$_POST['rage']);
                    //$newCharacter->setRage((int)$_POST['rage']);
                    break;
                case 'Mage':
                    $newCharacter = new Mage($_POST['name'], $_POST['role'], (int)$_POST['health'], (int)$_POST['attack'],
                        (int)$_POST['defense'], (int)$_POST['range'], (int)$_POST['mana']);
//                    $newCharacter->setMana((int)$_POST['mana']);
                    break;
                case 'Rogue':
                    $newCharacter = new Rogue($_POST['name'], $_POST['role'], (int)$_POST['health'], (int)$_POST['attack'],
                        (int)$_POST['defense'], (int)$_POST['range'], (int)$_POST['energy']);
//                    $newCharacter->setEnergy((int)$_POST['energy']);
                    break;
                case 'Healer':
                    $newCharacter = new Healer($_POST['name'],  $_POST['role'], (int)$_POST['health'], (int)$_POST['attack'],
                        (int)$_POST['defense'], (int)$_POST['range'], (int)$_POST['spirit']);
//                    $newCharacter->setSpirit((int)$_POST['spirit']);
                    break;
                default:
                    $newCharacter = new Character($_POST['name'], $_POST['role'], (int)$_POST['health'], (int)$_POST['attack'],
                        (int)$_POST['defense'], (int)$_POST['range']);
                    break;
            }

            $characterList->addCharacter($newCharacter);
            $template->assign('character', $newCharacter);
            $template->display('characterCreated.tpl');
        }else
        {
            $template->assign('error', "Niet alles is goed ingevuld");
            $template->display('error.tpl');
        }
        break;
    case 'listCharacters':
        $template->assign('characters', $characterList->getCharacters());
        $template->display('characterList.tpl');
        break;
    case 'viewCharacter':
        if(!empty($_GET['name']))
        {
            $character = $characterList->getCharacter($_GET['name']);
            if($character instanceof Character)
            {
                $template->assign('character', $character);
                $template->display('character.tpl');
            }
            else
            {
                $template->assign('error', "De character is niet te vinden in de lijst");
                $template->display('error.tpl');
            }
        }
        break;
    case 'deleteCharacter':
        if(!empty($_GET['name']))
        {
            $character = $characterList->getCharacter($_GET['name']);
            if($character instanceof Character)
            {
                $characterList->removeCharacter($character);
                header('Location: index.php?page=listCharacters');
            }
            else
            {
                $template->assign('error', "De character is niet te vinden in de lijst");
                $template->display('error.tpl');
            }
        }
        break;
    case 'battleForm':
        $template->assign('characters', $characterList->getCharacters());
        $template->display('battleForm.tpl');
        break;
    case 'startBattle':
        if (!empty($_POST['character1']) && !empty($_POST['character2'])) {
            $character1 = $characterList->getCharacter($_POST['character1']);
            $character2 = $characterList->getCharacter($_POST['character2']);

            if ($character1 instanceof Character && $character2 instanceof Character) {
                $battle = new Battle();
                $_SESSION['battle'] = $battle;
                $_SESSION['character1'] = $character1;
                $_SESSION['character2'] = $character2;
                $_SESSION['character1OriginalHealth'] = $character1->getHealth();
                $_SESSION['character2OriginalHealth'] = $character2->getHealth();

                $battle->startFight($character1, $character2);

                $template->assign('battle', $battle);
                $template->assign('character1', $character1);
                $template->assign('character2', $character2);
                $template->assign('character1OriginalHealth', $character1->getHealth());
                $template->assign('character2OriginalHealth', $character2->getHealth());
                $template->display('battleResult.tpl');
            } else {
                $template->assign('error', "Both characters must be selected.");
                $template->display('error.tpl');
            }
        } else {
            $template->assign('error', "Both characters must be selected.");
            $template->display('error.tpl');
        }
        break;
    case 'nextBattleRound':
        $battle = $_SESSION['battle'];
        $character1 = $_SESSION['character1'];
        $character2 = $_SESSION['character2'];

        $battle->executeTurn($character1, $character2);
        // Update the round number
        $battle->setRoundNumber($battle->getRoundNumber() + 1);

//        if ($character1->getHealth() <= 0 || $character2->getHealth() <= 0) {
//            $battle->endBattle($character1, $character2); // Reset health
//        }

        $template->assign('battle', $battle);
        $template->assign('character1', $character1);
        $template->assign('character2', $character2);
        $template->assign('character1OriginalHealth', $_SESSION['character1OriginalHealth']);
        $template->assign('character2OriginalHealth', $_SESSION['character2OriginalHealth']);
        $template->display('battleResult.tpl');
        break;
    case 'resetHealth':
        $battle = $_SESSION['battle'];
        $character1 = $_SESSION['character1'];
        $character2 = $_SESSION['character2'];

        // Reset health to original values
        $character1->setHealth($_SESSION['character1OriginalHealth']);
        $character2->setHealth($_SESSION['character2OriginalHealth']);

        // Redirect to the battle form
        header('Location: index.php?page=battleForm');
        exit;
        break;
    default:
        $template->display('home.tpl');
}
//$_SESSION['characterList'] = null;
$_SESSION['characterList'] = $characterList;
