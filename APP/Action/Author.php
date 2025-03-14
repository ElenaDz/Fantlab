<?php

namespace APP\Action;

use Exception;
use SYS\Error;
use SYS\Views;

class Author extends _Base
{
    /**
     * @throws Exception
     */
    public static function index($name)
    {
        $author = \APP\Model\Authors::getByName($name);
		// fixme если автор не найден нужно ли выполнять эту строку? нижу опусти ее ok

        if (empty($author)) {
            $code_not_found = 404;

			// fixme не смущает тебя что у тебя везде повторяется один и тот же текст? может быть избавиться от повторения ok
            Error::showError(null, $code_not_found, self::getUrl($name));
        }

        $books = \APP\Model\Books::getByAuthorId($author->id);

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