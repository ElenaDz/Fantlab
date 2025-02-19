<?php
namespace APP\Action;

use SYS\Views;

class Index extends _Base
{
    public static function index()
    {
        $book = \APP\Model\Books::getLastBook();

        $content = Views::get(
            __DIR__.'/../View/Layout/Index.php',
            [
                'book' => $book
            ]
        );

        self::showLayout('Главная', $content);
    }

    public static function getUrl(): string
    {
        return'/';
    }
}