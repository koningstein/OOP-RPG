<?php

require_once 'Character.php';

$hero = new Character();
$hero->name = "Eldrin";
$hero->health = 100;
$hero->attack = 15;
$hero->defense = 10;
$hero->range = 2;
$hero->role = "Mage";

echo "<pre>";
echo $hero->displayStats();

// Test setHealth met verschillende waarden
echo "\nTest setHealth methode:\n";
echo "Setting health to 50: " . $hero->setHealth(50) . "\n";
echo "Setting health to -30: " . $hero->setHealth(-30) . "\n";
echo "\nFinal stats:\n";
echo $hero->displayStats(); 