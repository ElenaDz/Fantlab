<?php

/** @var string $title */
/** @var string $content */
/** @var Book $book */

use APP\Entity\Book;

// todo сделай минимальные стили чтобы сайт был похож на сайт чтобы было понятно где навигация где основной контент где футор ok
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/main.css?v=<?= filemtime(__DIR__ . '/../../../css/main.css')?>">

    <title><?= $title; ?></title>
</head>

<body>

    <header>
        <img class="logo" src="/Img/Книга.svg" alt="">
        <nav class="nav">
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
            </ul>
        </nav>
    </header>

    <main>
        <!-- fixme это должно быть на главной странице в основном контенте, а не в навигации ok -->
        <?php if ($_SERVER['REQUEST_URI'] === APP\Action\Books::getUrl($book->year)): ?>
            Книги за <?= $book->year ?> год
        <?php else: ?>
            <a href="<?= APP\Action\Books::getUrl($book->year)?>">Книги за <?= $book->year ?> год</a>
        <?php endif; ?>
        <br>

        <?=  $content; ?>
    </main>

    <footer>
        footer
    </footer>

</body>
</html>