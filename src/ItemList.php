<?php

namespace Game;

class ItemList
{
    private array $items = [];

    /**
     * @param Item $item
     * @return void
     */
    public function addItem(Item $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    public function loadAllFromDatabase(): ItemList
    {
        try{
            $database = DatabaseManager::getInstance();
            if($database === null)
            {
                return $this;
            }

            $rows = $database->select(['items' => ['*']]);
            foreach($rows as $row)
            {
                $this->addItem($this->createItemFromDatabaseRow($row));
            }
            return $this;
        }catch (\PDOException $error){
            throw new \PDOException("De select query bij items ging niet goed ".$error->getMessage());
        }
    }

    private function createItemFromDatabaseRow(array $row): Item
    {
        return new Item(
          $row['name'],
          $row['type'],
          $row['value'],
          $row['id']
        );
    }

}