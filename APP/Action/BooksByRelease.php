<?php

namespace APP\Action;

use SYS\Views;

// fixme список книг и список книг отфильтрованных по году это один и тот же список, если передали год значит
//  фильтруем, если нет - то нет. Избавься от этого контроллера и перепиши контролер списка книг
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