<?php

namespace Game;

class DatabaseManager
{
    private static ?Database $instance;

    /**
     * @param Database|null $instance
     */
    public static function setInstance(?Database $instance): void
    {
        self::$instance = $instance;
    }

    /**
     * @return Database|null
     */
    public static function getInstance(): ?Database
    {
        return self::$instance;
    }

    public static function hasInstance(): bool
    {
        return !empty(self::$instance);
    }
}