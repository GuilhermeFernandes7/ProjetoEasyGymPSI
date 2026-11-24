<?php

declare(strict_types=1);

use yii\helpers\Html;

$current = Yii::$app->controller->action->id;
$tabs = [
    'index' => 'Overview',
    'membership' => 'Membership',
    'billing' => 'Billing',
    'invoices' => 'Invoices',
    'freeze' => 'Freeze',
];
?>
<ul class="nav nav-pills mb-4">
    <?php foreach ($tabs as $action => $label): ?>
        <li class="nav-item">
            <?= Html::a(
                Html::encode($label),
                ['/client/' . $action],
                ['class' => 'nav-link' . ($current === $action ? ' active' : '')],
            ) ?>
        </li>
    <?php endforeach ?>
</ul>