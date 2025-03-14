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
     * @param $fighter1
     * @param $fighter2
     * @return string
     */
    public function startFight($fighter1, $fighter2)
    {
        //$battleLog = "Battle Start!\n";
        $this->roundNumber = 1;
        $this->battleLog = "Battle Start!\n";

        while (($fighter1->getHealth() > 0 && $fighter2->getHealth() > 0) && ($this->roundNumber <= $this->maxRounds)) {
            $this->battleLog .= "\nRound " . $this->roundNumber . ":\n";
            
            // Fighter 1's turn
            $damage = max(0, $fighter1->getAttack() - $fighter2->getDefense());
            $fighter2->takeDamage($damage);
            $this->battleLog .= $fighter1->getName() . " hits " . $fighter2->getName() . " for " . $damage . " damage!\n";
            $this->battleLog .= $fighter2->getName() . " has " . $fighter2->getHealth() . " health remaining.\n";

            if ($fighter2->getHealth() <= 0) {
                $this->battleLog .= "\n" . $fighter1->getName() . " wins the battle!";
                return $this->battleLog;
            }

            // Fighter 2's turn
            $damage = max(0, $fighter2->getAttack() - $fighter1->getDefense());
            $fighter1->takeDamage($damage);
            $this->battleLog .= $fighter2->getName() . " hits " . $fighter1->getName() . " for " . $damage . " damage!\n";
            $this->battleLog .= $fighter1->getName() . " has " . $fighter1->getHealth() . " health remaining.\n";

            if ($fighter1->getHealth() <= 0) {
                $this->battleLog .= "\n" . $fighter2->getName() . " wins the battle!";
                return $this->battleLog;
            }

            $this->roundNumber++;
        }

        // Maximum rounds reached without a winner
        $this->battleLog .= "\nMaximum rounds (" . $this->maxRounds . ") reached! It's a draw!";

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
} 