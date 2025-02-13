<?php

/** @var string $title */
/** @var string $content */
/** @var \APP\Entity\Book $book */

// todo сделай минимальные стили чтобы сайт был похож на сайт чтобы было понятно где навигация где основной контент где футор
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
                    <!-- fixme это должно быть на главной странице в основном контенте, а не в навигации -->
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
        <!-- fixme это должно быть в шаблоне главной странице а не здесь -->
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