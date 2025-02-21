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

        $title = $year ? 'За '.$year.' год' : 'Книги';

        self::showLayout(
            $title,
			$content,
            [
                [
                    'name' => 'Главная',
                    'url' => Index::getUrl()
                ],
                $year
                    ? [
                        'name' => 'Книги',
                        'url' => Books::getUrl()
                    ]
                    :null,

				// fixme не правильно, если год не задана то "Книги", если задан "Книги / За xxxx год" где "книги" ссылка ok
                [
                    'name' => $title
                ]
            ]
        );
    }

    public static function getUrl($year = null): string
    {
        $url = empty($year) ? '': 'release/'.$year.'/';

        return '/books/'.$url;
    }
}