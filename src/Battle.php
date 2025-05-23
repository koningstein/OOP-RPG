<?php

namespace Game;

/**
 * Battle class manages fights between two characters
 */
class Battle 
{
    /**
     * @var string[] $battleLog
     */
    private array $battleLog = [];
    private int $maxRounds;
    private int $roundNumber = 1;
    private int $fighter1OriginalHealth;
    private int $fighter2OriginalHealth;
    private Character $fighter1;
    private Character $fighter2;
    /**
     * @var array<string, string|null> $selectedAttacks
     */
    private array $selectedAttacks = ['fighter1' => null, 'fighter2' => null]; // New property


    public function __construct(Character $fighter1, Character $fighter2, int $maxRounds = 10)
    {
        $this->fighter1 = $fighter1;
        $this->fighter2 = $fighter2;
        $this->maxRounds = $maxRounds;
        $this->battleLog[] = "Battle Start!<br><br>";
        $this->fighter1OriginalHealth = $fighter1->getHealth();
        $this->fighter2OriginalHealth = $fighter2->getHealth();
        $this->fighter1->resetTempstats();
        $this->fighter2->resetTempstats();
    }

    /**
     * Sets the selected attack for a fighter
     * @param Character $fighter
     * @param ?string $attackName
     * @return void
     */
    public function setAttackForFighter(Character $fighter, ?string $attackName): void
    {
        if ($fighter === $this->fighter1) {
            $this->selectedAttacks['fighter1'] = $attackName;
        } elseif ($fighter === $this->fighter2) {
            $this->selectedAttacks['fighter2'] = $attackName;
        }
    }

    public function executeTurn(): void
    {
        $this->battleLog[] = "<strong>Round {$this->roundNumber}:</strong>";
        $this->executeAttack($this->fighter1, $this->fighter2, $this->selectedAttacks['fighter1']);

        if ($this->fighter2->getHealth() <= 0) {
            return; // End battle if Fighter 2 is defeated
        }
        // Fighter 2's turn
        $this->executeAttack($this->fighter2, $this->fighter1, $this->selectedAttacks['fighter2']);
        $this->battleLog[] = "";
        // Reset selected attacks at the end of the round
        $this->selectedAttacks = ['fighter1' => null, 'fighter2' => null];
        $this->fighter1->resetTempstats();
        $this->fighter2->resetTempstats();
        $this->roundNumber++;
    }

    private function executeAttack(Character $attacker,
                                   Character $defender, ?string $specialAttack): void
    {
        if ($specialAttack) {
            // Execute special attack
            $result = $attacker->executeSpecialAttack($specialAttack);
            $this->battleLog[] = "{$attacker->getName()} uses {$specialAttack}: {$result}";
        } else {
            // Normal attack
            $this->battleLog[] = "{$attacker->getName()} performs a normal attack.";
        }

        // Calculate attack and defense values
        $standardAttack = $attacker->getAttack() - $attacker->getTempAttack(); // Base attack
        $modifiedAttack = $attacker->getTempAttack(); // Temporary attack modifier

        $standardDefense = $defender->getDefense() - $defender->getTempDefense(); // Base defense
        $modifiedDefense = $defender->getTempDefense(); // Temporary defense modifier


        // Log attack and defense details
//        $this->battleLog[] = "{$attacker->getName()} Details: Standard = {$standardAttack}, Modified = {$modifiedAttack}";
//        $this->battleLog[] = "{$defender->getName()} Details: Standard = {$standardDefense}, Modified = {$modifiedDefense}";

        $damage = $this->calculateDamage($attacker, $defender);
        $defender->takeDamage($damage);
        $this->battleLog[] = "{$attacker->getName()} attacks {$defender->getName()} for {$damage} damage!";
        if ($defender->getHealth() <= 0) {
            $this->battleLog[] = "{$defender->getName()} has been defeated!";
        }
    }

    public function endBattle(): void
    {
        $this->fighter1->setHealth($this->fighter1OriginalHealth);
        $this->fighter2->setHealth($this->fighter2OriginalHealth);

        // Reset unique attributes
        $this->fighter1->resetAttributes();
        $this->fighter2->resetAttributes();
    }


    /**
     * @param int $maxRounds
     * @return void
     */
    public function changeMaxRounds(int $maxRounds): void
    {
        $this->maxRounds = $maxRounds;
    }

    /**
     * @return string[]
     */
    public function getBattleLog(): array
    {
        return $this->battleLog;
    }

    /**
     * @return int
     */
    public function getMaxRounds(): int
    {
        return $this->maxRounds;
    }

    /**
     * @return int
     */
    public function getRoundNumber(): int
    {
        return $this->roundNumber;
    }

    private function calculateDamage(Character $attacker, Character $defender): int
    {
        $randomFactor = rand(70, 100) / 100;
        $attackValue = $attacker->getAttack() * $randomFactor;
        $damageWithFactor = $attackValue - $defender->getDefense();

        // Log the random factor and adjusted attack value
//        $this->battleLog[] = "{$attacker->getName()}'s attack is modified by a random factor of " . round($randomFactor * 100) . "%.";
//        $this->battleLog[] = "Adjusted attack value: " . round($attackValue) . ".";

        return max(0, (int)round($damageWithFactor));
    }

    public function getFighter1(): Character
    {
        return $this->fighter1;
    }

    public function getFighter2(): Character
    {
        return $this->fighter2;
    }

    public function getFighter1OriginalHealth(): int
    {
        return $this->fighter1OriginalHealth;
    }

    public function getFighter2OriginalHealth(): int
    {
        return $this->fighter2OriginalHealth;
    }
} 