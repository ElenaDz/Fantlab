<?php

namespace APP\Action;

use SYS\Views;

abstract class _Base
{
    public static function showLayout($title, $content, $bread_crumbs = [])
    {
		// fixme убрать ok
        $content_bread_crumbs = Views::get(
            __DIR__ . '/../View/Blocks/BreadCrumbs.php',
            [
                'bread_crumbs' => $bread_crumbs
            ]
        );

        echo Views::get(
            __DIR__.'/../View/Layout/Main.php',
            [
                'title' => $title,
                'content' =>  $content,
                'bread_crumbs' => $content_bread_crumbs
            ]
        );
    }
}