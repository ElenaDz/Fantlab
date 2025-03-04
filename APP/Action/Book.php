<?php
namespace APP\Action;
use SYS\Views;

class Book extends _Base
{
    public static function index($id)
    {
		// fixme если книга не найдена нужно выдать ошибку 404 страница не найдена (без редиректа)
        $book = \APP\Model\Books::getById($id);

        $content = Views::get(
            __DIR__.'/../View/Book.php',
            [
                'book' => $book
            ]
        );

        self::showLayout(
            $book->title,
			$content,
            [
                [
                    'name' => 'Главная',
                    'url' => Index::getUrl()
                ],
                [
                    'name' => 'Книги',
                    'url' => Books::getUrl()
                ],
                [
                    'name' => $book->author_name,
                    'url' => Author::getUrl($book->author_name)
                ],
                [
                    'name' => $book->title
                ]
            ]
        );
    }

    public static function getUrl(\APP\Entity\Book $book): string
    {
        return "/books/$book->id/";
    }
}