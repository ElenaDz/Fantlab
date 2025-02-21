<?php
namespace APP\Action;
use SYS\Views;

class Book extends _Base
{
    public static function index($id)
    {
        $book = \APP\Model\Books::getById($id);

        $content = Views::get(
            __DIR__.'/../View/Book.php',
            [
                'book' => $book
            ]
        );

	    // fixme опять отдельная переменная для данных для шаблона без необходимости? убрать ok

        self::showLayout(
			// fixme у каждой страницы должен быть уникальный заголовок, это нужно для поисковой оптимизации, очень важно ok
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