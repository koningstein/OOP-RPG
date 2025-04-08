<?php

namespace Game;

class Tank extends Character
{
    private int $shield;

    public function __construct(
        string $name,
        string $role,
        int $health,
        int $attack,
        int $defense = 10,
        int $range = 1,
        int $shield = 50
    ) {
        parent::__construct($name, $role, $health, $attack, $defense, $range);
        $this->shield = $shield;
    }

    /**
     * Get the value of the shield.
     *
     * @return int
     */
    public function getShield(): int
    {
        return $this->shield;
    }

    /**
     * Set the value of the shield.
     *
     * @param int $shield
     * @return void
     */
    public function setShield(int $shield): void
    {
        $this->shield = $shield;
    }

    /**
     * Override the getSummary method to include shield information.
     *
     * @return string
     */
    public function getSummary(): string
    {
        $parentSummary = parent::getSummary();
        return "{$parentSummary}. This tank has a shield with {$this->shield} durability";
    }

    /**
     * Activates the barrier shield, modifying temporary stats.
     * @return string
     */
    public function activateBarrierShield(): string
    {
        if ($this->shield < 15) {
            return "Error: Not enough shield durability to activate the barrier shield.";
        }

        // Increase defense by 100% of the original defense and reduce attack by 50%
        $this->modifyTemporaryStats(
            (int)ceil(-0.5 * $this->attack), // Reduce attack by 50%
            (int)ceil(1.0 * $this->defense)  // Increase defense by 100%
        );

        // Reduce shield durability by 15
        $this->shield -= 15;

        return "Activated barrier shield for maximum defense! Attack reduced by 50%.";
    }


}