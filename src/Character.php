<?php

namespace Game;

/**
 * Character class represents a game character with various attributes
 */
class Character 
{
    private Inventory $inventory;
    private ?int $rage = null;
    private ?int $mana = null;

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
        private string $name,
        private string $role,
        private int $health,
        private int $attack,
        private int $defense = 5,
        private int $range = 1,
        ?int $rage = null,
        ?int $mana = null
    ) {
        $this->inventory = new Inventory();
        if($this->role === "Warrior") {
            $this->rage = $rage ?? 100;
        } elseif($this->role === "Mage") {
            $this->mana = $mana ?? 100;
        }
    }

    /**
     * Displays all stats of the character
     * @return string
     */
    public function displayStats(): string
    {
        return "<h3>Character Stats:</h3>" .
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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @return int
     */
    public function getDefense(): int
    {
        return $this->defense;
    }

    /**
     * @return int
     */
    public function getRange(): int
    {
        return $this->range;
    }

    /**
     * @return Inventory
     */
    public function getInventory(): Inventory
    {
        return $this->inventory;
    }

    /**
     * @return int|null
     */
    public function getRage(): ?int
    {
        return $this->rage;
    }

    /**
     * @return int|null
     */
    public function getMana(): ?int
    {
        return $this->mana;
    }

    /**
     * @param int|null $rage
     */
    public function setRage(?int $rage): void
    {
        $this->rage = $rage;
    }

    /**
     * @param int|null $mana
     */
    public function setMana(?int $mana): void
    {
        $this->mana = $mana;
    }
} 