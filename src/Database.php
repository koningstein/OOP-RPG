<?php

namespace Game;

/**
 * DatabaseInterface defines the contract for database operations
 * This interface ensures any database implementation provides the standard CRUD operations
 * Note: Implementations should establish database connection in their constructor
 */
interface DatabaseInterface
{
    /**
     * Inserts a new record into the specified table
     *
     * @param string $table The name of the table
     * @param array $data Associative array of column => value pairs
     * @return int The ID of the newly inserted record
     */
    public function insert(string $table, array $data): int;

    /**
     * Selects records from the specified table
     *
     * @param string $table The name of the table
     * @param array $conditions Associative array of column => value pairs for WHERE clause
     * @param array $fields Array of field names to select (default: ['*'] for all fields)
     * @return array Array of associative arrays representing the selected records
     */
    public function select(string $table, array $conditions = [], array $fields = ['*']): array;

    /**
     * Updates records in the specified table
     *
     * @param string $table The name of the table
     * @param array $data Associative array of column => value pairs to update
     * @param array $conditions Associative array of column => value pairs for WHERE clause
     * @return int The number of affected rows
     */
    public function update(string $table, array $data, array $conditions): int;

    /**
     * Deletes records from the specified table
     *
     * @param string $table The name of the table
     * @param array $conditions Associative array of column => value pairs for WHERE clause
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