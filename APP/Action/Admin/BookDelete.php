<?php

namespace APP\Action\Admin;

use APP\Model\Books;
use Exception;
use SYS\Error;

class BookDelete extends _Base
{

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

        Books::delete($book);

        header('Location: '.\APP\Action\Books::getUrl(), true, 302);

        exit;
    }

    /**
     * @throws Exception
     */
    public static function getUrl(): string
    {
        return'/admin/book/delete/';
    }
}