<?php

namespace Game;

use Exception;
use PDO;
use PDOException;

class Mysql implements Database
{
    private PDO $connection;

    public function __construct(string $host, string $database, string $username, string $password)
    {
        try{
            $this->connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    /**
     * @param string $table
     * @param string[] $data
     * @return int
     * @throws Exception
     */
    public function insert(string $table, array $data): int
    {
        // TODO: Implement insert() method.
        throw new Exception('Not implemented yet');
    }

    /**
     * Selects records from the specified table
     *
     * @param string $table The name of the table
     * @param string[] $conditions Associative array of column => value pairs for WHERE clause
     * @param string[] $fields Array of field names to select (default: ['*'] for all fields)
     * @return string[] Array of associative arrays representing the selected records
     * @throws Exception
     */
    public function select(string $table, array $conditions = [], array $fields = ['*']): array
    {
        // TODO: Implement select() method.
        throw new Exception('Not implemented yet');
    }

    /**
     * Updates records in the specified table
     *
     * @param string $table The name of the table
     * @param string[] $data Associative array of column => value pairs to update
     * @param string[] $conditions Associative array of column => value pairs for WHERE clause
     * @return int The number of affected rows
     * @throws Exception
     */
    public function update(string $table, array $data, array $conditions): int
    {
        // TODO: Implement update() method.
        throw new Exception('Not implemented yet');
    }

    /**
     * Deletes records from the specified table
     *
     * @param string $table The name of the table
     * @param string[] $conditions Associative array of column => value pairs for WHERE clause
     * @return int The number of deleted rows
     * @throws Exception
     */
    public function delete(string $table, array $conditions): int
    {
        // TODO: Implement delete() method.
        throw new Exception('Not implemented yet');
    }

    /**
     * Gets the ID of the last inserted record
     *
     * @return int The last insert ID
     * @throws Exception
     */
    public function getLastInsertId(): int
    {
        // TODO: Implement getLastInsertId() method.
        throw new Exception('Not implemented yet');
    }

    /**
     * Tests if the database connection is working
     *
     * @return bool True if connection is working, false otherwise
     */
    public function testConnection(): bool
    {
        // TODO: Implement testConnection() method.
        try {
            // Simple query to test the connection
            $stmt = $this->connection->query("SELECT 1");
            return $stmt !== false;
        } catch (PDOException $e) {
            return false;
        }
    }
}