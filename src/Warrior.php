<?php

namespace Game;

class Warrior extends Character
{
    private int $rage;

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

    /**
     * @return string
     */
    public function performRageAttack(): string
    {
        if($this->rage < 25) {
            return "Not enough rage for rage attack!";
        }
        $this->tempAttack = (int) ceil(0.75 * $this->attack);
        $this->tempDefense = (int) ceil(0.7 * $this->defense);
        $this->rage -= 25;
        return "Performed rage attack with {$this->attack} power! Defense is temporarily reduced by {$this->tempDefense}";
    }
}