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

    public function loadByParams(array $params = []): ItemList
    {
        try{
            $database = DatabaseManager::getInstance();
            if($database === null)
            {
                return $this;
            }
            $conditions = [];

            if(!empty($params['id'])){ // id=5
                $conditions['id'] = (int)$params['id'];
            }
            if(!empty($params['type'])){   // type = weapon
                $conditions['type'] = $params['type'];
            }
            if(isset($params['minValue']) && $params['minValue'] > 0){  // value >= 10
                $conditions['value >='] = (float)$params['minValue'];
            }
            if(!empty($params['name'])) { // name LIKE %Sword%
                $conditions['name LIKE'] = $params['name'];
            }
            $rows = $database->select(['items' => ['*']],  $conditions);
            foreach($rows as $row){
                $this->addItem($this->createItemFromDatabaseRow($row));
            }
            return $this;
        }catch (\PDOException $error){
            throw new \PDOException($error->getMessage());
        }
    }

    // index.php?page=viewItem&id=5
    public function findById(int $id): ?Item
    {
        // als er al een itemList is met items erin
        foreach($this->items as $item){
            if($item->getId() == $id){
                return $item;
            }
        }

        try{
            $database = DatabaseManager::getInstance();
            if($database === null)
            {
                return null;
            }

            $rows = $database->select(['items' => ['*']], ['id' => $id]);
            if(count($rows) > 0){ // ik heb een rij gevonden
                $item = $this->createItemFromDatabaseRow($rows[0]);  // Item
                $this->addItem($item);
                return $item;
            }

            return null;

        }catch (\PDOException $error){
            throw new \PDOException($error->getMessage());
        }
    }


}