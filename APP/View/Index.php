<?php
use APP\Entity\Book;

/** @var string $year */
/** @var Book $books */

?>

<h2>
    <a href="<?= APP\Action\Books::getUrl($year)?>">
        Книги за <?= $year ?> год
    </a>
</h2>

<ul>
    <?php foreach ($books as $book):  ?>
    <li>
        <a href="<?= \APP\Action\Author::getUrl($book->author_name)?>">
            <?= $book->author_name ?>
        </a> -
        <a href="<?= \APP\Action\Book::getUrl($book->id) ?>">
            <?= $book->title ?>
        </a>
    </li>
    <?php endforeach ?>
</ul>