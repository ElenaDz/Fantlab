<?php

namespace APP\Config;

class Routes
{
    public static function getConfig()
    {
        return [
            [
                '',
                /** @see \APP\Action\Index::index */
                '\APP\Action\Index::index'
            ],
            [
                'books',
                /** @see \APP\Action\Books::index */
                '\APP\Action\Books::index'
            ],
            [
                'books/(\d+)',
                /** @see \APP\Action\Book::index */
                '\APP\Action\Book::index'
            ],
            [
                'author/([A-zА-яё]+)',
                /** @see \APP\Action\Author::index */
                '\APP\Action\Author::index'
            ],
            [
                'testbox-(\d+)-?((\d+))?',
                /** @see \APP\Action\Testbox::index */
                '\APP\Action\Testbox::index'
            ],
            [
                'books/release/(\d+)',
                /** @see \APP\Action\BooksByRelease::index */
                '\APP\Action\BooksByRelease::index'
            ]
        ];
    }
}