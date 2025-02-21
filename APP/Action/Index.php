<?php
namespace APP\Action;

use SYS\Views;

class Index extends _Base
{
    public static function index()
    {
		// fixme если не задавать ограничение то выводятся все книги, а не книги за последний год, а надо за последний год ok
        $books = \APP\Model\Books::getNew(1);

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