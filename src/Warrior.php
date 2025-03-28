<?php

namespace Game;

class Warrior extends Character
{
    private int $rage;

    public function getRage(): int
    {
        return $this->rage;
    }

    public function setRage(int $rage): void
    {
        $this->rage = $rage;
    }
}