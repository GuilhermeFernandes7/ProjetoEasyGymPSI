<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var backend\models\UserForm $model */

use backend\models\UserForm;
use common\models\User;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>
<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput()->hint(
        $model->id ? 'Leave blank to keep the current password.' : 'Minimum 8 characters.',
    ) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'role')->dropDownList(UserForm::roleLabels(), ['prompt' => 'Select role']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList(User::statusLabels()) ?>
        </div>
    </div>

    <div class="mt-3">
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        <?= Html::submitButton('Save user', ['class' => 'btn btn-dark']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>