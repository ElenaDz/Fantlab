<?php
namespace APP\Model;

use APP\Entity\Book;

class Books
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
            'SELECT * FROM books'
        );

        return $results->fetchAll(
          \PDO::FETCH_CLASS,
            Book::class
        );
    }

    public static function getById(int $id): Book
    {
        $results = self::getPDO()->query(
            'SELECT * FROM books WHERE id ='.((int)$id)
        );

        return $results->fetchObject(
            Book::class
        );
    }

    public static function getByYear(int $year): array
    {
        $results = self::getPDO()->query(
            'SELECT * FROM books WHERE year ='.((int)$year)
        );

        return $results->fetchAll(
            \PDO::FETCH_CLASS,
            Book::class
        );
    }

    public static function getNew($limit = null): array
    {
        $results = self::getPDO()->query(
            'SELECT * FROM books ORDER BY YEAR DESC LIMIT '.((int)$limit)
        );

         return $results->fetchAll(
             \PDO::FETCH_CLASS,
             Book::class
         );
    }
}