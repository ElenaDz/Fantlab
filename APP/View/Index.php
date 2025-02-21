<?php
use APP\Entity\Book;

/** @var string $title */
/** @var string $year */
/** @var Book $books */

// fixme use всегда в самом верху, это мусор который нас не интересует, он не должен мешать поэтому вверх ok
?>

<h2>
    <a href="<?= APP\Action\Books::getUrl($year)?>">
        Книги за <?= $year ?> год
    </a>
</h2>

<ul>
    <?php foreach ($books as $book):  ?>
    <li>
        <a href="<?= \APP\Action\Book::getUrl($book) ?>">
            <?= $book->title ?>
        </a>
    </li>
    <?php endforeach ?>
</ul>