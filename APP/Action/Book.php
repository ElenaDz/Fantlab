<?php
namespace APP\Action;
use Exception;
use SYS\Error;
use SYS\Views;

class Book extends _Base
{
    /**
     * @throws Exception
     */
    public static function index($id)
    {
        $book = \APP\Model\Books::getById($id);

        if (empty($book)) {
            $code_not_found = 404;

            Error::showError(null, $code_not_found, self::getUrl($id));
        }

        $content = Views::get(
            __DIR__.'/../View/Book.php',
            [
                'book' => $book
            ]
        );

        self::showLayout(
            $book->getTitle(),
			$content,
            [
                [
                    'name' => 'Главная',
                    'url' => Index::getUrl()
                ],
                [
                    'name' => 'Книги',
                    'url' => Books::getUrl()
                ],
                [
                    'name' => $book->author_name,
                    'url' => Author::getUrl($book->author_name)
                ],
                [
                    'name' => $book->getTitle()
                ]
            ]
        );
    }

    public static function getUrl($id): string
    {
        return "/books/$id/";
    }
}