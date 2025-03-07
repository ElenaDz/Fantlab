<?php

namespace SYS;

class Erorr
{
    public static function index($code, $massage)
    {
        http_response_code($code);

        echo $massage;

        exit;
    }

}