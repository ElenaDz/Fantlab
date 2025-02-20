<?php

/** @var string $title */
/** @var string $content */
/** @var array $bread_crumbs */
/** @var Book $book */

use APP\Entity\Book;

// fixme у страницы есть горизонтальный scroll, он недопустим, избавься от него ok
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
        <?php if ($_SERVER['REQUEST_URI'] !== \APP\Action\Index::getUrl()): ?>
            <?= $bread_crumbs?>
        <?php endif; ?>

        <?=  $content; ?>
    </main>

    <footer>
        footer
    </footer>

</body>
</html>