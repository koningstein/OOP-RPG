<?php

require_once 'vendor/autoload.php';

use Game\Character;
use Game\Battle;
use Smarty\Smarty;

$template = new Smarty();
$template->setTemplateDir('templates');

$action = $_GET['action'] ?? '';
if(!empty($_POST['name']) && !empty($_POST['role']) && !empty($_POST['health'])
    && !empty($_POST['defense']) && !empty($_POST['range']))
{
    $newCharacter = new Character(
        $_POST['name'],
        $_POST['role'],
        (int)$_POST['health'],
        (int)$_POST['attack'],
        (int)$_POST['defense'],
        (int)$_POST['range']
    );

    $template->assign('character', $newCharacter);
    $template->display('characterCreated.tpl');
}
elseif($action == 'createCharacter')
{
    $template->display('createCharacterForm.tpl');
}else{
    // Mage met standaard defense en range
    $eldrin = new Character(
        name: "Eldrin",
        role: "Mage",
        health: 100,
        attack: 25
    );

// Warrior met aangepaste defense
    $thorgrim = new Character(
        name: "Thorgrim",
        role: "Warrior",
        health: 120,
        attack: 12,
        defense: 10
    );

    $template->assign('eldrin', $eldrin);
    $template->assign('thorgrim', $thorgrim);
    $template->display('character.tpl');
}



//echo "<pre>";
//echo $eldrin->displayStats();
//echo $thorgrim->displayStats();
//echo "<br>";
//
//$eldrin->getInventory()->addItem("Potion");
//$eldrin->getInventory()->addItem("Magic Staff");
//$thorgrim->getInventory()->addItem("Axe");
//$thorgrim->getInventory()->addItem("Shield");
//
//echo "<h3>Full inventory:</h3>";
//foreach ($eldrin->getInventory()->getItems() as $item) {
//    echo $eldrin->getName() . " has a " . $item . "\n";
//}
//
//foreach ($thorgrim->getInventory()->getItems() as $item) {
//    echo $thorgrim->getName() . " has a " . $item . "\n";
//}
//
//$eldrin->getInventory()->removeItem("Potion");
//$thorgrim->getInventory()->removeItem("Shield");
//
//echo "\nInventory after removing items:\n";
//foreach ($eldrin->getInventory()->getItems() as $item) {
//    echo $eldrin->getName() . " has a " . $item . "\n";
//}
//
//foreach ($thorgrim->getInventory()->getItems() as $item) {
//    echo $thorgrim->getName() . " has a " . $item . "\n";
//}
//echo "<br>";
//// Start een gevecht
//$battle = new Battle();
//$battle->changeMaxRounds(5);
//echo $battle->startFight($eldrin, $thorgrim);
//
//echo "\n\nFinal stats:\n";
//echo $eldrin->displayStats();
//echo "\n";
//echo $thorgrim->displayStats();
//
//echo $battle->startFight($eldrin, $thorgrim);
//// Test setHealth met verschillende waarden
//echo "\nTest setHealth methode:\n";
//echo "Setting health to 50: " . $eldrin->setHealth(50) . "\n";
//echo "Setting health to -30: " . $eldrin->setHealth(-30) . "\n";

//// Test getAttack methode
//echo "\nTest getAttack methode:\n";
//echo "Attack value: " . $eldrin->getAttack() . "\n";
//
//echo "\nFinal stats:\n";
//echo $eldrin->displayStats();
//echo "Opdr 14: ".$eldrin->getSummary();


//// Test takeDamage method
//echo "\nOpdr 15 - Test takeDamage method:\n";
//echo "Initial health: " . $eldrin->health . "\n";
//$eldrin->takeDamage(20);
//echo "After 20 damage: " . $eldrin->health . "\n";
//$eldrin->takeDamage(40);
//echo "After 40 more damage: " . $eldrin->health . "\n";
