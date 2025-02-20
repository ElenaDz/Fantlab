<?php

namespace APP\Action;

class Testbox
{
    public static function index($id, $test = null)
    {
        var_dump($id);
        var_dump($test);
    }
}