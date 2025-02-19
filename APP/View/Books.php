<?php
use APP\Entity\Book;

/** @var Book[] $books */
/** @var string $title_year */
?>

<!-- todo используй вот такие конструкции в шаблонах -->
<?php if(true): ?>

    это будет видно 1

<?php else: ?>

    а это нет 1

<?php endif; ?>
<br>

<?= true ? 'это будет видно 2' : 'а это нет 2'; ?><br>

<!-- fixme не правильно, логика как именно должен выглядеть заголовок должна быть в шаблоне, а у тебя она в контроллере -->
<h1>Книги <?= $title_year ?></h1>

<ul>
    <?php foreach ($books as $book):  ?>

        <li>
            <a href="<?= \APP\Action\Book::getUrl($book) ?>">
                <?= $book->title; ?>
                (<?= $book->year; ?>)
            </a>
        </li>

    <?php endforeach ?>
</ul>
