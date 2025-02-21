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

		/**
		 * fixme тебе не кажется плохой идеей в каждом контролере обращаться к шаблону хлебных крошек?
		 *  перенеси это в шаблон layout ok
	     */

        self::showLayout(
			// fixme исправить, что именно писал в другом контролере ok
            $title,
			$content,
            [
                [
                    'name' => 'Главная',
                    'url' => Index::getUrl()
                ],
                [
                    'name' => $title
                ]
            ]
        );
    }

    public static function getUrl($year = null): string
    {
        // fixme здесь дублирование /books/ Мы не делаем дублирования без необходимости Избавься ok

        $url = empty($year) ? '': 'release/'.$year;

        return '/books/'.$url;
    }
}