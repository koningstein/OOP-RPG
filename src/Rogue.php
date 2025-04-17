<?php

namespace Game;

class Rogue extends Character
{
    private int $energy = 100;
    private int $originalEnergy;

    public function __construct(string $name, string $role, int $health, int $attack, int $defense = 6, int $range = 2, int $energy = 100)
    {
        parent::__construct($name, $role, $health, $attack, $defense, $range);
        $this->energy = $energy;
        $this->originalEnergy = $energy;
        $this->specialAttacks = ['sneakAttack', 'poisonDagger'];
    }

    /**
     * @return int
     */
    public function getEnergy(): int
    {
        return $this->energy;
    }

    /**
     * @param int $energy
     * @return void
     */
    public function setEnergy(int $energy): void
    {
        $this->energy = $energy;
    }

    public function getSummary(): string
    {
        $parentSummary = parent::getSummary();
        return "{$parentSummary}. This agile rogue has {$this->energy} energy points";
    }

    /**
     * @return string
     */
    public function performSneakAttack(): string
    {
        if($this->energy < 20) {
            return "Not enough energy for sneak attack!";
        }
        $modificationResult = $this->modifyTemporaryStats(
            $this->attack,
            (int)ceil(0.6 * $this->defense)
        );
        $this->energy -= 20;
        return "Performed sneak attack! {$modificationResult}";
    }

    /**
     * Uses a poison dagger attack
     * @return string
     */
    public function usePoisonDagger(): string
    {
        if ($this->energy < 30) {
            return "Not enough energy for poison dagger!";
        }
        $modificationResult = $this->modifyTemporaryStats(
            (int)ceil(0.8 * $this->attack),
            (int)ceil(0.7 * $this->defense)
        );
        $this->energy -= 30;
        return "Used poison dagger! {$modificationResult}";
    }

    /**
     * Executes a special attack based on the attack name
     * @param string $attackName
     * @return string
     */
    public function executeSpecialAttack(string $attackName): string
    {
        switch ($attackName) {
            case 'sneakAttack':
                return $this->performSneakAttack();
            case 'poisonDagger':
                return $this->usePoisonDagger();
            default:
                return "Unknown attack: {$attackName}";
        }
    }

    public function resetAttributes(): void
    {
        $this->energy = $this->originalEnergy; // Reset to the original value
    }
}