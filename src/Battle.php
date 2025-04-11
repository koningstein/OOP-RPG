<?php

namespace Game;

/**
 * Battle class manages fights between two characters
 */
class Battle 
{
    private array $battleLog = [];
    private int $maxRounds;
    private int $roundNumber = 1;
    private int $fighter1OriginalHealth;
    private int $fighter2OriginalHealth;
    private Character|Warrior|Mage|Rogue|Healer $fighter1;
    private Character|Warrior|Mage|Rogue|Healer $fighter2;

    public function __construct(Character|Warrior|Mage|Rogue|Healer $fighter1, Character|Warrior|Mage|Rogue|Healer $fighter2, int $maxRounds = 10)
    {
        $this->fighter1 = $fighter1;
        $this->fighter2 = $fighter2;
        $this->maxRounds = $maxRounds;
        $this->battleLog[] = "Battle Start!<br><br>";
        $this->fighter1OriginalHealth = $fighter1->getHealth();
        $this->fighter2OriginalHealth = $fighter2->getHealth();
    }

    public function executeTurn(Character $fighter1, Character $fighter2): void
    {
        $this->executeAttack($fighter1, $fighter2);
        if ($fighter2->getHealth() <= 0) {
            return; // Einde gevecht, Fighter 2 is verslagen
        }
        $this->executeAttack($fighter2, $fighter1);
        $this->roundNumber++;
    }

    private function executeAttack(Character $attacker,
                                   Character $defender): void
    {
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
    }


    /**
     * @param int $maxRounds
     * @return void
     */
    public function changeMaxRounds(int $maxRounds): void
    {
        $this->maxRounds = $maxRounds;
    }

//    /**
//     * Starts and manages a fight between two characters
//     * @param Character $fighter1
//     * @param Character $fighter2
//     * @return string
//     */
//    public function startFight(Character $fighter1, Character $fighter2): string
//    {
//        // Reset battleLog en roundNumber aan het begin van het gevecht
//        $this->roundNumber = 1;
//        $this->battleLog = "Battle Start!<br><br>";
//
//        // Kopie van originele health-waardes om te kunnen resetten na het gevecht
//        $fighter1OriginalHealth = $fighter1->getHealth();
//        $fighter2OriginalHealth = $fighter2->getHealth();
//
//        while (($fighter1->getHealth() > 0 && $fighter2->getHealth() > 0) && ($this->roundNumber <= $this->maxRounds)) {
//            $this->battleLog .= "Round " . $this->roundNumber . ":<br>";
//
//            // Fighter 1's turn
//            $damage = $this->calculateDamage($fighter1, $fighter2);
//            $fighter2->takeDamage($damage);
//            $this->battleLog .= $fighter1->getName() . " hits " . $fighter2->getName() . " for " . $damage . " damage!<br>";
//            $this->battleLog .= $fighter2->getName() . " has " . $fighter2->getHealth() . " health remaining.<br>";
//
//            if ($fighter2->getHealth() <= 0) {
//                $this->battleLog .= "<br>" . $fighter1->getName() . " wins the battle!";
//
//                // We resetten de health waarden NIET meer hier
//                // De originele health waarden worden later gebruikt in de template
//
//                return $this->battleLog;
//            }
//
//            // Fighter 2's turn
//            $damage = $this->calculateDamage($fighter2, $fighter1);
//            $fighter1->takeDamage($damage);
//            $this->battleLog .= $fighter2->getName() . " hits " . $fighter1->getName() . " for " . $damage . " damage!<br>";
//            $this->battleLog .= $fighter1->getName() . " has " . $fighter1->getHealth() . " health remaining.<br><br>";
//
//            if ($fighter1->getHealth() <= 0) {
//                $this->battleLog .= "<br>" . $fighter2->getName() . " wins the battle!";
//
//                // We resetten de health waarden NIET meer hier
//                // De originele health waarden worden later gebruikt in de template
//
//                return $this->battleLog;
//            }
//
//            $this->roundNumber++;
//        }
//
//        // Maximum rounds reached without a winner
//        $this->battleLog .= "Maximum rounds (" . $this->maxRounds . ") reached! It's a draw!";
//
//        // We resetten de health waarden NIET meer hier
//        // De originele health waarden worden later gebruikt in de template
//
//        return $this->battleLog;
//    }

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

    private function calculateDamage(Character $attacker, Character $defender): int
    {
        $randomFactor = rand(70, 100) / 100;
        $attackValue = $attacker->getAttack() * $randomFactor;
        $damageWithFactor = $attackValue - $defender->getDefense();

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