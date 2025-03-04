<?php
use APP\Entity\Book;

/** @var Book[] $books */
/** @var string $title_year */


?>

<h2>
    <?= empty($title_year) ? 'Книги' : 'Книги за '.$title_year.' год'; ?>
</h2>

<ul>
    <?php foreach ($books as $book):  ?>
        <li>

            <?php if (!empty($title_year) ): ?>
                <a href="<?= \APP\Action\Author::getUrl($book->author_name) ?>">
                    <?= $book->author_name; ?>
                </a> -
            <?php endif;?>

            <a href="<?= \APP\Action\Book::getUrl($book) ?>">
                <?= $book->title; ?>
                (<?= $book->year; ?>)
            </a>
        </li>
    <?php endforeach ?>
</ul>
