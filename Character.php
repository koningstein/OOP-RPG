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

    public function setHealth($newHealth)
    {
        if ($newHealth < 0) {
            return "Error: Health cannot be set to a negative value";
        }
        $this->health = $newHealth;
        return "Health set to: " . $this->health;
    }
} 