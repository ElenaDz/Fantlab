<?php

namespace APP\Action;

use SYS\Views;

class Authors extends _Base
{
    public static function index()
    {
        $authors = \APP\Model\Authors::getAll();

        $content = Views::get(
            __DIR__.'/../View/Authors.php',
            [
                'authors' => $authors
            ]
        );

        self::showLayout(
            'Авторы',
            $content,
            [
                [
                    'name' => 'Главная',
                    'url' => Index::getUrl()
                ],
                [
                    'name' => 'Авторы',
                ]
            ]
        );
    }

    public static function getUrl(): string
    {
        return "/authors/";
    }

}