<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var common\models\User $model */

use backend\models\UserForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->perfil?->nome ?? $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users and access', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$role = $model->getRoleName();
?>
<div class="card">
    <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'table table-striped table-bordered detail-view'],
            'attributes' => [
                ['label' => 'Full name', 'value' => $model->perfil?->nome],
                'username',
                'email',
                ['label' => 'Role', 'value' => $role === null ? '-' : (UserForm::roleLabels()[$role] ?? $role)],
                ['label' => 'Status', 'value' => $model->getStatusLabel()],
                ['label' => 'Created', 'value' => date('Y-m-d H:i', $model->created_at)],
                ['label' => 'Updated', 'value' => date('Y-m-d H:i', $model->updated_at)],
            ],
        ]) ?>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-dark']) ?>
    </div>
</div>