<?php

namespace APP\Action;

use SYS\Views;

abstract class _Base
{
    public static function showLayout($title, $content, $bread_crumbs = [])
    {
		// fixme перемести получение этого шаблона в шаблон layout main во внутрь ok

        echo Views::get(
            __DIR__.'/../View/Layout/Main.php',
            [
                'title' => $title,
                'content' =>  $content,
                'bread_crumbs' => $bread_crumbs
            ]
        );
    }
}