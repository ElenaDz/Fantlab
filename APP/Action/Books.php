<?php
namespace APP\Action;

use SYS\Views;

class Books extends _Base
{
    public static function index($year = null)
    {
		// fixme если книги за заданный год не найдены, нужно выдать ошибку 404
	    $books = empty($year)
		    ? \APP\Model\Books::getAll()
		    : \APP\Model\Books::getByYear($year);

        $content = Views::get(
            __DIR__.'/../View/Books.php',
            [
                'books' => $books,
                'title_year' => $year,
                'is_show_authors_name' => true
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
                [
                    'name' => 'Книги',
                    'url' => $title_suffix ? Books::getUrl() : null
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