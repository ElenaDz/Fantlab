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
        <!-- fixme обращение к модели в шаблоне не допустимо -->
        <a href="<?= \APP\Action\Author::getUrl(\APP\Model\Books::getNameAuthorById($book->id))?>">
            <!-- fixme обращение к модели в шаблоне не допустимо -->
            <?= \APP\Model\Books::getNameAuthorById($book->id) ?>
        </a> -
        <a href="<?= \APP\Action\Book::getUrl($book) ?>">
            <?= $book->title ?>
        </a>
    </li>
    <?php endforeach ?>
</ul>