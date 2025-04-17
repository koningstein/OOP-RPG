<?php

namespace Game;

class Mage extends Character
{

    private int $mana;
    private int $originalMana;

    public function __construct(string $name, string $role, int $health, int $attack, int $defense = 3, int $range = 5, int $mana = 150)
    {
        parent::__construct($name, $role, $health, $attack, $defense, $range);
        $this->mana = $mana;
        $this->originalMana = $mana;
        $this->specialAttacks = ['fireball', 'frostNova'];
    }

    /**
     * @return int
     */
    public function getMana(): int
    {
        return $this->mana;
    }

    /**
     * @param int $mana
     * @return void
     */
    public function setMana(int $mana): void
    {
        $this->mana = $mana;
    }

    public function getSummary(): string
    {
        $parentSummary = parent::getSummary();
        return "{$parentSummary}. This mage commands {$this->mana} mana for casting spells";
    }

    /**
     * @return string
     */
    public function castFireball(): string
    {
        if($this->mana < 30) {
            return "Not enough mana for fireball!";
        }
        $modificationResult = $this->modifyTemporaryStats(
            (int)ceil(0.5 * $this->attack),
            (int)ceil(0.8 * $this->defense)
        );
        $this->mana -= 30;
        return "Cast fireball! {$modificationResult}";
    }

    /**
     * Casts a frost nova attack
     * @return string
     */
    public function castFrostNova(): string
    {
        if ($this->mana < 45) {
            return "Not enough mana for frost nova!";
        }
        $modificationResult = $this->modifyTemporaryStats(
            (int)ceil(0.4 * $this->attack),
            (int)ceil(1.2 * $this->defense)
        );
        $this->mana -= 45;
        return "Cast frost nova! {$modificationResult}";
    }

    /**
     * Executes a special attack based on the attack name
     * @param string $attackName
     * @return string
     */
    public function executeSpecialAttack(string $attackName): string
    {
        switch ($attackName) {
            case 'fireball':
                return $this->castFireball();
            case 'frostNova':
                return $this->castFrostNova();
            default:
                return "Unknown attack: {$attackName}";
        }
    }

    public function resetAttributes(): void
    {
        $this->mana = $this->originalMana; // Reset to the original value
    }
}