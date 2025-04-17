<?php

namespace Game;

class Tank extends Character
{
    private int $shield;
    private int $originalShield;

    public function __construct(string $name, string $role, int $health, int $attack,
        int $defense = 10, int $range = 1, int $shield = 50
    ) {
        parent::__construct($name, $role, $health, $attack, $defense, $range);
        $this->shield = $shield;
        $this->originalShield = $shield;
        $this->specialAttacks = ['barrierShield', 'taunt'];
    }

    /**
     * Get the value of shield
     *
     * @return int
     */
    public function getShield(): int
    {
        return $this->shield;
    }

    /**
     * Set the value of shield
     *
     * @param int $shield
     * @return void
     */
    public function setShield(int $shield): void
    {
        $this->shield = $shield;
    }

    /**
     * Override getSummary to include shield information
     *
     * @return string
     */
    public function getSummary(): string
    {
        $parentSummary = parent::getSummary();
        return "{$parentSummary}. This tank has a shield with {$this->shield} durability";
    }

    /**
         * Activates the barrier shield, boosting defense and reducing attack
         *
         * @return string
         */
    public function activateBarrierShield(): string
    {
        if ($this->shield < 15) {
            return "Error: Not enough shield durability to activate the barrier shield.";
        }

        // Increase defense by 100% of the original defense
        // Reduce attack to 50% of the original attack
        $modificationResult = $this->modifyTemporaryStats(
            (int)ceil(-0.5 * $this->attack), // Reduce attack by 50%
            (int)ceil($this->defense)        // Increase defense by 100%
        );

        // Reduce shield durability by 15
        $this->shield -= 15;

        return "Raised shield for maximum defense! Attack reduced by 50%. {$modificationResult}";
    }

    /**
     * Performs a taunt attack
     *
     * @return string
     */
    public function performTaunt(): string
    {
        if ($this->shield < 10) {
            return "Error: Not enough shield durability to perform taunt.";
        }

        $modificationResult = $this->modifyTemporaryStats(
            (int)ceil(0.4 * $this->attack),  // Increase attack by 40%
            (int)ceil(1.3 * $this->defense) // Increase defense by 130%
        );

        $this->shield -= 10;

        return "Performed taunt! Attack increased by 40%, defense increased by 130%. {$modificationResult}";
    }

    /**
     * Executes a special attack based on the attack name
     *
     * @param string $attackName
     * @return string
     */
    public function executeSpecialAttack(string $attackName): string
    {
        switch ($attackName) {
            case 'barrierShield':
                return $this->activateBarrierShield();
            case 'taunt':
                return $this->performTaunt();
            default:
                return "Unknown attack: {$attackName}";
        }
    }

    public function resetAttributes(): void
    {
        $this->shield = $this->originalShield; // Reset to the original value
    }
}