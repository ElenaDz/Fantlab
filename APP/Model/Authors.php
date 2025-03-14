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

    public static function add($name)
    {
        $prepare = self::getPDO()->prepare(
            'INSERT INTO 
                    authors 
                    (`name`, `birthday`, `death`, `country`, `cover`) 
                VALUES 
                    (:name, :birthday, :death, :country, :cover)'
        );

        $prepare->execute([
            'name' => $name,
            'birthday' => '1990-01-01',
            'death' => '1999-01-01',
            'country' => 'США',
            'cover' => '0'
        ]);

        return  self::getPDO()->lastInsertId();
    }

    public static function getAll(): array
    {
        $results = self::getPDO()->query(
            'SELECT authors.* , count(authors.id) as count_book
			FROM authors
            JOIN books on authors.id = books.author_id
            GROUP BY authors.id'
        );

        return $results->fetchAll(
            \PDO::FETCH_CLASS,
            Author::class
        );
    }

    /**
     * @param $name
     * @return boolean|Author
     */
    public static function getByName($name)
    {
        $pdo = self::getPDO();

        $results = $pdo->query (
            'SELECT * FROM authors WHERE name ='. $pdo->quote($name)
        );

        return $results->fetchObject(
            Author::class
        );
    }
}