<?php

namespace Game;

/**
 * Inventory class manages items that a character can carry
 */
class Inventory
{
    public array $items = [];

    /**
     * Adds an item to the inventory
     * @param string $item
     * @return void
     */
    public function addItem(string $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @param string $item
     * @return void
     */
    public function removeItem(string $item): void
    {
        $key = array_search($item, $this->items);
        if ($key !== false) {
            unset($this->items[$key]);
        }
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}