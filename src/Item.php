<?php

namespace Game;

abstract class Item
{
    protected string $name;
    protected string $description;
    protected int $value;

    public function __construct(string $name, string $description, int $value)
    {
        $this->name = $name;
        $this->description = $description;
        $this->value = $value;
    }

    /**
     * Returns information about the item
     * @return string
     */
    public function getItemInfo(): string
    {
        return "Name: {$this->name}, Description: {$this->description}, Value: {$this->value}";
    }

    abstract public function use(?Character $character = null): string;
}