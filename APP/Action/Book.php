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

        $bread_crumbs = [
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
        ];

        $content_bread_crumbs = Views::get(
            __DIR__.'/../View/Layout/BreadCrumbs.php',
            [
                'bread_crumbs' => $bread_crumbs
            ]
        );

        self::showLayout('Книга', $content, $content_bread_crumbs);
    }

    public static function getUrl(\APP\Entity\Book $book): string
    {
        return "/books/$book->id/";
    }
}