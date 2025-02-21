<?php
namespace APP\Model;

use APP\Entity\Book;

class Books
{
    public static function getAll(): array
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

        $book4 = new Book();

        $book4->id = 4;
        $book4->title = 'Название книги 4';
        $book4->year = 2002;


        return [
            $book1->id =>$book1,
            $book2->id =>$book2,
            $book3->id =>$book3,
            $book4->id =>$book4
        ];
    }

    public static function getById(int $id): Book
    {
        $books = Books::getAll();

        return $books[$id];
    }

    public static function getByYear(int $year): array
    {
        $books = Books::getAll();

        return array_filter($books, function ($book) use ($year) {
            return $book->year === $year ;
        });
    }

	// fixme limit 1 не пойдет, по умолчанию лимита нет null, 1 это ты в контролере задаешь
    public static function getNew($limit = 1): array
    {
        $books = Books::getAll();

        usort($books, function ($book1, $book2) {
            return $book1->year <=> $book2->year;
        });

        return array_slice($books, -1 * $limit);
    }
}