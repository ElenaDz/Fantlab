<?php
namespace APP\Action;

use SYS\Views;

class Books extends _Base
{
    public static function index()
    {
        $books = \APP\Model\Books::getAll();

        $content = Views::get(
            __DIR__.'/../View/Books.php',
            [
                'books' => $books
            ]
        );

        self::showLayout('Книги', $content);
    }

	// fixme все подчеркивания phpstorm во всех файлах нужно исправить ВСЕ
    public static function getUrl()
    {
        return '/books/';
    }
}