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
	        // fixme для одного контролера должен быть одна строка в файле конфигурации а у тебя 2 для Books исправь, ok
	        //  здесь тебе пригодиться знания получение при написания регулярного выражения для testbox
            [
                'books/(\d+)/',
                [Book::class, 'index']
            ],
            [
                'books/(?:release/(\d+))?',
                [Books::class, 'index']
            ]
        ];
    }
}