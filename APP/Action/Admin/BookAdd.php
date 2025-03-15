<?php

namespace APP\Action\Admin;

use APP\Action\_Base;
use APP\Entity\Book;
use Exception;
use SYS\Views;

class BookAdd extends _Base
{
    /**
     * @throws Exception
     */
    public static function index()
    {
        if ( ! empty($_POST)) {
			// todo не нравиться мне такая запись Добавь метод createFromArray просто передавай туда $_POST остальное внутри
            $book = Book::create(
                $_POST['title'],
                $_POST['title_original'],
                $_POST['author_name'],
                $_POST['year'],
                $_POST['type'],
                $_POST['description']
            );

            $book->save();

            $cover_url = $_POST['cover_url'];

            if ($cover_url) {
                $book->setCoverUrl($cover_url);
                $book->save();
            }

            header('Location: '.\APP\Action\Book::getUrl($book->getId()), true, 302);
            exit;
        };

        $content = Views::get(
            __DIR__.'/../../View/Admin/Book.php'
        );

        self::showLayout('Добавление книги', $content);
    }

    public static function getUrl(): string
    {
        return "/admin/book/add/";
    }
}