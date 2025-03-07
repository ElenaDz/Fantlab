<?php

namespace APP\Entity;

use DateTime;
use Exception;

class Author
{
    public $id;
    public $name;
    private $birthday;
    private $death;
    public $country;
    public $cover;
    public $count_book;

    /**
     * @throws Exception
     */
    public function getBirthday(): string
    {
        $date = new DateTime($this->birthday);
        return $date->format('d.m.Y');
    }

    /**
     * @throws Exception
     */
    public function getDeath(): string
    {
        $date = new DateTime($this->death);
        return $date->format('d.m.Y');
    }
}