<?php

namespace APP\Action;

use SYS\Views;

class Index extends _Base
{
    public static function index()
    {

        self::showLayout('Главная', 'index');

    }



    public static function getUrl()
    {
        return'/';
    }
}