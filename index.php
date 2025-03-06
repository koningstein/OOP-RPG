<?php

require_once 'Character.php';

$hero = new Character("Eldrin", "Mage", 100, 15, 10, 2);

echo "<pre>";
echo $hero->displayStats();

// Test setHealth met verschillende waarden
echo "\nTest setHealth methode:\n";
echo "Setting health to 50: " . $hero->setHealth(50) . "\n";
echo "Setting health to -30: " . $hero->setHealth(-30) . "\n";

// Test getAttack methode
echo "\nTest getAttack methode:\n";
echo "Attack value: " . $hero->getAttack() . "\n";

echo "\nFinal stats:\n";
echo $hero->displayStats(); 