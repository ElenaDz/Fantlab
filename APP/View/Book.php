<?php
use APP\Entity\Book;

/** @var Book $book */
?>

<h1><?= $book->title; ?></h1>
<dl>
    <dt>Название</dt>
    <dd><?= $book->title; ?></dd>

    <dt>Год выхода</dt>
    <dd><?= $book->year; ?></dd>
</dl>

