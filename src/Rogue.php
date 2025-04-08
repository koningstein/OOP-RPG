<?php

namespace Game;

class Rogue extends Character
{
    private int $energy = 100;

    public function __construct(string $name, string $role, int $health, int $attack, int $defense = 6, int $range = 2, int $energy = 100)
    {
        parent::__construct($name, $role, $health, $attack, $defense, $range);
        $this->energy = $energy;
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
}