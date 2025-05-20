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
     * Retrieves all items from the database.
     *
     * @return Item[] Array of Item objects
     */
    public static function getAllFromDatabase(): array
    {
        try {
            // Get database instance from DatabaseManager
            $database = DatabaseManager::getInstance();
            if ($database === null) {
                throw new \Exception("No database instance available.");
            }
            // Fetch all rows from the 'items' table
            $rows = $database->select(['items' => ['*']]);
            // Convert each row to an Item object
            $items = [];
            foreach ($rows as $row) {
                $items[] = self::createFromDatabaseRow($row);
            }
            return $items;
        } catch (\Exception $e) {
            // Handle database errors
            error_log("Error retrieving items from database: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Find an item by its ID
     * @param int $id The ID to search for
     * @return Item|null The found Item object or null if not found
     */
    public static function findById(int $id): ?Item
    {
        try {
            // Get database instance
            $database = DatabaseManager::getInstance();
            if ($database === null) {
                return null;
            }

            // Get item from database by ID
            $rows = $database->select(['items' => ['*']], ['id' => $id]);

            // Return the first row as an Item object or null if no rows
            if (count($rows) > 0) {
                return self::createFromDatabaseRow($rows[0]);
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Find items by type
     * @param string $type The type to search for
     * @return Item[] Array of matching Item objects
     */
    public static function findByType(string $type): array
    {
        try {
            // Get database instance
            $database = DatabaseManager::getInstance();
            if ($database === null) {
                return [];
            }

            // Get items from database by type
            $rows = $database->select(['items' => ['*']], ['type' => $type]);

            // Convert each row to an Item object
            $items = [];
            foreach ($rows as $row) {
                $items[] = self::createFromDatabaseRow($row);
            }

            return $items;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Find items with value greater than specified amount
     * @param float $minValue The minimum value
     * @return Item[] Array of matching Item objects
     */
    public static function findExpensiveItems(float $minValue): array
    {
        try {
            // Get database instance
            $database = DatabaseManager::getInstance();
            if ($database === null) {
                return [];
            }

            // Get expensive items from database
            $rows = $database->select(['items' => ['*']], ['value >' => $minValue]);

            // Convert each row to an Item object
            $items = [];
            foreach ($rows as $row) {
                $items[] = self::createFromDatabaseRow($row);
            }

            return $items;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Creates an Item object from a database row.
     *
     * @param string[] $row Associative array representing a database row
     * @return Item The created Item object
     */
    private static function createFromDatabaseRow(array $row): Item
    {
        return new self(
            $row['name'],
            $row['type'],
            (float)$row['value'],
            isset($row['id']) ? (int)$row['id'] : null
        );
    }
}