<?php
namespace APP\Action;

use SYS\Views;

class Index extends _Base
{
    public static function index()
    {
		// fixme если не задавать limit не возвращает не одной книги а должен вернуть все ok
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
        return '/';
    }
}