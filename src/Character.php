<?php

namespace Game;

/**
 * Character class represents a game character with various attributes
 */
abstract class Character
{
    private Inventory $inventory;
    private string $name;
    private string $role;
    private int $health;
    protected int $attack;
    protected int $defense;
    private int $range;
    protected int $tempAttack = 0;
    protected int $tempDefense = 0;
    protected array $specialAttacks = [];

    public function __construct(string $name,
                                string $role,
                                int $health,
                                int $attack,
                                int $defense = 5,
                                int $range = 1)
    {
        $this->name = $name;
        $this->role = $role;
        $this->health = $health;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->range = $range;

        $this->inventory = new Inventory();
    }

//    /**
//     * @param string $name
//     * @param string $role
//     * @param int $health
//     * @param int $attack
//     * @param int $defense
//     * @param int $range
//     * @return void
//     */
//    public function setCharacter(
//        string $name,
//        string $role,
//        int $health,
//        int $attack,
//        int $defense = 5,
//        int $range = 1
//    ) {
//        $this->name = $name;
//        $this->role = $role;
//        $this->health = $health;
//        $this->attack = $attack;
//        $this->defense = $defense;
//        $this->range = $range;
//
//        $this->inventory = new Inventory();
//    }

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
        return $this->attack + $this->tempAttack;
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
        return $this->defense + $this->tempDefense;
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
     * Returns the available special attacks
     * @return array
     */
    public function getSpecialAttacks(): array
    {
        return $this->specialAttacks;
    }

    /**
     * @return int
     */
    public function getTempAttack(): int
    {
        return $this->tempAttack;
    }

    /**
     * @return int
     */
    public function getTempDefense(): int
    {
        return $this->tempDefense;
    }


    /**
     * Modifies the temporary attack and defense stats
     * @param int $attackMod
     * @param int $defenseMod
     * @return string
     */
    protected function modifyTemporaryStats(int $attackMod, int $defenseMod): string
    {
        $this->tempAttack = $attackMod;
        $this->tempDefense = $defenseMod;
        return "Temporary stats modified: Attack = {$this->tempAttack}, Defense = {$this->tempDefense}";
    }

    public function resetTempstats(): void
    {
        $this->tempAttack = 0;
        $this->tempDefense = 0;
    }

    abstract public function executeSpecialAttack(string $attackName): string;
    abstract public function resetAttributes(): void;
} 