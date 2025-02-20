<?php
use APP\Entity\Book;

/** @var Book[] $books */
/** @var string $title_year */
?>

<!-- todo используй вот такие конструкции в шаблонах ok-->

<h2><?= empty($title_year) ? 'Книги' : 'Книги за '.$title_year.' год'; ?></h2>

<!-- fixme не правильно, логика как именно должен выглядеть заголовок должна быть в шаблоне, а у тебя она в контроллере ok-->

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
