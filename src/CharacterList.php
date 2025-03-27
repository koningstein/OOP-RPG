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

    /**
     * @param string $name
     * @return Character|string
     */
    public function getCharacter(string $name): Character|string
    {
        foreach ($this->characters as $character) {
            if ($character->getName() == $name) {
                return $character;
            }
        }
        return "Character not found in list";
    }

    /**
     * @param Character $character
     * @return string
     */
    public function removeCharacter(Character $character): string
    {
        $key = array_search($character, $this->characters);
        if ($key !== false) {
            unset($this->characters[$key]);
            return "Character {$character->getName()} removed from list";
        }
        return "Character not found in list";
    }


}