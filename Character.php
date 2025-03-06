<?php

class Character 
{
    public $name;
    public $health;
    public $attack;
    public $defense;
    public $range;
    public $role;

    public function displayStats()
    {
        return "Character Stats:\n" .
               "---------------\n" .
               "Name: " . $this->name . "\n" .
               "Role: " . $this->role . "\n" .
               "Health: " . $this->health . "\n" .
               "Attack: " . $this->attack . "\n" .
               "Defense: " . $this->defense . "\n" .
               "Range: " . $this->range . "\n";
    }
} 