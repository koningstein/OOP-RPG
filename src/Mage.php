<?php

namespace Game;

class Mage extends Character
{

    private int $mana;

    public function __construct(string $name, string $role, int $health, int $attack, int $defense = 3, int $range = 5, int $mana = 150)
    {
        parent::__construct($name, $role, $health, $attack, $defense, $range);
        $this->mana = $mana;
    }

    /**
     * @return int
     */
    public function getMana(): int
    {
        return $this->mana;
    }

    /**
     * @param int $mana
     * @return void
     */
    public function setMana(int $mana): void
    {
        $this->mana = $mana;
    }

    /**
     * @return string
     */
    public function castFireball(): string
    {
        if($this->mana < 30) {
            return "Not enough mana for fireball!";
        }
        $modificationResult = $this->modifyTemporaryStats(
            (int)ceil(0.5 * $this->attack),
            (int)ceil(0.8 * $this->defense)
        );
        $this->mana -= 30;
        return "Cast fireball! {$modificationResult}";
    }
}