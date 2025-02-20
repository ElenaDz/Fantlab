<?php
namespace APP\Action;

use SYS\Views;

class Books extends _Base
{
    public static function index($year = null)
    {
		// fixme это не нужно делать если запросили книги за год, подумай как правильно ok

		/**
		 * fixme мне не нравиться идея заводить отдельную переменную для сбора данных для шаблона, избавься от нее,
	     * пускай будет как в других контролерах ok
		 */

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

        $bread_crumbs = [
            [
                'name' => 'Главная',
                'url' => Index::getUrl()
            ],
            [
                'name' => 'Книги'
            ]
        ];

        $content_bread_crumbs = Views::get(
            __DIR__.'/../View/Layout/BreadCrumbs.php',
            [
                'bread_crumbs' => $bread_crumbs
            ]
        );

        self::showLayout('Книги', $content, $content_bread_crumbs);
    }


    public static function getUrl($year = null): string
    {
        // fixme для проверки на пустоту лучше использовать empty ok
	    // https://www.php.net/manual/ru/function.empty.php
		return empty($year)
            ? '/books/'
            : '/books/release/'.$year;
    }
}