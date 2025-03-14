<?php

namespace Game;

/**
 * Character class represents a game character with various attributes
 */
class Character 
{
    public Inventory $inventory;

    /**
     * Creates a new character with the given attributes
     * @param string $name
     * @param string $role
     * @param int $health
     * @param int $attack
     * @param int $defense
     * @param int $range
     */
    public function __construct(
        public string $name,
        public string $role,
        public int $health,
        public int $attack,
        public int $defense = 5,
        public int $range = 1
    ) {
        $this->inventory = new Inventory();
    }

    /**
     * Displays all stats of the character
     * @return string
     */
    public function displayStats(): string
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
     * @param int $newHealth
     * @return string
     */
    public function setHealth(int $newHealth): string
    {
        if ($newHealth < 0) {
            return "Error: Health cannot be set to a negative value";
        }
        $this->health = $newHealth;
        return "Health set to: " . $this->health;
    }

    /**
     * Gets the attack value of the character
     * @return int
     */
    public function getAttack(): int
    {
        return $this->attack;
    }

    /**
     * Returns a brief summary of the character
     * @return string
     */
    public function getSummary(): string
    {
        return $this->name . " is a " . $this->role . " with " . $this->health . " health";
    }

    /**
     * Reduces the character's health by the specified amount
     * @param int $amount
     */
    public function takeDamage(int $amount): void
    {
        if ($amount < $this->health) {
            $this->health -= $amount;
        } else {
            $this->health = 0;
        }
    }
} 