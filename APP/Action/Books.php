<?php
namespace APP\Action;

use SYS\Views;

class Books extends _Base
{
    public static function index($year = null)
    {
	    $books = empty($year)
		    ? \APP\Model\Books::getAll()
		    : \APP\Model\Books::getByYear($year);

        $content = Views::get(
            __DIR__.'/../View/Books.php',
            [
                'books' => $books,
                'title_year' => $year
            ]
        );

        $title = $year ? 'Книги за '.$year.' год' : 'Книги';

        self::showLayout(
            $title,
			$content,
            [
                [
                    'name' => 'Главная',
                    'url' => Index::getUrl()
                ],
				// fixme не правильно, если год не задана то "Книги", если задан "Книги / За xxxx год" где "книги" ссылка
                [
                    'name' => $title
                ]
            ]
        );
    }

    public static function getUrl($year = null): string
    {
        $url = empty($year) ? '': 'release/'.$year;

        return '/books/'.$url;
    }
}