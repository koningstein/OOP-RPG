<?php

namespace Game;

/**
 * Character class represents a game character with various attributes
 */
class Character 
{
    /**
     * Creates a new character with the given attributes
     * @param $name
     * @param $role
     * @param $health
     * @param $attack
     * @param $defense
     * @param $range
     */
    public function __construct(
        public $name,
        public $role,
        public $health,
        public $attack,
        public $defense = 5,
        public $range = 1
    ) {}

    /**
     * Displays all stats of the character
     * @return string
     */
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

    /**
     * Sets a new health value for the character
     * @param $newHealth
     * @return string
     */
    public function setHealth($newHealth)
    {
        if ($newHealth < 0) {
            return "Error: Health cannot be set to a negative value";
        }
        $this->health = $newHealth;
        return "Health set to: " . $this->health;
    }

    /**
     * Gets the attack value of the character
     * @return mixed
     */
    public function getAttack()
    {
        return $this->attack;
    }

    /**
     * Returns a brief summary of the character
     * @return string
     */
    public function getSummary()
    {
        return $this->name . " is a " . $this->role . " with " . $this->health . " health";
    }
} 