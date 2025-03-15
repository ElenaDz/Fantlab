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

        if (empty($author)) {
            Error::showError(null, 404, self::getUrl($name));
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