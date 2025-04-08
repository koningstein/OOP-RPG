<?php

namespace Game;

class Healer extends Character
{
    private int $spirit = 500;

    public function __construct(string $name, string $role, int $health, int $attack, int $defense = 6, int $range = 3, $spirit = 200)
    {
        parent::__construct($name, $role, $health, $attack, $defense, $range);
        $this->spirit = 500; // Default spirit value
    }

    /**
     * @return int
     */
    public function getSpirit(): int
    {
        return $this->spirit;
    }

    /**
     * @param int $spirit
     * @return void
     */
    public function setSpirit(int $spirit): void
    {
        $this->spirit = $spirit;
    }

    public function getSummary(): string
    {
        $parentSummary = parent::getSummary();
        return "{$parentSummary}. This healer possesses {$this->spirit} spirit power";
    }

    /**
     * @return string
     */
    public function performHealingPrayer(): string
    {
        if ($this->spirit < 50) {
            return "Not enough spirit for healing aura!";
        }

        // Heal the character for 20 health points
        $newHealth = min($this->getHealth() + 25, 100); // Assuming 100 is the max health
        $this->setHealth($newHealth);

        // Double the current defense temporarily
        $modificationResult = $this->modifyTemporaryStats(0, $this->defense);
        $this->spirit -= 50;
        return "Healing prayer restores 20 health and doubles defense temporarily! {$modificationResult}";
    }
}