<?php
use APP\Entity\Book;

/** @var Book[] $books */
/** @var string $title_year */
/** @var boolean $is_show_authors_name */

?>

<h2>
    <?= empty($title_year) ? 'Книги' : 'Книги за '.$title_year.' год'; ?>
</h2>

<ul>
    <?php foreach ($books as $book):  ?>
        <li>

            <?php if ( ! empty($title_year) || $is_show_authors_name ): ?>
                <a href="<?= \APP\Action\Author::getUrl($book->author_name) ?>">
                    <?= $book->author_name; ?>
                </a> -
            <?php endif;?>

            <a href="<?= \APP\Action\Book::getUrl($book->getId()) ?>">
                <?= $book->getTitle(); ?>
                (<?= $book->getYear(); ?>)
            </a>
        </li>
    <?php endforeach ?>
</ul>

<a href="<?= \APP\Action\Admin\BookAdd::getUrl()?>">
    Добавить книгу
</a>
