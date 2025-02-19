<?php
namespace APP\Action;

use SYS\Views;

class Books extends _Base
{
    public static function index($year = null)
    {
        $books = \APP\Model\Books::getAll();

        $content_data = [
            'books' => $books
        ];

        if ($year != null) {
            $books = \APP\Model\Books::getByYear($year);

            $content_data = [
                'books' => $books,
                'title_year' => 'за '.$year.' год:'
            ];
        }

        $content = Views::get(
            __DIR__.'/../View/Books.php',
            $content_data
        );

        self::showLayout('Книги', $content);
    }

	// fixme все подчеркивания phpstorm во всех файлах нужно исправить ВСЕ ok
    public static function getUrl($year = null): string
    {
        return $year != null
            ? '/books/release/'.$year
            : '/books/';
    }
}