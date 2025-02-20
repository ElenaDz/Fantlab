<?php

/** @var string $title */
/** @var Book $book */

use APP\Entity\Book;


// fixme у нас только один шаблон Layout, видимо ты хотела создать шаблон главной страницы но разместила не в той папке ok
?>

    <!-- fixme этот кусок относится к шаблону главной страницы, а не к layout ok-->

    <!-- fixme этого не должно быть на каждой странице только на главной ok-->

<h2> <a href="<?= APP\Action\Books::getUrl($book->year)?>">Книги за <?= $book->year ?> год</a></h2>

<ul>
    <li>
        <h3><a href="<?= \APP\Action\Book::getUrl($book) ?>"><?= $book->title ?></a></h3>
    </li>
</ul>