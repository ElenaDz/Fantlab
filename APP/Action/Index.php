<?php
namespace APP\Action;


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