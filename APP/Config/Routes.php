<?php
namespace APP\Config;

use APP\Action\Author;
use APP\Action\Book;
use APP\Action\Books;
use APP\Action\Index;
use APP\Action\Testbox;

class Routes
{
	// fixme Имя функции подчеркнуто, нужно исправлять все подчеркивания, чтобы их не было ok
    public static function getConfig(): array
    {
        return [
            [
                '',
	            // todo вот такая запись будет лучше, ее понимает и PhpStorm и php, перепиши конфиг ниже ok
	            [Index::class, 'index']
            ],
            [
                'books',
                [Books::class, 'index']
            ],
            [
                'books/(\d+)',
                [Book::class, 'index']
            ],
            [
				// fixme не правильное регулярное выражение, см подсказку ok
	            // @link https://regex101.com/r/sIUij2/1
	            // обрати внимание что я добавил флаг u для поддержки unicode, нужна для русских букв
                'author/[\w]+',
                [Author::class, 'index']
            ],
            [
				// fixme не правильное регулярное выражение, см подсказку ok
	            // @link https://regex101.com/r/HK1pRz/1
                'testbox-(\d+)(?:-(\d+))?',
                [Testbox::class, 'index']
            ],
            [
                'books/release/(\d+)',
                [Books::class, 'index']
            ]
        ];
    }
}