<?php
/** @var \APP\Entity\Book[] $books */
/** @var string $titleYear */
?>

<h1>Книги <?= $titleYear ?></h1>

<ul>
    <?php foreach ($books as $book):  ?>

        <li>
            <a href="
            <?= \APP\Action\Book::getUrl($book) ?>">
                <?= $book->title; ?>
                (<?= $book->year; ?>)
            </a>
        </li>
    <?php endforeach ?>
</ul>
