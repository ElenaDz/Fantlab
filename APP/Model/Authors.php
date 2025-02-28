<?php

namespace APP\Model;


use APP\Entity\Author;

class Authors extends \APP\Entity\Author
{
    private static $pdo;

    public static function getPDO(): \PDO
    {
        if (empty(self::$pdo)) {
            self::$pdo = new \PDO('mysql:host=localhost;dbname=fantlab', 'root', '');
        }
        return self::$pdo;
    }

    public static function getAll(): array
    {
        $results = self::getPDO()->query(
            'SELECT * FROM authors'
        );

        return $results->fetchAll(
            \PDO::FETCH_CLASS,
            Author::class
        );
    }

    public static function getByName($name): Author
    {

        $results = self::getPDO()->query(
            'SELECT * FROM authors WHERE name ="'.$name.'"'
        );

        return $results->fetchObject(
            Author::class
        );
    }
}