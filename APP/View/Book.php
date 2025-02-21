<?php
use APP\Entity\Book;

/** @var Book $book */
?>

<h1><?= $book->title; ?></h1>
<dl class="book">
    <div class="item">
        <dt>Название:</dt>
        <dd class="name"><?= $book->title; ?></dd>
    </div>

    <div class="item">
        <dt>Год выхода:</dt>
        <dd class="release"><?= $book->year; ?></dd>
    </div>

</dl>

