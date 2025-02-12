<?php

/** @var string $title */
/** @var string $content */
/** @var \APP\Entity\Book $book */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
</head>

<body>

    <header>
        logo
        <nav>
            <ul>
                <li>
                    <?php if ($_SERVER['REQUEST_URI'] === \APP\Action\Index::getUrl()): ?>
                        Главная
                    <?php else: ?>
                        <a href="<?= \APP\Action\Index::getUrl() ?>">Главная</a>
                    <?php endif; ?>

                </li>
                <li>
                    <?php if ($_SERVER['REQUEST_URI'] === \APP\Action\Books::getUrl()): ?>
                        Книги
                    <?php else: ?>
                        <a href="<?= \APP\Action\Books::getUrl() ?>">Книги</a>
                    <?php endif; ?>

                </li>
                <li>
                    <?php if ($_SERVER['REQUEST_URI'] === APP\Action\BooksByRelease::getUrl($book->year)): ?>

                        Книги за <?= $book->year ?> год
                    <?php else: ?>
                        <a href="<?= APP\Action\BooksByRelease::getUrl($book->year)?>">Книги за <?= $book->year ?> год</a>
                    <?php endif; ?>

                </li>
            </ul>
        </nav>
    </header>

    <main>
        <?php if ($_SERVER['REQUEST_URI'] === \APP\Action\Index::getUrl() ): ?>
        <a href="<?= \APP\Action\BookLast::getUrl() ?>"> <?= $book->title ?></a>
        <?php endif; ?>
        <br>
        <?=  $content; ?>
    </main>

    <footer>
        footer
    </footer>

</body>
</html>