<?php

namespace APP\Action;

use SYS\Views;

class BooksByRelease extends _Base
{
    public static function index($year)
    {
        $books = \APP\Model\Books::getByYear($year);

        $content = Views::get(
            __DIR__.'/../View/Books.php',
            [
                'books' => $books,
                'titleYear' => 'за '.$year.' год:'
            ]
        );

        self::showLayout('Книги', $content);
    }

    public static function getUrl($year)
    {
        return '/books/release/'.$year;
    }

}