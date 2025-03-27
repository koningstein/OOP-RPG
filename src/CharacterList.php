<?php

namespace Game;

/**
 * Character class represents a game character with various attributes
 */
class CharacterList
{
    private array $characters = [];

    /**
     * @param Character $character
     * @return string
     */
    public function addCharacter(Character $character): string
    {
        $this->characters[] = $character;
        return "Character {$character->getName()} added to list";
    }

    /**
     * @return array
     */
    public function getCharacters(): array
    {
        return $this->characters;
    }


}