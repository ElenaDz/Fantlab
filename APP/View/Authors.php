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
                (Книг: <?= $author->count_book; ?>)
            </a>
        </li>
    <?php endforeach ?>
</ul>

