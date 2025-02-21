<?php
namespace APP\Config;

use APP\Action\Book;
use APP\Action\Books;
use APP\Action\Index;

class Routes
{
    public static function getConfig(): array
    {
        return [
            [
                '',
	            [Index::class, 'index']
            ],
            [
                'books/(\d+)/',
                [Book::class, 'index']
            ],
            [
				// fixme не правильно, работает со слеш и без Без не должен работать
                'books/(?:release/(\d+))?/?',
                [Books::class, 'index']
            ]
        ];
    }
}