<?php

namespace Game;

class Tank extends Character
{
    private int $shield;

    public function __construct(string $name, string $role, int $health, int $attack,
        int $defense = 10, int $range = 1, int $shield = 50
    ) {
        parent::__construct($name, $role, $health, $attack, $defense, $range);
        $this->shield = $shield;
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
}