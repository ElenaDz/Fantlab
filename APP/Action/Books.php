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

        $bread_crumbs = [
            [
                'name' => 'Главная',
                'url' => Index::getUrl()
            ],
            [
                'name' => 'Книги'
            ]
	        // fixme не хватает пункта "За xxxx год", и не только думай как правильно должно быть
        ];

		/**
		 * fixme тебе не кажется плохой идеей в каждом контролере обращаться к шаблону хлебных крошек?
		 *  перенеси это в шаблон layout
	     */
        $content_bread_crumbs = Views::get(
            __DIR__.'/../View/Layout/BreadCrumbs.php',
            [
                'bread_crumbs' => $bread_crumbs
            ]
        );

        self::showLayout(
			// fixme исправить, что именно писал в другом контролере
			'Книги',
			$content,
			$content_bread_crumbs
        );
    }


    public static function getUrl($year = null): string
    {
        // fixme здесь дублирование /books/ Мы не делаем дублирования без необходимости Избавься
		return empty($year)
            ? '/books/'
            : '/books/release/'.$year;
    }
}