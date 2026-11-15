<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $content */

use hail812\adminlte3\assets\AdminLteAsset;
use hail812\adminlte3\assets\FontAwesomeAsset;
use yii\helpers\Html;

FontAwesomeAsset::register($this);
AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | <?= Html::encode(Yii::$app->name) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <?= $this->render('navbar') ?>
        <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>
        <?= $this->render('content', ['content' => $content]) ?>
        <?= $this->render('footer') ?>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>