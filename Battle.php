<?php

namespace Game\Combat;

use Game\Characters\Character;

class Battle 
{
    public function startFight(Character $fighter1, Character $fighter2)
    {
        $round = 1;
        $battleLog = "Battle Start!\n";

        while ($fighter1->health > 0 && $fighter2->health > 0) {
            $battleLog .= "\nRound " . $round . ":\n";
            
            // Fighter 1's turn
            $damage = max(0, $fighter1->attack - $fighter2->defense);
            $fighter2->health -= $damage;
            $battleLog .= $fighter1->name . " hits " . $fighter2->name . " for " . $damage . " damage!\n";
            $battleLog .= $fighter2->name . " has " . $fighter2->health . " health remaining.\n";

            if ($fighter2->health <= 0) {
                $battleLog .= "\n" . $fighter1->name . " wins the battle!";
                return $battleLog;
            }

            // Fighter 2's turn
            $damage = max(0, $fighter2->attack - $fighter1->defense);
            $fighter1->health -= $damage;
            $battleLog .= $fighter2->name . " hits " . $fighter1->name . " for " . $damage . " damage!\n";
            $battleLog .= $fighter1->name . " has " . $fighter1->health . " health remaining.\n";

            if ($fighter1->health <= 0) {
                $battleLog .= "\n" . $fighter2->name . " wins the battle!";
                return $battleLog;
            }

            $round++;
        }

        return $battleLog;
    }
} 