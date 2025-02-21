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
                'books(?:/release/(\d+))?/',
                [Books::class, 'index']
            ]
        ];
    }
}