<?php
use APP\Entity\Book;

/** @var Book $book */
$has_book = !empty($book);
?>

<form action="." method="post">
    <input value="<?=$has_book ?>" name="is_update" type="hidden">

    <label>
        <span>ID</span>
        <input class="book_id"
               type="text"
               name="id" size="10"
               readonly
               value="<?= $has_book ? $book->getId() : null; ?>"
        >
    </label>

    <label>
        <span>Название*</span>
        <input type="text" name="title" size="200" required value="<?= $has_book ? $book->getTitle() : null; ?>">
    </label>

    <label>
        <span>Оригинальное название*</span>
        <input type="text"
               name="title_original"
               size="200"
               required
               value="<?= $has_book ? $book->getTitleOriginal() : null; ?>"
        >
    </label>

    <label>
        <span>Автор*</span>
        <input type="text"
               name="author_name"
               size="60"
               required
               value="<?= $has_book ? $book->getAuthorName() : null; ?>"
        >
    </label>

    <label>
        <span>Жанр*</span>
        <select class="type" name="type" required>
            <option value=""></option>
            <?php foreach (\APP\Entity\TypeBook::getAll() as $type => $type_title) :?>
                <?php if ($has_book): ?>

                    <option <?= $book->getType() == $type_title ? "selected" : '' ; ?>
                            value="<?= $type_title; ?>"><?= $type_title; ?></option>

                <?php else: ?>
                    <option value="<?= $type_title; ?>"><?= $type_title; ?></option>
                <?php endif; ?>

            <?php endforeach; ?>
        </select>
    </label>

    <label>
        <span>Год выхода*</span>
        <input class="release_year"
               type="number"
               min="<?= \APP\Entity\Book::MIN_YEAR; ?>"
               max="<?= date('Y'); ?>"
               name="year" size="10"
               value="<?= $has_book ? $book->getYear() : null; ?>"
               required
        >
    </label>

    <label>
        <span>Описание*</span>
        <textarea name="description"
                  rows="5"
                  cols="100"
                  required
        >
            <?= $has_book ? $book->getDescription() : null; ?>
        </textarea>
    </label>

    <label>
        <span>Url Обложки</span>
        <input type="url" name="cover_url" value="<?= $has_book ? $book->getCoverPath() : null; ?>" size="200" >
    </label>

    <input class="button_add" type="submit" value="<?= $has_book ? 'Изменить книгу' : 'Добавить книгу'; ?>">
    <p class="additional_information">
        * - обязательное поле
    </p>
</form>
