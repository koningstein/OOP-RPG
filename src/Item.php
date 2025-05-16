<?php

namespace Game;

/**
 * Item class represents an item in the game
 */
class Item
{
    private ?int $id = null;
    private string $name;
    private string $type;
    private float $value;

    public function __construct(string $name, string $type, float $value, ?int $id = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function toString(): string
    {
        return "Item: {$this->name}, Type: {$this->type}, Value: {$this->value}";
    }

    /**
     * Converts the item data to an array suitable for database insertion
     * @return array<string, mixed>
     */
    public function toDatabaseArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'value' => $this->value
        ];
    }

    /**
     * Saves the item to the database
     * @return bool True if successful, false otherwise
     */
    public function save(): bool
    {
        try {
            // Get database instance from DatabaseManager
            $database = DatabaseManager::getInstance();
            if ($database === null) {
                return false;
            }

            // Insert item into database
            $itemData = $this->toDatabaseArray();
            $insertedId = $database->insert('items', $itemData);
            // Set the ID for this item
            $this->setId($insertedId);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}