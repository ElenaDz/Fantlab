<?php
/** @var Book[] $books */
// fixme для переменных у нас для пробелов используется подчеркивание а не верблюжья нотация, исправить везде ok
/** @var string $title_year */

use APP\Entity\Book;

?>

<!-- todo сделай заголовок "Книги за XXXX год" ok -->
    <h1>Книги <?= $title_year ?></h1>

<ul>
    <?php foreach ($books as $book):  ?>

        <li>
            <a href="<?= \APP\Action\Book::getUrl($book) ?>">
                <?= $book->title; ?>
                (<?= $book->year; ?>)
            </a>
        </li>

    <?php endforeach ?>
</ul>
