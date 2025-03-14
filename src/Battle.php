<?php

namespace Game;

/**
 * Battle class manages fights between two characters
 */
class Battle 
{
    public string $battleLog;
    public int $maxRounds = 10;
    public int $roundNumber = 1;

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

        while (($fighter1->health > 0 && $fighter2->health > 0) && ($this->roundNumber <= $this->maxRounds)) {
            $this->battleLog .= "\nRound " . $this->roundNumber . ":\n";
            
            // Fighter 1's turn
            $damage = max(0, $fighter1->attack - $fighter2->defense);
            $fighter2->health -= $damage;
            $this->battleLog .= $fighter1->name . " hits " . $fighter2->name . " for " . $damage . " damage!\n";
            $this->battleLog .= $fighter2->name . " has " . $fighter2->health . " health remaining.\n";

            if ($fighter2->health <= 0) {
                $this->battleLog .= "\n" . $fighter1->name . " wins the battle!";
                return $this->battleLog;
            }

            // Fighter 2's turn
            $damage = max(0, $fighter2->attack - $fighter1->defense);
            $fighter1->health -= $damage;
            $this->battleLog .= $fighter2->name . " hits " . $fighter1->name . " for " . $damage . " damage!\n";
            $this->battleLog .= $fighter1->name . " has " . $fighter1->health . " health remaining.\n";

            if ($fighter1->health <= 0) {
                $this->battleLog .= "\n" . $fighter2->name . " wins the battle!";
                return $this->battleLog;
            }

            $this->roundNumber++;
        }

        // Maximum rounds reached without a winner
        $this->battleLog .= "\nMaximum rounds (" . $this->maxRounds . ") reached! It's a draw!";

        return $this->battleLog;
    }
} 