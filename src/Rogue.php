<?php

namespace Game;

class Rogue extends Character
{
    private int $energy = 100;

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