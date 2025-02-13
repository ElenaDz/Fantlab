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

        self::showLayout('Книгa', $content);
    }

    public static function getUrl(\APP\Entity\Book $book)
    {
        return "/books/$book->id/";
    }
}