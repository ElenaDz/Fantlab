<?php

namespace APP\Action;

class BookLast
{

    public static function getUrl()
    {
        $book = \APP\Model\Books::getLastBook();

        return "/books/$book->id/";
    }

}