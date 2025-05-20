<?php

namespace Game;

use Exception;
use PDO;
use PDOException;

class Mysql implements Database
{
    private PDO $connection;

    /**
     * @param string $host
     * @param string $database
     * @param string $user
     * @param string $password
     */
    public function __construct(string $host, string $database, string $user, string $password)
    {
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        } catch(PDOException $error) {
            throw new PDOException($error->getMessage());
        }
    }

    /**
     *  INSERT INTO tablename SET kolom1=waarde1, kolom2=waarde2
     *  INSERT INTO tablename (kolom1, kolom2, kolom3) VALUES (waarde1, waarde2, waarde3)
     *   $table = user, data = ['username', 'password']
     *  return id van rij die geinsert is
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
     * UPDATE user SET username=:username, password=:password WHERE id=5
     * return hoeveel rijen geupdate zijn
     * @param string $table
     * @param string[] $data
     * @param string[] $conditions
     * @return int
     * @throws Exception
     */
    public function update(string $table, array $data, array $conditions): int
    {
        // TODO: Implement update() method.
        throw new Exception('Not implemented yet');
    }

    /**
     *  DELETE FROM user WHERE id=:id
     *  return hoeveel rijen verwijderd zijn
     * @param string $table
     * @param string[] $conditions
     * @return int
     * @throws Exception
     */
    public function delete(string $table, array $conditions): int
    {
        // TODO: Implement delete() method.
        throw new Exception('Not implemented yet');
    }

    /**
     *  SELECT kolom1, kolom2 FROM tablename
     *  SELECT kolom1, kolom2 FROM tablename, tablename2
     *  SELECT user.name, schoolclass.name FROM user, schoolclass WHERE user.schoolclassid = schoolclass.id
     *  SELECT user.name FROM user WHERE schoolclass.name LIKE '_M%'
     *  SELECT user.name FROM user WHERE id=5
     *  SELECT order.date FROM order WHERE order.date BETWEEN 10-5-2002 AND 15-5-2003
     *
     *  $tableColumns = ['user' => [name, email]
     *           'order'=> [ id, date]
     *  ]
     *  $conditions = [
     *      user.id = 5,
     *      order.name LIKE '%O%'
     *  ]
     * @param string[][] $tableColumns
     * @param string[] $conditions
     * @return array
     * @throws Exception
     */
    public function select(array $tableColumns, array $conditions): array
    {
        // TODO: Implement select() method.
        throw new Exception('Not implemented yet');
    }

    /**
     * @return bool
     */
    public function testConnection(): bool
    {
        // TODO: Implement testConnection() method.
        try {
            $test = $this->connection->query("SELECT 1");
            return $test !== false;
        }catch(PDOException $error){
            return false;
        }
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getLastInsertId(): int
    {
        // TODO: Implement getLastInsertId() method.
        throw new Exception('Not implemented yet');
    }
}