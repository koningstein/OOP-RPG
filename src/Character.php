<?php

namespace Game;

class Character 
{
    public function __construct(
        public $name,
        public $role,
        public $health,
        public $attack,
        public $defense = 5,
        public $range = 1
    ) {}

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

    public function getAttack()
    {
        return $this->attack;
    }
} 