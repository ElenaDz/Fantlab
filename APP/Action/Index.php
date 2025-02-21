<?php
namespace APP\Action;

use SYS\Views;

class Index extends _Base
{
    public static function index()
    {
        $books = \APP\Model\Books::getNew();

        $content = Views::get(
            __DIR__ . '/../View/Index.php',
            [
                'books' => $books,
                'year' => $books[0]->year
            ]
        );

        self::showLayout(
			'Fantlab',
			$content
        );
    }

    public static function getUrl(): string
    {
        return'/';
    }
}