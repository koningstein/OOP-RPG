<?php

namespace Game;

use Game\Database;

/**
 * DatabaseManager is a singleton class that manages the database instance.
 */
class DatabaseManager
{
    /**
     * @var ?Database The singleton instance of the database
     */
    private static ?Database $instance = null;

    /**
     * Sets the database instance.
     *
     * @param Database $database The database instance to set
     * @return void
     */
    public static function setInstance(Database $database): void
    {
        self::$instance = $database;
    }

    /**
     * Gets the current database instance.
     *
     * @return ?Database The current database instance or null if not set
     */
    public static function getInstance(): ?Database
    {
        return self::$instance;
    }

    /**
     * Checks if a database instance is set.
     *
     * @return bool True if a database instance is set, false otherwise
     */
    public static function hasInstance(): bool
    {
        return self::$instance !== null;
    }
}
