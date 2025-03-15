<?php
namespace APP\Model;

use APP\Entity\Book;
use Exception;

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
            'SELECT books.*, authors.name as author_name, authors.birthday as author_birthday
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

    /**
     * @throws Exception
     */
    public static function add(Book $book)
    {
        if ($book->getId()) {
            throw new Exception(
                'У добавляемой книги не должно быть Id'
            );
        }

        $author = Authors::getByName($book->getAuthorName());

		// fixme если автор не найден тут не будет объекта автор и нельзя будет обращаться к его id

        $author_id = $author->id;

        if (empty($author->id)) {
            $author_id = Authors::add($book->getAuthorName());
        }

        $prepare = self::getPDO()->prepare(
        'INSERT INTO 
                    books 
                    (`title`, `title_original`, `author_id`, `type`, `year`, `description`, `cover`) 
                VALUES 
                    (:title, :title_original, :author_id, :type, :year, :description, :cover)'
        );

        $prepare->execute([
            'title' => $book->getTitle(),
            'title_original' => $book->getTitleOriginal(),
            'author_id' => $author_id,
            'type' => $book->getType(),
            'year' => $book->getYear(),
            'description' => $book->getDescription(),
            'cover' => $book->getCover()
        ]);

        return self::getPDO()->lastInsertId();
    }

    public static function delete(Book $book)
    {
        if (empty($book->getId())) return;

        self::getPDO()->query(
            'DELETE FROM 
                        books 
                    WHERE 
                        id='.((int) $book->getId())
        );

	    $cover_path = $book->getCoverPath();
	    if ($cover_path) {
		    unlink($cover_path);
	    }
    }

    /**
     * @throws Exception
     */
    public static function save(Book $book)
    {
        if (empty($book->getId())) {
            throw new \Exception(
                'У сохраняемой книги должен быть задан Id'
            );
        }

        $author = Authors::getByName($book->getAuthorName());

	    // fixme если автор не найден тут не будет объекта автор и нельзя будет обращаться к его id

	    $author_id = $author->id;

        if (empty($author->id)) {
            $author_id = Authors::add($book->getAuthorName());
        }

        $prepare = self::getPDO()->prepare(
            'UPDATE 
                        books 
                    SET 
                        `title` = :title, 
                        `title_original` = :title_original, 
                        `author_id` = :author_id,
                        `type` = :type, 
                        `year` = :year, 
                        `description` = :description, 
                        `cover` = :cover
                    WHERE 
                        id = :id'
        );

        $prepare->execute([
            'title' => $book->getTitle(),
            'title_original' => $book->getTitleOriginal(),
            'author_id' => $author_id,
            'type' => $book->getType(),
            'year' => $book->getYear(),
            'description' => $book->getDescription(),
            'cover' => $book->getCover(),
            'id' => $book->getId()
        ]);
    }
}