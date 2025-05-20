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
            $rows = $database->select(['items' => ['*']]);

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
            isset($row['id']) ? (int)$row['id'] : null
        );
    }
}