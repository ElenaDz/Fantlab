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

        $title_suffix = $year ? 'За '.$year.' год' : null;

        self::showLayout(
            trim('Книги '.mb_strtolower($title_suffix)),
			$content,
            [
                [
                    'name' => 'Главная',
                    'url' => Index::getUrl()
                ],
				// todo посмотри как нужно было сделать правильно
                [
                    'name' => 'Книги',
                    'url' => $year ? Books::getUrl() : null
                ],
                [
                    'name' => $title_suffix,
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