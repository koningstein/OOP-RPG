<?php

namespace Game;

/**
 * Battle class manages fights between two characters
 */
class Battle 
{
    private array $battleLog = [];
    private int $maxRounds = 10;
    private int $roundNumber = 1;
    private int $fighter1OriginalHealth;
    private int $fighter2OriginalHealth;

    /**
     * @param int $maxRounds
     * @return void
     */
    public function changeMaxRounds(int $maxRounds): void
    {
        $this->maxRounds = $maxRounds;
    }

    public function resetBattle(): void
    {
        $this->battleLog = [];
        $this->roundNumber = 1;
    }

    public function startFight(Character $fighter1, Character $fighter2, int $round = 1): array
    {
        $this->resetBattle();
        $this->battleLog[] = "Battle Start!";
        // Store original health
        $this->fighter1OriginalHealth = $fighter1->getHealth();
        $this->fighter2OriginalHealth = $fighter2->getHealth();

        $this->roundNumber = $round;
        return $this->battleLog;
    }



    public function executeTurn(Character $fighter1, Character $fighter2): void
    {
        // Fighter 1 attacks Fighter 2
        $damage1 = $this->calculateDamage($fighter1, $fighter2);
        $fighter2->takeDamage($damage1);
        $this->battleLog[] = "{$fighter1->getName()} attacks {$fighter2->getName()} for {$damage1} damage!";
        if ($fighter2->getHealth() <= 0) {
            $this->battleLog[] = "{$fighter2->getName()} has been defeated!";
            return; // End the turn if Fighter 2 is defeated
        }

        // Fighter 2 attacks Fighter 1
        $damage2 = $this->calculateDamage($fighter2, $fighter1);
        $fighter1->takeDamage($damage2);
        $this->battleLog[] = "{$fighter2->getName()} attacks {$fighter1->getName()} for {$damage2} damage!";
        if ($fighter1->getHealth() <= 0) {
            $this->battleLog[] = "{$fighter1->getName()} has been defeated!";
        }
    }

    public function endBattle(Character $fighter1, Character $fighter2): void
    {
        // Reset health to original values
        $fighter1->setHealth($this->fighter1OriginalHealth);
        $fighter2->setHealth($this->fighter2OriginalHealth);
    }

    /**
     * @return array
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

    public function setRoundNumber(int $round): void
    {
        $this->roundNumber = $round;
    }

    private function calculateDamage(Character $attacker, Character $defender): int
    {
        $randomFactor = rand(70, 100) / 100;
        $attackValue = $attacker->getAttack() * $randomFactor;
        $damageWithFactor = $attackValue - $defender->getDefense();

        return max(0, (int)round($damageWithFactor));
    }
} 