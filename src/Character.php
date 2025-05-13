<?php

namespace Game;

/**
 * Character class represents a game character with various attributes
 */
abstract class Character
{
    private Inventory $inventory;
    private string $name;
    private string $role;
    private int $health;
    protected int $attack;
    protected int $defense;
    private int $range;
    protected int $tempAttack = 0;
    protected int $tempDefense = 0;
    public static int $totalCharacters = 0;

    /**
     * @var string[] $characterTypes
     */
    public static array $characterTypes = [];
    /**
     * @var string[] $existingNames
     */
    public static array $existingNames = [];

    /**
     * @var string[] $specialAttacks
     */
    protected array $specialAttacks = [];

    public function __construct(string $name,
                                string $role,
                                int $health,
                                int $attack,
                                int $defense = 5,
                                int $range = 1)
    {
        $this->name = $name;
        $this->role = $role;
        $this->health = $health;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->range = $range;

        $this->inventory = new Inventory();

        self::$totalCharacters++;
        self::$characterTypes[] = $this->role;
        self::$existingNames[] = $this->name;
    }

    /**
     * Displays all stats of the character
     * @return string
     */
    public function displayStats(): string
    {
        return "<h3>Character Stats:</h3>" .
               "Name: " . $this->name . "\n" .
               "Role: " . $this->role . "\n" .
               "Health: " . $this->health . "\n" .
               "Attack: " . $this->attack . "\n" .
               "Defense: " . $this->defense . "\n" .
               "Range: " . $this->range . "\n";
    }

    /**
     * Sets a new health value for the character
     * @param int $newHealth
     * @return string
     */
    public function setHealth(int $newHealth): string
    {
        if ($newHealth < 0) {
            return "Error: Health cannot be set to a negative value";
        }
        $this->health = $newHealth;
        return "Health set to: " . $this->health;
    }

    /**
     * Gets the attack value of the character
     * @return int
     */
    public function getAttack(): int
    {
        return $this->attack + $this->tempAttack;
    }

    /**
     * Returns a brief summary of the character
     * @return string
     */
    public function getSummary(): string
    {
        return $this->name . " is a " . $this->role . " with " . $this->health . " health";
    }

    /**
     * Reduces the character's health by the specified amount
     * @param int $amount
     */
    public function takeDamage(int $amount): void
    {
        if ($amount < $this->health) {
            $this->health -= $amount;
        } else {
            $this->health = 0;
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
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @return int
     */
    public function getDefense(): int
    {
        return $this->defense + $this->tempDefense;
    }

    /**
     * @return int
     */
    public function getRange(): int
    {
        return $this->range;
    }

    /**
     * @return Inventory
     */
    public function getInventory(): Inventory
    {
        return $this->inventory;
    }

    /**
     * Returns the available special attacks
     * @return string[]
     */
    public function getSpecialAttacks(): array
    {
        return $this->specialAttacks;
    }

    /**
     * @return int
     */
    public function getTempAttack(): int
    {
        return $this->tempAttack;
    }

    /**
     * @return int
     */
    public function getTempDefense(): int
    {
        return $this->tempDefense;
    }


    /**
     * Modifies the temporary attack and defense stats
     * @param int $attackMod
     * @param int $defenseMod
     * @return string
     */
    protected function modifyTemporaryStats(int $attackMod, int $defenseMod): string
    {
        $this->tempAttack = $attackMod;
        $this->tempDefense = $defenseMod;
        return "Temporary stats modified: Attack = {$this->tempAttack}, Defense = {$this->tempDefense}";
    }

    public function resetTempstats(): void
    {
        $this->tempAttack = 0;
        $this->tempDefense = 0;
    }

    private static function loadFromSession(): void
    {
        if (isset($_SESSION['characterStats'])) {
            $stats = $_SESSION['characterStats'];
            self::$totalCharacters = $stats['totalCharacters'];
            self::$characterTypes = $stats['characterTypes'];
            self::$existingNames = $stats['existingNames'];
        }
    }

    private static function saveToSession(): void
    {
        $_SESSION['characterStats'] = [
            'totalCharacters' => self::$totalCharacters,
            'characterTypes' => self::$characterTypes,
            'existingNames' => self::$existingNames,
        ];
    }

    public static function initializeSession(): void
    {
        self::loadFromSession();
    }

    public static function saveSession(): void
    {
        self::saveToSession();
    }

    public static function getTotalCharacters(): int
    {
        return self::$totalCharacters;
    }

    public static function getAllCharacterNames(): array
    {
        return self::$existingNames;
    }

    public static function getAllCharacterTypes(): array
    {
        return self::$characterTypes;
    }

    public static function resetAllStatistics(): void
    {
        self::$totalCharacters = 0;
        self::$characterTypes = [];
        self::$existingNames = [];
    }

    public static function recalculateStatistics(CharacterList $characterList): void
    {
        self::resetAllStatistics();
        foreach ($characterList->getCharacters() as $character) {
            self::$totalCharacters++;
            self::$characterTypes[] = $character->getRole();
            self::$existingNames[] = $character->getName();
        }
    }

    public static function removeCharacterFromStats(string $name, string $role): void
    {
        $nameKey = array_search($name, self::$existingNames);
        $roleKey = array_search($role, self::$characterTypes);

        if ($nameKey !== false && $roleKey !== false) {
            self::$totalCharacters--;
            unset(self::$existingNames[$nameKey]);
            unset(self::$characterTypes[$roleKey]);

            self::$existingNames = array_values(self::$existingNames);
            self::$characterTypes = array_values(self::$characterTypes);
        }
    }

    abstract public function executeSpecialAttack(string $attackName): string;
    abstract public function resetAttributes(): void;
} 
