<?php
namespace APP\Action;

use SYS\Views;

class Books extends _Base
{
    public static function index($year = null)
    {
		// fixme это не нужно делать если запросили книги за год, подумай как правильно
        $books = \APP\Model\Books::getAll();

		/**
		 * fixme мне не нравиться идея заводить отдельную переменную для сбора данных для шаблона, избавься от нее,
	     * пускай будет как в других контролерах
		 */
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


    public static function getUrl($year = null): string
    {
        // fixme для проверки на пустоту лучше использовать empty
	    // https://www.php.net/manual/ru/function.empty.php
		return $year != null
            ? '/books/release/'.$year
            : '/books/';
    }
}