<?php

/** @var string $title */
/** @var Book $book */

// fixme use всегда в самом верху, это мусор который нас не интересует, он не должен мешать поэтому вверх
use APP\Entity\Book;
?>

<h2>
    <a href="<?= APP\Action\Books::getUrl($book->year)?>">
        Книги за <?= $book->year ?> год
    </a>
</h2>

<ul>
    <li>
        <a href="<?= \APP\Action\Book::getUrl($book) ?>">
            <?= $book->title ?>
        </a>
    </li>
</ul>