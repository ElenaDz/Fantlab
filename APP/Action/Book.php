<?php
namespace APP\Action;
use SYS\Views;

class Book extends _Base
{
    public static function index($id)
    {
        $book = \APP\Model\Books::getById($id);

        $content = Views::get(
            __DIR__.'/../View/Book.php',
            [
                'book' => $book
            ]
        );

        self::showLayout(
            $book->title,
			$content,
            [
                [
                    'name' => 'Главная',
                    'url' => Index::getUrl()
                ],
                [
                    'name' => 'Книги',
                    'url' => Books::getUrl()
                ],
                [
					/**
					 * fixme каждое обращение к модели это sql запрос, это медленная тяжелая процедура,
					 *  их нужно стараться делать как можно меньше, а тут ты делаешь 2 раза одно и тоже ok
					 */
                    'name' => $book->author_name,
                    'url' => Author::getUrl($book->author_name)
                ],
                [
                    'name' => $book->title
                ]
            ]
        );
    }

    public static function getUrl(\APP\Entity\Book $book): string
    {
        return "/books/$book->id/";
    }
}