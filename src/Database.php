<?php

namespace Game;

/**
 * DatabaseInterface defines the contract for database operations
 * This interface ensures any database implementation provides the standard CRUD operations
 * Note: Implementations should establish database connection in their constructor
 */
interface Database
{
    /**
     * @param string $table
     * @param string[] $data
     * @return int
     */
    public function insert(string $table, array $data): int;

    /**
     * @param string[][] $tableColumns
     * @param string[] $conditions
     * @return string[][]
     */
    public function select(array $tableColumns, array $conditions = []): array;

    /**
     * Updates records in the specified table
     *
     * @param string $table The name of the table
     * @param string[] $data Associative array of column => value pairs to update
     * @param string[] $conditions Associative array of column => value pairs for WHERE clause
     * @return int The number of affected rows
     */
    public function update(string $table, array $data, array $conditions): int;

    /**
     * Deletes records from the specified table
     *
     * @param string $table The name of the table
     * @param string[] $conditions Associative array of column => value pairs for WHERE clause
     * @return int The number of deleted rows
     */
    public function delete(string $table, array $conditions): int;

    /**
     * Gets the ID of the last inserted record
     *
     * @return int The last insert ID
     */
    public function getLastInsertId(): int;

    /**
     * Tests if the database connection is working
     *
     * @return bool True if connection is working, false otherwise
     */
    public function testConnection(): bool;
}