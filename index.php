<?php

require_once 'vendor/autoload.php';

use Game\Character;
use Game\Battle;
use Game\CharacterList;
use Game\Mage;
use Game\Rogue;
use Game\Warrior;
use Game\Healer;
use Game\Tank;
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
                case 'Tank': // Added case for Tank
                    $newCharacter = new Tank($_POST['name'], $_POST['role'], (int)$_POST['health'], (int)$_POST['attack'],
                        (int)$_POST['defense'], (int)$_POST['range'], (int)$_POST['shield']);
                    break;
                default:
                    $template->assign('error', "Invalid role selected. Unable to create character.");
                    $template->display('error.tpl');
                    return; // Stop further processing
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
            $fighter1 = $characterList->getCharacter($_POST['character1']);
            $fighter2 = $characterList->getCharacter($_POST['character2']);

            $battle = new Battle($fighter1, $fighter2, 10);
            $_SESSION['battle'] = $battle;
            $template->assign('battle', $battle);
            $template->display('battleResult.tpl');
        } else {
            $template->assign('error', "Both characters must be selected.");
            $template->display('error.tpl');
        }
        break;
    case 'battleRound':
        if (isset($_SESSION['battle'])) {
            $battle = $_SESSION['battle'];
            // Check and set attack for Fighter 1
            if (!empty($_POST['fighter1Attack'])) {
                $attack1 = $_POST['fighter1Attack'] === 'normal' ? null : $_POST['fighter1Attack'];
                $battle->setAttackForFighter($battle->getFighter1(), $attack1);
                $statusMessage[] = "{$battle->getFighter1()->getName()} selected " . ($attack1 ? $attack1 : "a normal attack") . ".";
            }

            // Check and set attack for Fighter 2
            if (!empty($_POST['fighter2Attack'])) {
                $attack2 = $_POST['fighter2Attack'] === 'normal' ? null : $_POST['fighter2Attack'];
                $battle->setAttackForFighter($battle->getFighter2(), $attack2);
                $statusMessage[] = "{$battle->getFighter2()->getName()} selected " . ($attack2 ? $attack2 : "a normal attack") . ".";
            }

            $battle->executeTurn();
            $_SESSION['battle'] = $battle;
            $template->assign('battle', $battle);
            if (isset($statusMessage)) {
                $template->assign('statusMessage', $statusMessage);
            }
            $template->display('battleResult.tpl');
        } else {
            $template->assign('error', "No active battle found.");
            $template->display('error.tpl');
        }
        break;
    case 'resetHealth':
        if (isset($_SESSION['battle'])) {
            $battle = $_SESSION['battle'];
            $battle->endBattle();
            header('Location: index.php?page=battleForm');
            exit;
        } else {
            $template->assign('error', "No active battle found.");
            $template->display('error.tpl');
        }
        break;
    default:
        $template->display('home.tpl');
}
//$_SESSION['characterList'] = null;
$_SESSION['characterList'] = $characterList;
