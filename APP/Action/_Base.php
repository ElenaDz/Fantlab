<?php

namespace APP\Action;

use SYS\Views;

abstract class _Base
{
    public static function showLayout($title, $content)
    {
        $book = \APP\Model\Books::getLastBook();

        echo Views::get(
            __DIR__.'/../View/Layout/Main.php',
            [
                'title' => $title,
                'content' =>  $content,
                'book' => $book
            ]
        );
    }
}