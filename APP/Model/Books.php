<?php
namespace APP\Model;

use APP\Entity\Book;

class Books
{
    public static function getAll()
    {

        $book1 = new Book();

        $book1->id = 1;
        $book1->title = 'Название книги 1';
        $book1->year = 1998;

        $book2 = new Book();

        $book2->id = 2;
        $book2->title = 'Название книги 2';
        $book2->year = 2003;

        $book3 = new Book();

        $book3->id = 3;
        $book3->title = 'Название книги 3';
        $book3->year = 2003;

        return [
            $book1,
            $book2,
            $book3
        ];
    }

    public static function getById(int $id)
    {
        $books = Books::getAll();

        /**
         * @var Book $book
         */
        foreach ($books as $book)
        {
            if ($book->id === $id) {
                return $book;
            }
        }
    }

    public static function getByYear(int $year)
    {
        $books = Books::getAll();

        /**
         * @var Book $book
         */
        foreach ($books as $index => $book)
        {
            if ($book->year !== $year) {
                unset($books[$index]);
            }
        }
        return $books;
    }

    public static function getLastBook():?Book
    {
        $books = Books::getAll();
        $year = null;
        $index_book = null;

        /**
         * @var Book $book
         */
        foreach ($books as $index => $book)
        {
            if (!$year) {
                $year = $book->year;
                $index_book = $index;
            }
            if ($year < $book->year) {
                unset($books[$index_book]);
                $year = $book->year;
                $index_book = $index;
            }
        }

        $books = array_values($books);
        $last_index = count($books) - 1;

        return $books[$last_index];
    }
}