<?php

namespace Game;

abstract class ConsumableItem extends Item
{
    protected int $remainingUses = 1;

    /**
     * Returns the number of remaining uses for the item
     * @return int
     */
    public function getRemainingUses(): int
    {
        return $this->remainingUses;
    }

    /**
     * Sets the number of remaining uses for the item
     * @param int $uses
     * @return void
     */
    public function setRemainingUses(int $uses): void
    {
        $this->remainingUses = $uses;
    }

    abstract public function getEffectDescription(): string;
    abstract public function use(?Character $character = null): string;
}