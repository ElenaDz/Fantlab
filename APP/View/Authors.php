<?php
use APP\Entity\Author;

/** @var Author[] $authors */

?>
<h1>Список авторов:</h1>

<ul>
    <?php foreach ($authors as $author):  ?>
        <li>
            <a href="<?= \APP\Action\Author::getUrl($author->name) ?>">
                <?= $author->name; ?>
                <!-- fixme убрать из шаблона обращение к модели + нельзя обращаться к БД для каждого автора отдельно
                           их может быть и 100, один запрос для всех авторов ok-->
                (Книг:  <?= $author->count_book; ?>)
            </a>
        </li>
    <?php endforeach ?>
</ul>

