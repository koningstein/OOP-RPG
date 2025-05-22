<?php

namespace Game;

/**
 * Items die een character in de inventory kan gaan zetten
 */
class Item
{
    private ?int $id;
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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function toString(): string
    {
        return "name = {$this->getName()} type ={$this->getType()} value ={$this->getValue()}";
    }

    public function toDatabaseArray(): array
    {
        return [
            "name" => $this->name,
            "type" => $this->type,
            "value" => $this->value
        ];
    }

    public function save(): bool
    {
        try{
            $database = DatabaseManager::getInstance();
            if($database === null)
            {
                return false;
            }

            // insert
            $itemsData = $this->toDatabaseArray();
            $insertedId = $database->insert("items", $itemsData);
            $this->setId($insertedId);
            return true;
        }catch (\PDOException $error){
            return false;
        }

    }

}