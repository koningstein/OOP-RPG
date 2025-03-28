<?php

namespace Game;

class Mage
{
    private Inventory $inventory;
    private int $mana;

    public function __construct(
        private string $name,
        private string $role = 'Mage',
        private int $health,
        private int $attack,
        private int $defense = 5,
        private int $range = 1,
        int $mana = 100
    ) {
        $this->inventory = new Inventory();
        $this->mana = $mana;
    }

    public function displayStats(): string
    {
        return "<h3>Mage Stats:</h3>" .
               "Name: " . $this->name . "\n" .
               "Role: " . $this->role . "\n" .
               "Health: " . $this->health . "\n" .
               "Attack: " . $this->attack . "\n" .
               "Defense: " . $this->defense . "\n" .
               "Range: " . $this->range . "\n" .
               "Mana: " . $this->mana . "\n";
    }

    public function setHealth(int $newHealth): string
    {
        if ($newHealth < 0) {
            return "Error: Health cannot be set to a negative value";
        }
        $this->health = $newHealth;
        return "Health set to: " . $this->health;
    }

    public function getAttack(): int
    {
        return $this->attack;
    }

    public function getSummary(): string
    {
        return $this->name . " is a " . $this->role . " with " . $this->health . " health";
    }

    public function takeDamage(int $amount): void
    {
        if ($amount < $this->health) {
            $this->health -= $amount;
        } else {
            $this->health = 0;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function getDefense(): int
    {
        return $this->defense;
    }

    public function getRange(): int
    {
        return $this->range;
    }

    public function getInventory(): Inventory
    {
        return $this->inventory;
    }

    public function getMana(): int
    {
        return $this->mana;
    }

    public function setMana(int $mana): void
    {
        $this->mana = $mana;
    }
}