<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var backend\models\UserForm $model */

use yii\helpers\Html;

$this->title = 'Create user';
$this->params['breadcrumbs'][] = ['label' => 'Users and access', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>
<?= $this->render('_form', ['model' => $model]) ?>