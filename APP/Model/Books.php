<?php
namespace APP\Model;

use APP\Entity\Book;

class Books
{
    private static $pdo;

    private static function getPDO(): \PDO
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

    /**
     * @param int $id
     * @return boolean|Book
     */
    public static function getById(int $id)
    {
        $results = self::getPDO()->query(
            'SELECT books.*, authors.name as author_name,
       				CAST(COALESCE(books.year, 0) AS UNSIGNED) - CAST(COALESCE(YEAR(authors.birthday), 0) AS UNSIGNED) AS author_age
                    FROM books
                    JOIN  authors on authors.id = books.author_id
                    where books.id = '.((int)$id)
        );

        return $results->fetchObject(
            Book::class
        );
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

    public static function getNew(int $limit = NULL): array
    {
        $limit = empty($limit) ? '' : 'LIMIT '.$limit;

        $results = self::getPDO()->query(
            'SELECT books.*, authors.name AS author_name 
                    FROM books 
                    JOIN authors ON books.author_id=authors.id 
                    WHERE books.year = (SELECT MAX(year) FROM books)
                    ORDER BY YEAR DESC '.$limit
        );

         return $results->fetchAll(
             \PDO::FETCH_CLASS,
             Book::class
         );
    }

    public static function getByAuthorId($author_id): array
    {
        $results = self::getPDO()->query(
	            'SELECT * FROM books WHERE author_id ='.((int) $author_id).' ORDER BY books.year DESC'
	        );

        return $results->fetchAll(
            \PDO::FETCH_CLASS,
            Book::class
        );
    }
}