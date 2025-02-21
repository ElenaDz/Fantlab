<?php
/** @var array $bread_crumbs */

/**
 * fixme это не layout это блок, такой как мы делали когда то в js с префиксом b_ и заведением отдельного js объекта для него например b_mini_player
 *  перенеси в папку Blocks ok
 */
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