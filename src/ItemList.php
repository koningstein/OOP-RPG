<?php

namespace Game;

/**
 * ItemList class manages collections of Item objects and handles database operations
 */
class ItemList
{
    /**
     * @var Item[] $items Array of Item objects
     */
    private array $items = [];

    /**
     * Creates a new empty ItemList
     */
    public function __construct()
    {
        $this->items = [];
    }

    /**
     * Adds an item to the list
     *
     * @param Item $item The item to add
     * @return void
     */
    public function addItem(Item $item): void
    {
        $this->items[] = $item;
    }

    /**
     * Returns all items in the list
     *
     * @return Item[] Array of Item objects
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Gets the number of items in the list
     *
     * @return int The number of items
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Loads all items from the database
     *
     * @return ItemList The populated ItemList object (for method chaining)
     */
    public function loadAllFromDatabase(): ItemList
    {
        try {
            // Get database instance
            $database = DatabaseManager::getInstance();
            if ($database === null) {
                return $this; // Return current object if database not available
            }

            // Get all items from database
            $rows = $database->select(['item' => ['*']]);

            // Convert each row to an Item object and add to list
            foreach ($rows as $row) {
                $this->addItem($this->createItemFromDatabaseRow($row));
            }

            return $this; // Return this for method chaining
        } catch (\Exception $e) {
            // You could log the error here
            // For now, just return the current object
            return $this;
        }
    }

    /**
     * Loads items from the database based on query parameters
     *
     * @param array<string, mixed> $params Query parameters
     * @return ItemList The populated ItemList object (for method chaining)
     */
    public function loadByParams(array $params = []): ItemList
    {
        try {
            // Get database instance
            $database = DatabaseManager::getInstance();
            if ($database === null) {
                return $this; // Return current object if database not available
            }
            $conditions = []; // Build conditions based on params
            if (!empty($params['id'])) {   // Handle specific ID search
                $conditions['id'] = (int)$params['id'];
            }

            if (!empty($params['type'])) { // Handle type filter
                $conditions['type'] = $params['type'];
            }

            if (isset($params['minValue']) && $params['minValue'] > 0) { // Handle minimum value filter
                $conditions['value >='] = (float)$params['minValue'];
            }

            if ( !empty($params['name'])) { // Handle name search (with LIKE)
                $conditions['name LIKE'] = $params['name'];
            }

            // Get items from database with the specified conditions
            $rows = $database->select(['items' => ['*']], $conditions);
            // Convert each row to an Item object and add to list
            foreach ($rows as $row) {
                $this->addItem($this->createItemFromDatabaseRow($row));
            }
            return $this; // Return this for method chaining
        } catch (\Exception $e) {
            // You could log the error here
            // For now, just return the current object
            return $this;
        }
    }

    /**
     * Finds a specific item by ID
     *
     * @param int $id The ID to search for
     * @return Item|null The found Item object or null if not found
     */
    public function findById(int $id): ?Item
    {
        // First check if the item is already in the list
        foreach ($this->items as $item) {
            if ($item->getId() === $id) {
                return $item;
            }
        }

        // If not, try to load it from the database
        try {
            $database = DatabaseManager::getInstance();
            if ($database === null) {
                return null;
            }

            $rows = $database->select(['items' => ['*']], ['id' => $id]);

            if (count($rows) > 0) {
                $item = $this->createItemFromDatabaseRow($rows[0]);
                $this->addItem($item); // Add to our list for future reference
                return $item;
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Creates an Item object from a database row
     *
     * @param array<string, mixed> $row Database row
     * @return Item The created Item object
     */
    private function createItemFromDatabaseRow(array $row): Item
    {
        return new Item(
            $row['name'],
            $row['type'],
            (float)$row['value'],
            (int)$row['attack_bonus'],
            (int)$row['defense_bonus'],
            (int)$row['health_bonus'],
            $row['special_effect'],
            isset($row['id']) ? (int)$row['id'] : null
        );
    }
}