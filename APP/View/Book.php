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
        <dd class="author_name"><a href="<?= \APP\Action\Author::getUrl($book->author_name) ?>"><?= $book->author_name; ?></a></dd>
    </div>

    <div class="item">
        <dt>Тип:</dt>
        <dd class="type"><?= $book->type; ?></dd>
    </div>

    <div class="item">
        <dt>Год выхода:</dt>
        <dd class="release">
            <!-- todo добавь возраст автора на момент написания книги, как здесь https://allking.club/books/Rattlesnakes/
                  используй DateTime diff для расчета возраста и найти функцию которая выбирает форму слова в зависимости от числа (год, года, лет) -->
            <a href="<?= \APP\Action\Books::getUrl($book->year) ?>"><?= $book->year; ?></a>
        </dd>
    </div>
    
    <div class="item">
        <dt><b>Описание:</b></dt>
        <dd class="description"><?= $book->description; ?></dd>
    </div>
</dl>

