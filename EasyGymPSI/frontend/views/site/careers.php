<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var frontend\models\RegistrationForm $model */

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\Alert;
use yii\bootstrap5\ActiveForm;

$this->title = 'Careers';
$this->params['fullWidth'] = true;
?>
<section class="probootstrap-intro probootstrap-intro-inner" style="background-image: url(<?= Url::to('@web/trainer/img/hero_bg_1_b.jpg') ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-7 probootstrap-intro-text">
                <h1 class="probootstrap-animate" data-animate-effect="fadeIn">Careers</h1>
                <div class="probootstrap-subtitle probootstrap-animate" data-animate-effect="fadeIn">
                    <h2>Work with us</h2>
                </div>
            </div>
        </div>
    </div>
    <span class="probootstrap-animate"><a class="probootstrap-scroll-down js-next" href="#next-section">Scroll down <i class="icon-chevron-down"></i></a></span>
</section>

<section id="next-section" class="probootstrap-section">
    <div class="container">
        <h2 class="probootstrap-heading mt0 mb50">Open roles</h2>
        <div class="row">
            <div class="col-md-12">
                <?php for ($i = 0; $i < 3; $i++): ?>
                    <div class="probootstrap-box d-flex align-items-center justify-content-between">
                        <span class="eg-todo">[role title]</span>
                        <a href="#apply" class="btn btn-primary">Apply</a>
                    </div>
                <?php endfor ?>
            </div>
        </div>
    </div>
</section>

<section id="apply" class="probootstrap-section probootstrap-section-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="probootstrap-heading mt0 mb50">Apply to <?= Html::encode(Yii::$app->name) ?></h2>
                <?= Alert::widget() ?>
                <?php $form = ActiveForm::begin([
                        'action' => Url::to(['/site/careers', '#' => 'apply']),
                        'options' => ['class' => 'probootstrap-form probootstrap-form-box'],
                ]); ?>
                <div class="row">
                    <div class="col-md-6"><?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?></div>
                    <div class="col-md-6"><?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?></div>
                </div>
                <div class="row">
                    <div class="col-md-6"><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>
                    <div class="col-md-6"><?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?></div>
                </div>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group mt-3">
                    <?= Html::submitButton('Send application', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
