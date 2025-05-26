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
    private int $attackBonus = 0;
    private int $defenceBonus = 0;
    private int $healthBonus= 0;
    private string $specialEffect;

    public function __construct(string $name, string $type, float $value, int $attackBonus = 0,
                                int $defenseBonus = 0, int $healthBonus = 0,
                                string $specialEffect = "",  ?int $id = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->attackBonus = $attackBonus;
        $this->defenceBonus = $defenseBonus;
        $this->healthBonus = $healthBonus;
        $this->specialEffect = $specialEffect;
        $this->id = $id;

        if ($this->type === 'misc' && $this->attackBonus === 0 && $this->defenceBonus === 0
            && $this->healthBonus === 0 && $this->specialEffect === "") {
            $this->generateMysteryEffect();
        }

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
     * @return int
     */
    public function getAttackBonus(): int
    {
        return $this->attackBonus;
    }

    /**
     * @return int
     */
    public function getDefenceBonus(): int
    {
        return $this->defenceBonus;
    }

    /**
     * @return int
     */
    public function getHealthBonus(): int
    {
        return $this->healthBonus;
    }

    /**
     * @return string
     */
    public function getSpecialEffect(): string
    {
        return $this->specialEffect;
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

    private function generateMysteryEffect(): void
    {
        $this->attackBonus = rand(1, 10);
        $this->defenceBonus = rand(1, 10);
        $this->healthBonus = rand(1, 10);
        $this->specialEffect = "Mystery effect #" . rand(100, 999);
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
            'value' => $this->value,
            'attack_bonus' => $this->attackBonus,
            'defense_bonus' => $this->defenceBonus,
            'health_bonus' => $this->healthBonus,
            'special_effect' => $this->specialEffect
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
            $insertedId = $database->insert('item', $itemData);
            // Set the ID for this item
            $this->setId($insertedId);
            return true;
        } catch (\Exception $e) {
            //throw new \Exception("Insert failed: " . $e->getMessage());
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