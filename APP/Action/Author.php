<?php

namespace APP\Action;

use DateTimeImmutable;
use Exception;
use SYS\Error;
use SYS\Views;

class Author extends _Base
{
    public static function index($name)
    {
        $author = \APP\Model\Authors::getByName($name);
		// fixme если автор не найден нужно ли выполнять эту строку? нижу опусти ее
        $books = \APP\Model\Books::getByAuthorId($author->id);

        if (empty($author)) {
            $code_not_found = 404;

			// fixme не смущает тебя что у тебя везде повторяется один и тот же текст? может быть избавиться от повторения
            Error::index($code_not_found, "Ошибка ".$code_not_found.". Страница ".$name." не найдена");
        }

        $content = Views::get(
            __DIR__.'/../View/Author.php',
            [
                'author' => $author,
                'books' => $books
            ]
        );
        
        self::showLayout(
            $author->name,
            $content,
            [
                [
                    'name' => 'Главная',
                    'url' => Index::getUrl()
                ],
                [
                    'name' => 'Авторы',
                    'url' => Authors::getUrl()
                ],
                [
                    'name' => $author->name
                ]
            ]
        );
    }

    /**
     * @throws Exception
     */

    public static function getUrl($name): string
    {
        return "/authors/$name/";
    }

}