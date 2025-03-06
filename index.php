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