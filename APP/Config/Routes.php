<?php
namespace APP\Config;

use APP\Action\Author;
use APP\Action\Authors;
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
                'books(?:/release/(\d+))?/',
                [Books::class, 'index']
            ],
            [
                'authors/',
                [Authors::class, 'index']
            ],
            [
                'authors/([A-z А-я]+)/',
                [Author::class, 'index']
            ]
        ];
    }
}