<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var backend\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

use backend\models\UserForm;
use common\models\User;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Users and access';
$this->params['breadcrumbs'][] = $this->title;

$statusClass = [
    User::STATUS_ACTIVE => 'badge-success',
    User::STATUS_PENDING => 'badge-warning',
    User::STATUS_SUSPENDED => 'badge-dark',
    User::STATUS_INACTIVE => 'badge-secondary',
];
?>
<div class="user-index">
    <div class="mb-3 text-right">
        <?= Html::a('+ Add New User', ['create'], ['class' => 'btn btn-dark']) ?>
    </div>

    <?= Html::beginForm(['index'], 'get', ['class' => 'form-row mb-3']) ?>
    <div class="col-md-6">
        <?= Html::activeTextInput($searchModel, 'q', ['class' => 'form-control', 'placeholder' => 'Search by name or email...']) ?>
    </div>
    <div class="col-md-2">
        <?= Html::activeDropDownList($searchModel, 'role', UserForm::roleLabels(), ['class' => 'form-control', 'prompt' => 'Role']) ?>
    </div>
    <div class="col-md-2">
        <?= Html::activeDropDownList($searchModel, 'status', User::statusLabels(), ['class' => 'form-control', 'prompt' => 'Status']) ?>
    </div>
    <div class="col-md-2">
        <?= Html::submitButton('Filter', ['class' => 'btn btn-outline-dark']) ?>
        <?= Html::a('Clear', ['index'], ['class' => 'btn btn-link']) ?>
    </div>
    <?= Html::endForm() ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped align-middle'],
        'summary' => 'Showing {begin}-{end} of {totalCount} users',
        'columns' => [
            [
                'attribute' => 'nome',
                'label' => 'Name',
                'value' => static fn (User $m) => $m->perfil?->nome ?? $m->username,
            ],
            ['attribute' => 'email', 'label' => 'Email'],
            [
                'label' => 'Role',
                'value' => static function (User $m) {
                    $role = $m->getRoleName();

                    return $role === null ? '-' : (UserForm::roleLabels()[$role] ?? $role);
                },
            ],
            [
                'attribute' => 'status',
                'label' => 'Status',
                'format' => 'raw',
                'value' => static fn (User $m) => Html::tag(
                    'span',
                    Html::encode($m->getStatusLabel()),
                    ['class' => 'badge ' . ($statusClass[$m->status] ?? 'badge-secondary')],
                ),
            ],
            [
                'class' => ActionColumn::class,
                'header' => 'Actions',
                'template' => '{update} {activate} {deactivate} {delete}',
                'buttons' => [
                    'update' => static fn ($url) => Html::a('Edit', $url, ['class' => 'btn btn-sm btn-outline-dark']),
                    'activate' => static fn ($url) => Html::a('Activate', $url, [
                        'class' => 'btn btn-sm btn-outline-success',
                        'data-method' => 'post',
                    ]),
                    'deactivate' => static fn ($url) => Html::a('Deactivate', $url, [
                        'class' => 'btn btn-sm btn-outline-secondary',
                        'data-method' => 'post',
                        'data-confirm' => 'Deactivate this user? You can activate it again later.',
                    ]),
                    'delete' => static fn ($url) => Html::a('Delete', $url, [
                        'class' => 'btn btn-sm btn-outline-danger',
                        'data-method' => 'post',
                        'data-confirm' => 'Delete this user? It will disappear from this list.',
                    ]),
                ],
                'visibleButtons' => [
                    'activate' => static fn (User $m) => $m->status !== User::STATUS_ACTIVE,
                    'deactivate' => static fn (User $m) => $m->status !== User::STATUS_INACTIVE
                        && (int) $m->id !== (int) Yii::$app->user->id,
                    'delete' => static fn (User $m) => (int) $m->id !== (int) Yii::$app->user->id,
                ],
            ],
        ],
    ]) ?>
</div>