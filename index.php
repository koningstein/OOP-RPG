<?php

require_once 'vendor/autoload.php';

use Game\Character;
use Game\Battle;
use Game\CharacterList;
use Game\Mage;
use Game\Warrior;
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
                    $newCharacter = new Warrior();
                    $newCharacter->setRage((int)$_POST['rage']);
                    break;
                case 'Mage':
                    $newCharacter = new Mage();
                    $newCharacter->setMana((int)$_POST['mana']);
                    break;
                default:
                    $newCharacter = new Character();
                    break;
            }
            $newCharacter->setCharacter(
                $_POST['name'],
                $_POST['role'],
                (int)$_POST['health'],
                (int)$_POST['attack'],
                (int)$_POST['defense'],
                (int)$_POST['range']
            );

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
    default:
        $template->display('home.tpl');
}
//$_SESSION['characterList'] = null;
$_SESSION['characterList'] = $characterList;
