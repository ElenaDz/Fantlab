<?php
namespace APP\Config;

use APP\Action\Author;
use APP\Action\Book;
use APP\Action\Books;
use APP\Action\Index;
use APP\Action\Testbox;

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
                'books',
                [Books::class, 'index']
            ],
            [
                'books/(\d+)',
                [Book::class, 'index']
            ],
            [
                'author/(\w+)',
                [Author::class, 'index']
            ],
            [
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