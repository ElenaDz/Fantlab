<?php
use APP\Entity\Book;

/** @var Book $book */
?>
<?php if ($book->cover):?>
    <img class="logo_book" src="/assets/imgs/covers/<?= $book->id; ?>.jpg"
         alt="Обложка книги <?= $book->title; ?>"
    >
<?php endif; ?>

<h1><?= $book->title; ?></h1>

<dl class="book">
    <div class="item">
        <dt>Название:</dt>
        <dd class="name"><?= $book->title; ?></dd>
    </div>

    <div class="item">
        <dt>Оригинальное название:</dt>
        <dd class="title_original"><?= $book->title_original; ?></dd>
    </div>

    <div class="item">
        <dt>Автор:</dt>
        <!-- fixme нельзя обращаться из шаблонов к моделям это нужно делать в контроллере -->
        <!-- todo здесь должна быть ссылка на страницу автора книги -->
        <dd class="author_name"><?= \APP\Model\Books::getNameAuthorById($book->id); ?></dd>
    </div>

    <div class="item">
        <dt>Тип:</dt>
        <dd class="type"><?= $book->type; ?></dd>
    </div>

    <div class="item">
        <dt>Год выхода:</dt>
        <!-- todo год должен быть ссылкой на книги за этот год -->
        <dd class="release"><?= $book->year; ?></dd>
    </div>
    
    <div class="item">
        <dt><b>Описание:</b></dt>
        <dd class="description"><?= $book->description; ?></dd>
    </div>
</dl>

