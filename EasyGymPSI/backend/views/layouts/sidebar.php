<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $assetDir */

use backend\models\UserForm;
use hail812\adminlte\widgets\Menu;
use yii\helpers\Html;

$identity = Yii::$app->user->identity;
$role = $identity?->getPanelRole();

// Itens sem 'url' ainda nao tem pagina (ficam para a Fase 2).
$menus = [
    'funcionario' => [
        ['label' => 'Overview', 'icon' => 'tachometer-alt', 'url' => ['/site/index']],
        ['label' => 'Clients', 'icon' => 'users'],
        ['label' => 'Training plans', 'icon' => 'clipboard-list'],
        ['label' => 'Evaluations', 'icon' => 'heartbeat'],
        ['label' => 'Exercise library', 'icon' => 'dumbbell'],
        ['label' => 'Calendar', 'icon' => 'calendar-alt'],
    ],
    'admin' => [
        ['label' => 'Overview', 'icon' => 'tachometer-alt', 'url' => ['/site/index']],
        ['label' => 'Classes', 'icon' => 'chalkboard-teacher'],
        ['label' => 'Schedules', 'icon' => 'calendar-alt'],
        ['label' => 'Users and access', 'icon' => 'users-cog', 'url' => ['/user/index']],
        ['label' => 'Finances', 'icon' => 'euro-sign'],
        ['label' => 'Reports', 'icon' => 'chart-bar'],
    ],
];
$items = $role !== null ? ($menus[$role] ?? []) : [];
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= Html::encode(Yii::$app->homeUrl) ?>" class="brand-link">
        <span class="brand-text font-weight-light"><?= Html::encode(Yii::$app->name) ?></span>
    </a>

    <div class="sidebar">
        <?php if ($identity !== null): ?>
            <div class="user-panel mt-3 pb-3 mb-3">
                <span class="d-block text-white"><?= Html::encode($identity->perfil?->nome ?? $identity->username) ?></span>
                <small class="text-muted"><?= Html::encode(UserForm::roleLabels()[$role] ?? '') ?></small>
            </div>
        <?php endif ?>

        <nav class="mt-2">
            <?= Menu::widget(['items' => $items]) ?>
        </nav>
    </div>
</aside>