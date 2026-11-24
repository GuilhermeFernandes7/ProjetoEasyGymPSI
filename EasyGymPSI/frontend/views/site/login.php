<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 class="probootstrap-heading mt0 mb50">Login</h2>

        <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'probootstrap-form probootstrap-form-box'],
        ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group mt-3">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <p class="mt-4">
            New here? <?= Html::a('Pre-register on Memberships', ['/site/memberships', '#' => 'pre-registration']) ?>.
            Accounts are activated after approval by our team.
        </p>
    </div>
</div>