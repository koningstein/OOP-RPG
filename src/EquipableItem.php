<?php

namespace Game;

abstract class EquipableItem extends Item
{
    protected int $durability;
    protected ?Character $equippedBy = null;

    /**
     * Returns the durability of the item
     * @return int
     */
    public function getDurability(): int
    {
        return $this->durability;
    }

    /**
     * Sets the durability of the item
     * @param int $durability
     * @return void
     */
    public function setDurability(int $durability): void
    {
        $this->durability = $durability;
    }

    /**
     * Returns the character who has equipped the item
     * @return ?Character
     */
    public function getEquippedBy(): ?Character
    {
        return $this->equippedBy;
    }

    /**
     * Sets the character who has equipped the item
     * @param ?Character $character
     * @return void
     */
    public function setEquippedBy(?Character $character): void
    {
        $this->equippedBy = $character;
    }

    abstract public function getStatBonus(): array;
    abstract public function use(?Character $character = null): string;
}