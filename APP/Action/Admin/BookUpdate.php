<?php

namespace APP\Action\Admin;

use APP\Entity\Book;
use APP\Model\Books;
use Exception;
use SYS\Error;
use SYS\Views;

class BookUpdate extends _Base
{
    /**
     * @throws Exception
     */
    public static function index()
    {
        $id = $_POST['id'];


        $book = Books::getById($id);

        if (empty($id)) {
            Error::showError('Не задан id книги', 500);
        }

        if (empty($book)) {
            Error::showError('Книга с id = "'.$id.'" не найдена', 500);
        }

        if ($_POST ["is_update"]) {
            $book = Book::create(
                $_POST['title'],
                $_POST['title_original'],
                $_POST['author_name'],
                $_POST['year'],
                $_POST['type'],
                $_POST['description']
            );

            $book->setId( $_POST['id']);

            $cover_url = $_POST['cover_url'];

            if ($cover_url) {
                $book->setCoverUrl($cover_url);
            }

            $book->save();

            header('Location: '.\APP\Action\Book::getUrl($book->getId()), true, 302);
            exit;
        }

        $content = Views::get(
            __DIR__.'/../../View/Admin/Book.php',
            [
                'book' => $book
            ]
        );

        self::showLayout('Изменение книги', $content);
    }

    public static function getUrl(): string
    {
        return "/admin/book/update/";
    }
}