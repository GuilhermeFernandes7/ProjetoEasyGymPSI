<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use common\models\User;
use yii\helpers\Html;

$this->title = 'Overview';

$identity = Yii::$app->user->identity;
$role = $identity->getPanelRole();
$name = $identity->perfil?->nome ?? $identity->username;

// [titulo, valor, icone, cor]. "—" = ainda sem dados (Fase 2).
$boxes = match ($role) {
    'admin' => [
            ['Revenue this month', '—', 'euro-sign', 'bg-info'],
            ['Overdue', '—', 'exclamation-circle', 'bg-danger'],
            ['Active members', '—', 'users', 'bg-success'],
            ['Pending pre-registrations', (string) User::find()->where(['status' => User::STATUS_PENDING])->count(), 'user-clock', 'bg-warning'],
    ],
    'funcionario' => [
            ['Total active clients', '—', 'users', 'bg-info'],
            ['Pending evaluations', '—', 'heartbeat', 'bg-warning'],
            ['Sessions today', '—', 'calendar-day', 'bg-success'],
    ],
    default => [
            ['Membership plan', '—', 'id-card', 'bg-info'],
            ['Balance due', '—', 'credit-card', 'bg-warning'],
            ['Invoices', '—', 'file-invoice', 'bg-success'],
    ],
};
?>
<p class="lead">Welcome, <?= Html::encode($name) ?>.</p>

<div class="row">
    <?php foreach ($boxes as [$label, $value, $icon, $color]): ?>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon <?= $color ?> elevation-1"><i class="fas fa-<?= $icon ?>"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?= Html::encode($label) ?></span>
                    <span class="info-box-number"><?= Html::encode($value) ?></span>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>