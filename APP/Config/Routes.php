<?php
namespace APP\Config;

use APP\Action\Index;

class Routes
{
	// fixme Имя функции подчеркнуто, нужно исправлять все подчеркивания, чтобы их не было
    public static function getConfig()
    {
        return [
            [
                '',
	            // todo вот такая запись будет лучше, ее понимает и PhpStorm и php, перепиши конфиг ниже
	            [Index::class, 'index']
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
				// fixme не правильное регулярное выражение, см подсказку
	            // @link https://regex101.com/r/sIUij2/1
	            // обрати внимание что я добавил флаг u для поддержки unicode, нужна для русских букв
                'author/([A-zА-яё]+)',
                /** @see \APP\Action\Author::index */
                '\APP\Action\Author::index'
            ],
            [
				// fixme не правильное регулярное выражение, см подсказку
	            // @link https://regex101.com/r/HK1pRz/1
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