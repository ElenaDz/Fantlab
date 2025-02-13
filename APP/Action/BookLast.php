<?php

namespace APP\Action;

// fixme ерунда какая-то удалить
class BookLast
{

    public static function getUrl()
    {
        $book = \APP\Model\Books::getLastBook();

        return "/books/$book->id/";
    }

}