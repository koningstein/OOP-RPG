<?php

namespace Game;

class Mage extends Character
{

    private int $mana;

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
        $this->tempAttack = (int) ceil(0.5 * $this->attack);
        $this->tempDefense = (int) ceil(0.8 * $this->defense);
        $this->mana -= 30;
        return "Cast fireball with {$this->attack} power! Defense is temporarily reduced by {$this->tempDefense}";
    }
}