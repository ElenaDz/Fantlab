<?php

/** @var string $title */
/** @var Book $book */

use APP\Entity\Book;

?>
<!-- fixme это должно быть в шаблоне главной странице а не здесь -->
<?php if ($_SERVER['REQUEST_URI'] === \APP\Action\Index::getUrl() ): ?>

    <a href="<?= \APP\Action\Book::getUrl($book) ?>"><?= $book->title ?></a>

<?php endif; ?>
