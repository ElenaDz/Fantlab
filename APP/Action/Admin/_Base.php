<?php

namespace APP\Action\Admin;

use SYS\Views;

abstract class _Base
{
    public static function showLayout($title, $content, $bread_crumbs = [])
    {
        echo Views::get(
            __DIR__.'/../../View/Layout/Main.php',
            [
                'title' => $title,
                'content' =>  $content,
                'bread_crumbs' => $bread_crumbs
            ]
        );
    }
}