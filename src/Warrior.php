<?php

namespace Game;

class Warrior extends Character
{
    private int $rage;

    public function __construct(string $name, string $role, int $health, int $attack, int $defense, int $range, int $rage)
    {
        $this->setCharacter($name, $role, $health, $attack, $defense, $range);
        $this->rage = $rage;
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
}