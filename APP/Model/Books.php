<?php
namespace APP\Model;

use APP\Entity\Author;
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
            'SELECT * FROM books WHERE id ='.((int)$id)
        );

        return $results->fetchObject(
            Book::class
        );
    }

    public static function getNameAuthorById(int $id): string
    {
        return self::getPDO()->query(
	            'SELECT name FROM authors JOIN books ON authors.id=books.author_id WHERE books.id ='.((int)$id)
	        )
	            ->fetchColumn();
    }

	// fixme не используется, удалить
    public static function getAuthorById(int $id): Author
    {
        $results = self::getPDO()->query(
            'SELECT * FROM authors JOIN books ON authors.id=books.author_id WHERE books.id ='.((int)$id)
        );

        return $results->fetchObject(
            Author::class
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

    public static function getCountBooksByAuthor($author): int
    {
        $results = self::getPDO()->query(
            'SELECT * FROM books WHERE author_id ='.((int)$author->id)
        );

		// fixme нет так нельзя, нужно пользоваться sql, используй join, group by, count
        return count($results->fetchAll(
            \PDO::FETCH_CLASS,
            Book::class
        ));
    }

	// fixme переименовать в getByAuthor так как это класс Books не нужно писать это слово снова и так понятно
	// fixme зачем здесь передавать объект автора если нужен только его id? передавай Id
    public static function getBooksByAuthor($author): array
    {
        $results = self::getPDO()->query(
            'SELECT * FROM books WHERE author_id ='.((int)$author->id).' ORDER BY books.year DESC'
        );

        return $results->fetchAll(
            \PDO::FETCH_CLASS,
            Book::class
        );
    }

}