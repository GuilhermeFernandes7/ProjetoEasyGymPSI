<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var bool $solid */

use yii\helpers\Html;

$route = Yii::$app->controller->route;

// [rotulo, rota]
$items = [
    ['Home', 'site/index'],
    ['Memberships', 'site/memberships'],
    ['About and Contacts', 'site/about'],
    ['Careers', 'site/careers'],
];
?>
<header role="banner" class="probootstrap-header<?= $solid ? ' probootstrap-header-solid' : '' ?>">
    <div class="container-fluid">
        <?= Html::a(Html::encode(Yii::$app->name) . '<span>.</span>', ['/site/index'], ['class' => 'probootstrap-logo']) ?>

        <a href="#" class="probootstrap-burger-menu d-block d-sm-none"><i>Menu</i></a>
        <div class="mobile-menu-overlay"></div>

        <nav role="navigation" class="probootstrap-nav d-none d-sm-block">
            <ul class="probootstrap-main-nav">
                <?php foreach ($items as [$label, $itemRoute]): ?>
                    <li<?= $route === $itemRoute ? ' class="active"' : '' ?>>
                        <?= Html::a(Html::encode($label), ['/' . $itemRoute]) ?>
                    </li>
                <?php endforeach ?>

                <?php if (Yii::$app->user->isGuest): ?>
                    <li class="probootstrap-cta">
                        <?= Html::a('Login', 'http://localhost/ProjetoEasyGymPSI/EasyGymPSI/backend/web/site/login') ?>
                    </li>
                <?php else: ?>
                    <li class="probootstrap-cta">
                        <?= Html::beginForm(['/site/logout'], 'post') ?>
                        <?= Html::submitButton(
                            'Logout (' . Html::encode(Yii::$app->user->identity->username) . ')',
                            ['class' => 'nav-logout'],
                        ) ?>
                        <?= Html::endForm() ?>
                    </li>
                <?php endif ?>
            </ul>
        </nav>
    </div>
</header>
