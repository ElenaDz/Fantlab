<?php

namespace APP\Action;

use SYS\Views;

class Author extends _Base
{
    public static function index($name)
    {
	    // fixme если автор не найден нужно выдать ошибку 404 страница не найдена (без редиректа)
        $author = \APP\Model\Authors::getByName($name);
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

    public static function getUrl($name): string
    {
        return "/authors/$name/";
    }

}