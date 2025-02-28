<?php
use APP\Entity\Book;
use SYS\Views;

/** @var string $title */
/** @var string $content */
/** @var array $bread_crumbs */
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

        <img class="logo" src="../../../assets/imgs/logo/Book.svg" alt="FantLab">

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
                <li>
                    <?php if ($_SERVER['REQUEST_URI'] === \APP\Action\Authors::getUrl()): ?>
                        Авторы
                    <?php else: ?>
                        <a href="<?= \APP\Action\Authors::getUrl() ?>">Авторы</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>

    </header>

    <main>
        <?php if ($_SERVER['REQUEST_URI'] !== \APP\Action\Index::getUrl()): ?>

            <?=
                Views::get(
                    __DIR__ . '/../Blocks/BreadCrumbs.php',
                    [
                        'bread_crumbs' => $bread_crumbs
                    ]
                );
            ?>

        <?php endif; ?>

        <?= $content; ?>
    </main>

    <footer>
        footer
    </footer>

</body>
</html>