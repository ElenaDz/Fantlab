<?php
namespace APP\Model;

use APP\Entity\Author;
use APP\Entity\Book;

// todo добавь индексы в таблица БД на основе анализа запросов которые мы уже делаем к БД
//  прочитать про индексы можно здесь https://php.zone/php-i-mysql-s-nulya/indeksy-v-mysql

class Books
{
    private static $pdo;

	// fixme можно сделать private
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
            'SELECT books.*, authors.name AS author_name FROM books Left JOIN authors ON books.author_id=authors.id;'
        );

        return $results->fetchAll(
          \PDO::FETCH_CLASS,
            Book::class
        );
    }

    public static function getById(int $id): Book
    {
        $results = self::getPDO()->query(
            'SELECT books.*, authors.name as author_name
                    FROM books
                    JOIN  authors on authors.id = books.author_id
                    where books.id = '.((int)$id)
        );

        return $results->fetchObject(
            Book::class
        );
    }

    public static function getNameAuthorById(int $id): string
    {
        return self::getPDO()
	        ->query(
	            'SELECT name FROM authors JOIN books ON authors.id=books.author_id WHERE books.id ='.((int)$id)
	        )
	        ->fetchColumn();
    }

    public static function getByYear(int $year): array
    {
        $results = self::getPDO()->query(
            'SELECT books.*, authors.name AS author_name FROM books JOIN authors ON books.author_id=authors.id WHERE year ='.((int)$year)
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


    public static function getByAuthorId($author_id): array
    {
        $results = self::getPDO()
	        ->query(
	            'SELECT * FROM books WHERE author_id ='.((int) $author_id).' ORDER BY books.year DESC'
	        );

        return $results->fetchAll(
            \PDO::FETCH_CLASS,
            Book::class
        );
    }
}