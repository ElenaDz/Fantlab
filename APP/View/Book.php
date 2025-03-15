<?php
use APP\Entity\Book;

/** @var Book $book */
?>
<?php if ($book->getCover()):?>
    <!-- fixme логика формирования урл обложки должна быть не здесь, а в классе книги  -->
    <img class="logo_book" src="/assets/imgs/covers/<?= $book->getId(); ?>.jpg"
         alt="Обложка книги <?= $book->getTitle(); ?>"
    >
<?php endif; ?>

<h1><?= $book->getTitle(); ?></h1>

<dl class="book">
    <div class="item">
        <dt>Название:</dt>
        <dd class="name"><?= $book->getTitle(); ?></dd>
    </div>

    <div class="item">
        <dt>Оригинальное название:</dt>
        <dd class="title_original"><?= $book->getTitleOriginal(); ?></dd>
    </div>

    <div class="item">
        <dt>Автор:</dt>
        <dd class="author_name"><a href="<?= \APP\Action\Author::getUrl($book->author_name) ?>"><?= $book->author_name; ?></a></dd>
    </div>

    <div class="item">
        <dt>Тип:</dt>
        <dd class="type"><?= $book->getType(); ?></dd>
    </div>

    <div class="item">
        <dt>Год выхода:</dt>
        <dd class="release">
            <a href="<?= \APP\Action\Books::getUrl($book->getYear()) ?>"><?= $book->getYear(); ?></a> &nbsp
            (<?= $book->getAuthorAge() ?>)
        </dd>
    </div>
    
    <div class="item">
        <dt><b>Описание:</b></dt>
        <!-- fixme отступ не такой как у пунктов выше -->
        <dd class="description"><?= $book->getDescription(); ?></dd>
    </div>
</dl>

<form class="update_book" action="<?= \APP\Action\Admin\BookUpdate::getUrl()?>" method="post">
    <label>
        <input type="hidden" name="id" value="<?= $book->getId()?>">
    </label>
    <button>Изменить книгу</button>
</form >

<form class="delete_book" action="<?= \APP\Action\Admin\BookDelete::getUrl()?>" method="post">
    <label>
        <input type="hidden" name="id" value="<?= $book->getId()?>">
    </label>
    <button>Удалить книгу</button>
</form>



