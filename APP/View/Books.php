<?php
/** @var \APP\Entity\Book[] $books */
// fixme для переменных у нас для пробелов используется подчеркивание а не верблюжья нотация, исправить везде
/** @var string $titleYear */
?>

<!-- todo сделай заголовок "Книги за XXXX год" -->
<h1>Книги <?= $titleYear ?></h1>

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
