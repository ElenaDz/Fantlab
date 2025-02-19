<?php

/** @var string $title */
/** @var Book $book */

use APP\Entity\Book;

// fixme у нас только один шаблон Layout, видимо ты хотела создать шаблон главной страницы но разместила не в той папке
?>
<?php if ($_SERVER['REQUEST_URI'] === \APP\Action\Index::getUrl() ): ?>

    <a href="<?= \APP\Action\Book::getUrl($book) ?>"><?= $book->title ?></a>

<?php endif; ?>
