<?php

namespace APP\Entity;

// fixme перенеси все это в класс Book
class TypeBook
{
    public static function getAll(): array
    {
		// fixme ключи этого массива ни где не используются, убрать
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