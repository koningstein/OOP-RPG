<?php

require_once 'vendor/autoload.php';

use Game\Character;
use Game\Battle;

// Mage met standaard defense en range
$eldrin = new Character(
    name: "Eldrin",
    role: "Mage",
    health: 100,
    attack: 15
);

// Warrior met aangepaste defense
$thorgrim = new Character(
    name: "Thorgrim",
    role: "Warrior",
    health: 120,
    attack: 12,
    defense: 10
);

echo "<pre>";
// Start een gevecht
$battle = new Battle();
echo $battle->startFight($eldrin, $thorgrim);

echo "\n\nFinal stats:\n";
echo $eldrin->displayStats();
echo "\n";
echo $thorgrim->displayStats();

// Test setHealth met verschillende waarden
echo "\nTest setHealth methode:\n";
echo "Setting health to 50: " . $eldrin->setHealth(50) . "\n";
echo "Setting health to -30: " . $eldrin->setHealth(-30) . "\n";

// Test getAttack methode
echo "\nTest getAttack methode:\n";
echo "Attack value: " . $eldrin->getAttack() . "\n";

echo "\nFinal stats:\n";
echo $eldrin->displayStats();
echo "Opdr 14: ".$eldrin->getSummary();


// Test takeDamage method
echo "\nOpdr 15 - Test takeDamage method:\n";
echo "Initial health: " . $eldrin->health . "\n";
$eldrin->takeDamage(20);
echo "After 20 damage: " . $eldrin->health . "\n";
$eldrin->takeDamage(40);
echo "After 40 more damage: " . $eldrin->health . "\n";
