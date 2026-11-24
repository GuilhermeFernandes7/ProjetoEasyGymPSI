<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $title */
/** @var string[] $sections */

use yii\helpers\Html;

$this->title = $title;
?>
<h2 class="probootstrap-heading mt0 mb30"><?= Html::encode($title) ?></h2>
<?= $this->render('_tabs') ?>

<div class="row">
    <?php foreach ($sections as $section): ?>
        <div class="col-md-4 mb-4">
            <div class="probootstrap-box">
                <h4><?= Html::encode($section) ?></h4>
                <p class="text-muted mb-0">Available soon.</p>
            </div>
        </div>
    <?php endforeach ?>
</div>