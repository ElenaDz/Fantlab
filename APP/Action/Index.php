<?php
namespace APP\Action;

use SYS\Views;

class Index extends _Base
{
    public static function index()
    {
	    // fixme а если я попрошу чтобы в списке было не 1 книга а 2 ok
	    // не правильно у тебя функция должна возвращать все новые книги (книги за последний год),
	    // а так же у функции должен быть параметр $limit необязательный который ограничивает список,
	    // имя функции лучше getNew без Book так как слово Book уже есть в имени класса
        $books = \APP\Model\Books::getNew();

        $content = Views::get(
            __DIR__ . '/../View/Index.php',
            [
                'books' => $books,
                'year' => $books[0]->year
            ]
        );

        self::showLayout(
			// fixme обычно здесь не слово "главная", а название сайта ok
			'Fantlab',
			$content
        );
    }

    public static function getUrl(): string
    {
        return'/';
    }
}