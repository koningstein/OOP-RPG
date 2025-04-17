<?php

namespace Game;

class Warrior extends Character
{
    private int $rage;
    private int $originalRage;

    public function __construct(string $name, string $role, int $health, int $attack, int $defense, int $range, int $rage)
    {
        parent::__construct($name, $role, $health, $attack, $defense, $range);
        $this->rage = $rage;
        $this->originalRage = $rage;
        $this->specialAttacks = ['rageAttack', 'whirlwind'];
    }

    /**
     * @return int
     */
    public function getRage(): int
    {
        return $this->rage;
    }

    /**
     * @param int $rage
     * @return void
     */
    public function setRage(int $rage): void
    {
        $this->rage = $rage;
    }

    public function getSummary(): string
    {
        $parentSummary = parent::getSummary();
        return "{$parentSummary}. Additionally, this warrior has {$this->rage} rage points";
    }

    /**
     * @return string
     */
    public function performRageAttack(): string
    {
        if($this->rage < 25) {
            return "Not enough rage for rage attack!";
        }
        $modificationResult = $this->modifyTemporaryStats(
            (int)ceil(0.75 * $this->attack),
            (int)ceil(0.7 * $this->defense)
        );
        $this->rage -= 25;
        return "performed rage attack! {$modificationResult}";
    }

    /**
     * Performs a whirlwind attack
     * @return string
     */
    public function performWhirlwind(): string
    {
        if ($this->rage < 35) {
            return "Not enough rage for whirlwind attack!";
        }
        $modificationResult = $this->modifyTemporaryStats(
            (int)ceil(0.6 * $this->attack),
            (int)ceil(0.5 * $this->defense)
        );
        $this->rage -= 35;
        return "Performed whirlwind attack! {$modificationResult}";
    }

    /**
     * Executes a special attack based on the attack name
     * @param string $attackName
     * @return string
     */
    public function executeSpecialAttack(string $attackName): string
    {
        switch ($attackName) {
            case 'rageAttack':
                return $this->performRageAttack();
            case 'whirlwind':
                return $this->performWhirlwind();
            default:
                return "Unknown attack: {$attackName}";
        }
    }

    public function resetAttributes(): void
    {
        $this->rage = $this->originalRage; // Reset to the original value
    }
}