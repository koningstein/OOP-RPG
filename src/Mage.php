<?php

namespace Game;

class Mage extends Character
{

    private int $mana;

    public function getMana(): int
    {
        return $this->mana;
    }

    public function setMana(int $mana): void
    {
        $this->mana = $mana;
    }
}