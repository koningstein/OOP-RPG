<?php

namespace Game;

/**
 * Battle class manages fights between two characters
 */
class Battle 
{
    private string $battleLog;
    private int $maxRounds = 10;
    private int $roundNumber = 1;

    /**
     * @param int $maxRounds
     * @return void
     */
    public function changeMaxRounds(int $maxRounds): void
    {
        $this->maxRounds = $maxRounds;
    }

    /**
     * Starts and manages a fight between two characters
     * @param Character $fighter1
     * @param Character $fighter2
     * @return string
     */
    public function startFight(Character $fighter1, Character $fighter2): string
    {
        // Reset battleLog en roundNumber aan het begin van het gevecht
        $this->roundNumber = 1;
        $this->battleLog = "Battle Start!<br><br>";

        // Kopie van originele health-waardes om te kunnen resetten na het gevecht
        $fighter1OriginalHealth = $fighter1->getHealth();
        $fighter2OriginalHealth = $fighter2->getHealth();

        while (($fighter1->getHealth() > 0 && $fighter2->getHealth() > 0) && ($this->roundNumber <= $this->maxRounds)) {
            $this->battleLog .= "Round " . $this->roundNumber . ":<br>";

            // Fighter 1's turn
            $damage = $this->calculateDamage($fighter1, $fighter2);
            $fighter2->takeDamage($damage);
            $this->battleLog .= $fighter1->getName() . " hits " . $fighter2->getName() . " for " . $damage . " damage!<br>";
            $this->battleLog .= $fighter2->getName() . " has " . $fighter2->getHealth() . " health remaining.<br>";

            if ($fighter2->getHealth() <= 0) {
                $this->battleLog .= "<br>" . $fighter1->getName() . " wins the battle!";

                // We resetten de health waarden NIET meer hier
                // De originele health waarden worden later gebruikt in de template

                return $this->battleLog;
            }

            // Fighter 2's turn
            $damage = $this->calculateDamage($fighter2, $fighter1);
            $fighter1->takeDamage($damage);
            $this->battleLog .= $fighter2->getName() . " hits " . $fighter1->getName() . " for " . $damage . " damage!<br>";
            $this->battleLog .= $fighter1->getName() . " has " . $fighter1->getHealth() . " health remaining.<br><br>";

            if ($fighter1->getHealth() <= 0) {
                $this->battleLog .= "<br>" . $fighter2->getName() . " wins the battle!";

                // We resetten de health waarden NIET meer hier
                // De originele health waarden worden later gebruikt in de template

                return $this->battleLog;
            }

            $this->roundNumber++;
        }

        // Maximum rounds reached without a winner
        $this->battleLog .= "Maximum rounds (" . $this->maxRounds . ") reached! It's a draw!";

        // We resetten de health waarden NIET meer hier
        // De originele health waarden worden later gebruikt in de template

        return $this->battleLog;
    }

    /**
     * @return string
     */
    public function getBattleLog(): string
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

        return max(0, (int)round($damageWithFactor));
    }
} 