<?php

namespace APP\Entity;

class TypeBook
{
    public static function getAll(): array
    {
        return [
            'story' => 'рассказ',
            'novel' => 'повесть',
            'poem' => 'стих',
            'romance' => 'роман'
        ];
    }

    public static function isValidType($type): bool
    {
        return in_array($type, self::getAll());
    }
}