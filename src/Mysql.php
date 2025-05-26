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
        try {
            // Build the column names and placeholders
            $columns = array_keys($data);
            $placeholders = ':' . implode(', :', $columns);
            $columnList = implode(', ', $columns);
            // Build the complete INSERT query
            $sql = "INSERT INTO {$table} ({$columnList}) VALUES ({$placeholders})";
            // Prepare the statement
            $stmt = $this->connection->prepare($sql);
            // Bind all values
            foreach ($data as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            // Execute the statement
            $stmt->execute();
            // Return the last inserted ID
            return (int)$this->connection->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Insert failed: " . $e->getMessage());
        }
    }


    /**
     * Selects records from the specified table
     * @param string[][] $tableColumns The name of the table
     * @param string[] $conditions Associative array of column => value pairs for WHERE clause
     * @return string[][] Array of associative arrays representing the selected records
     * @throws Exception
     */
    public function select(array $tableColumns, array $conditions = []): array
    {
        try {
            // Build the SELECT part of the query
            $selectParts = [];

            foreach ($tableColumns as $table => $columns) {
                foreach ($columns as $column) {
                    if ($column === '*') {
                        $selectParts[] = "$table.*";
                    } else {
                        $selectParts[] = "$table.$column";
                    }
                }
            }

            $selectClause = implode(', ', $selectParts);

            // Build the FROM part of the query
            $tables = array_keys($tableColumns);
            $fromClause = implode(', ', $tables);

            // Build the complete query
            $sql = "SELECT $selectClause FROM $fromClause";

            // Add WHERE clause if conditions are provided
            $whereConditions = [];
            $parameters = [];
            $paramCount = 0;

            if (!empty($conditions)) {
                foreach ($conditions as $key => $value) {
                    $paramName = 'param' . $paramCount++;

                    // Check for special operators in the key
                    if (strpos($key, ' LIKE') !== false) {
                        // LIKE operator
                        $columnName = str_replace(' LIKE', '', $key);
                        $whereConditions[] = "$columnName LIKE :$paramName";
                        $parameters[$paramName] = "%$value%"; // Add wildcards
                    } elseif (strpos($key, ' BETWEEN') !== false) {
                        // BETWEEN operator
                        $columnName = str_replace(' BETWEEN', '', $key);
                        if (is_array($value) && count($value) === 2) {
                            $whereConditions[] = "$columnName BETWEEN :param{$paramCount} AND :param" . ($paramCount + 1);
                            $parameters['param' . $paramCount++] = $value[0];
                            $parameters['param' . $paramCount] = $value[1];
                        }
                    } elseif (preg_match('/\s+[<>=!]+$/', $key)) {
                        // Other comparison operators (>, <, >=, <=, !=)
                        $parts = preg_split('/\s+/', trim($key), 2);
                        if (count($parts) === 2) {
                            $columnName = $parts[0];
                            $operator = $parts[1];
                            $whereConditions[] = "$columnName $operator :$paramName";
                            $parameters[$paramName] = $value;
                        }
                    } elseif (strpos($key, '.') !== false && strpos($value, '.') !== false) {
                        // For table.column=table.column comparisons (no parameter binding needed)
                        $whereConditions[] = "$key=$value";
                    } else {
                        // Default: equality comparison
                        $whereConditions[] = "$key = :$paramName";
                        $parameters[$paramName] = $value;
                    }
                }

                // Add WHERE clause to SQL
                if (!empty($whereConditions)) {
                    $sql .= " WHERE " . implode(' AND ', $whereConditions);
                }
            }

            // Prepare and execute the statement
            $stmt = $this->connection->prepare($sql);

            // Bind parameters - the PDO::PARAM_* type will be determined automatically
            foreach ($parameters as $name => $value) {
                // Let PDO handle the parameter type based on PHP variable type
                // This works correctly for strings (PDO::PARAM_STR), integers (PDO::PARAM_INT), etc.
                $stmt->bindValue(":$name", $value);
            }

            $stmt->execute();

            // Return all results
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Select failed: " . $e->getMessage());
        }
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
        try {
            // Controleer of er een ID is meegegeven in de conditions
            if (!isset($conditions['id'])) {
                throw new Exception("ID is required for update operations");
            }

            // Bouw de SET clause
            $setClause = [];
            $paramCounter = 0;
            foreach ($data as $column => $value) {
                $placeholder = "set_param{$paramCounter}";
                $setClause[] = "{$column} = :{$placeholder}";
                $paramCounter++;
            }
            $setClauseString = implode(', ', $setClause);

            // Bouw de WHERE clause (alleen op ID)
            $whereClause = "id = :where_id";

            // Bouw de complete query
            $sql = "UPDATE {$table} SET {$setClauseString} WHERE {$whereClause}";

            // Prepare de statement
            $statement = $this->connection->prepare($sql);

            // Bind de SET parameters
            $paramCounter = 0;
            foreach ($data as $column => $value) {
                $placeholder = "set_param{$paramCounter}";
                $statement->bindValue(":{$placeholder}", $value);
                $paramCounter++;
            }

            // Bind de WHERE parameter
            $statement->bindValue(':where_id', $conditions['id']);

            // Voer de query uit
            $statement->execute();

            // Return het aantal affected rows
            return $statement->rowCount();

        } catch(PDOException $error) {
            throw new Exception("Update failed: " . $error->getMessage());
        }
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
        try {
            // Controleer of er condities zijn meegegeven (veiligheid)
            if (empty($conditions)) {
                throw new Exception("Conditions are required for delete operations for safety reasons");
            }
            // Controleer specifiek of er een ID is meegegeven
            if (!isset($conditions['id'])) {
                throw new Exception("ID is required for delete operations");
            }
            $sql = "DELETE FROM {$table} WHERE id = :id"; // Bouw de DELETE query (alleen ID-gebaseerd voor veiligheid)
            $stmt = $this->connection->prepare($sql); // Prepare de statement
            $stmt->bindValue(':id', $conditions['id']); // Bind de ID parameter
            $stmt->execute(); // Voer de query uit
            return $stmt->rowCount(); // Return het aantal affected rows
        } catch (PDOException $e) {
            throw new Exception("Delete failed: " . $e->getMessage());
        }
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