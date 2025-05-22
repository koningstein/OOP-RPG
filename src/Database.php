<?php

namespace Game;

interface Database
{
    /**
     * @param string $host
     * @param string $database
     * @param string $user
     * @param string $password
     */
    public function __construct(string $host, string $database, string $user, string $password);

    /**
     *  INSERT INTO tablename SET kolom1=waarde1, kolom2=waarde2
     *  INSERT INTO tablename (kolom1, kolom2, kolom3) VALUES (waarde1, waarde2, waarde3)
     *   $table = user, data = ['username', 'password']
     *  return id van rij die geinsert is
     * @param string $table
     * @param string[] $data
     * @return int
     */
    public function insert(string $table, array $data): int;

    /**
     * UPDATE user SET username=:username, password=:password WHERE id=5
     * return hoeveel rijen geupdate zijn
     * @param string $table
     * @param string[] $data
     * @param string[] $conditions
     * @return int
     */
    public function update(string $table, array $data, array $conditions): int;

    /**
     *  DELETE FROM user WHERE id=:id
     *  return hoeveel rijen verwijderd zijn
     * @param string $table
     * @param string[] $conditions
     * @return int
     */
    public function delete(string $table, array $conditions): int;

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
     */
    public function select(array $tableColumns, array $conditions): array;

    /**
     * @return bool
     */
    public function testConnection(): bool;




}