<?php
use APP\Entity\Author;
use APP\Entity\Book;
use SYS\Views;

/** @var Author $author */
/** @var Book[] $books */
?>

<?php if ($author->cover):?>
    <img class="portrait" src="/assets/imgs/authors/<?= $author->id; ?>.jpg"
         alt="Фото автора <?= $author->name; ?>"
    >
<?php endif; ?>

<h1><?= $author->name; ?></h1>

<dl class="author">
    <div class="item">
        <dt>Страна:</dt>
        <dd class="country"><?= $author->country; ?></dd>
    </div>

    <div class="item">
        <dt>Родился:</dt>
        <dd class="birthday">
            <?= $author->getBirthday(); ?>
        </dd>
    </div>

    <?php if ( ! empty($author->getDeath())):?>
            <div class="item">
                <dt>Умер:</dt>
                <dd class="death"><?= $author->getDeath(); ?></dd>
            </div>
    <?php endif; ?>
</dl>

<?=
    Views::get(
        __DIR__ . '/../View/Books.php',
        [
            'books' => $books
        ]
    );
?>
