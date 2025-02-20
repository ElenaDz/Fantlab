<?php
/** @var array $bread_crumbs */

?>
<?php foreach ($bread_crumbs as $bread_crumb):?>

    <?php if (empty($bread_crumb['url'])): ?>
        <span>
                <?= $bread_crumb['name']; ?>
        </span>
    <?php else: ?>
        <a href="<?= $bread_crumb['url'] ?>">
            <?= $bread_crumb['name']; ?>
        </a>/
    <?php endif; ?>

<?php endforeach ?>