<?php

declare(strict_types=1);

use yii\helpers\Html;

$identity = Yii::$app->user->identity;
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <?php if ($identity !== null): ?>
                <?= Html::beginForm(['/site/logout'], 'post') ?>
                <?= Html::submitButton('Logout (' . Html::encode($identity->username) . ')', ['class' => 'btn btn-link nav-link']) ?>
                <?= Html::endForm() ?>
            <?php else: ?>
                <?= Html::a('Login', ['/site/login'], ['class' => 'nav-link']) ?>
            <?php endif ?>
        </li>
    </ul>
</nav>