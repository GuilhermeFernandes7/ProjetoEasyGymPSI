<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var common\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
?>
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

        <?= $form->field($model, 'username', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>',
                'template' => '{beginWrapper}{input}{error}{endWrapper}',
                'wrapperOptions' => ['class' => 'input-group mb-3'],
        ])->label(false)->textInput(['autofocus' => true, 'placeholder' => 'Username']) ?>

        <?= $form->field($model, 'password', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
                'template' => '{beginWrapper}{input}{error}{endWrapper}',
                'wrapperOptions' => ['class' => 'input-group mb-3'],
        ])->label(false)->passwordInput(['placeholder' => 'Password']) ?>

        <div class="row">
            <div class="col-8">
                <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => '<div class="icheck-primary">{input}{label}</div>',
                        'labelOptions' => ['class' => ''],
                        'uncheck' => null,
                ]) ?>
            </div>
            <div class="col-4">
                <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>