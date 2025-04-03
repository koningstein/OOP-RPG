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
        $this->tempAttack = $this->attack;
        $this->energy -= 20;
        $this->tempDefense = (int) ceil(0.6 * $this->defense);
        return "Performed sneak attack with {$this->attack} power!. Defense is temporarily reduced by {$this->tempDefense}";
    }
}