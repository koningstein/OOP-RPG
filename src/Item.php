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

    /**
     * Update het huidige item in de database
     * @return bool
     */
    public function update(): bool
    {
        try {
            if ($this->id === null) { // Controleer of het item een geldig ID heeft
                return false;
            }
            $database = DatabaseManager::getInstance();
            if ($database === null) {
                return false;
            }
            $itemData = $this->toDatabaseArray(); // Gebruik toDatabaseArray() voor de update data
            // Roep update() aan met conditions array voor ID
            $affectedRows = $database->update("items", $itemData, ['id' => $this->id]);
            // Return true bij succes (affected rows > 0), false bij falen
            return $affectedRows > 0;
        } catch (\Exception $error) {
            return false;
        }
    }

    /**
     * Laad een item uit de database op basis van ID
     * @param int $id
     * @return Item|null
     */
    public static function loadFromDatabase(int $id): ?Item
    {
        try {
            $database = DatabaseManager::getInstance();
            if ($database === null) {
                return null;
            }

            // Gebruik select() methode met WHERE condition voor het ID
            $results = $database->select(['items' => ['*']], ['id' => $id]);
            if (empty($results)) {
                return null;
            }
            $row = $results[0];
            // Return een nieuw Item object
            return new Item(
                $row['name'],
                $row['type'],
                (float)$row['value'],
                (int)$row['id']
            );
        } catch (\Exception $error) {
            return null;
        }
    }
}