<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var frontend\models\RegistrationForm $model */

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\Alert;
use yii\bootstrap5\ActiveForm;

$this->title = 'Memberships';
$this->params['fullWidth'] = true;

// Nomes dos planos tirados dos wireframes (Basic / Premium / Student).
// Precos e beneficios ainda por definir.
$plans = [
        [
                'name' => 'Basic', 'popular' => false, 'price' => '19,99 €',
                'benefits' => ['Access to the gym floor', 'Member area and mobile app', 'Online class booking'],
        ],
        [
                'name' => 'Premium', 'popular' => true, 'price' => '29,99 €',
                'benefits' => ['Everything in Basic', 'Unlimited group classes', 'Personalised workout plan', 'Quarterly PT evaluation'],
        ],
        [
                'name' => 'Student', 'popular' => false, 'price' => '14,99 €',
                'benefits' => ['Access to the gym floor', 'Member area and mobile app', 'Valid student card required'],
        ],
];
?>
<section class="probootstrap-intro probootstrap-intro-inner" style="background-image: url(<?= Url::to('@web/trainer/img/hero_bg_1_b.jpg') ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-7 probootstrap-intro-text">
                <h1 class="probootstrap-animate" data-animate-effect="fadeIn">Memberships</h1>
                <div class="probootstrap-subtitle probootstrap-animate" data-animate-effect="fadeIn">
                    <h2>Pricing and memberships</h2>
                </div>
            </div>
        </div>
    </div>
    <span class="probootstrap-animate"><a class="probootstrap-scroll-down js-next" href="#next-section">Scroll down <i class="icon-chevron-down"></i></a></span>
</section>

<section id="next-section" class="probootstrap-section">
    <div class="container">
        <div class="probootstrap-pricing-wrap">
            <div class="row">
                <?php foreach ($plans as $plan): ?>
                    <div class="col-md-4">
                        <div class="probootstrap-pricing<?= $plan['popular'] ? ' popular' : '' ?>">
                            <h3><?= Html::encode($plan['name']) ?></h3>
                            <div class="probootstrap-price-wrap">
                                <span class="probootstrap-price"><?= Html::encode($plan['price']) ?></span>
                                <span class="probootstrap-price-per-month">per month</span>
                            </div>
                            <ul>
                                <?php foreach ($plan['benefits'] as $benefit): ?>
                                    <li><?= Html::encode($benefit) ?></li>
                                <?php endforeach ?>
                            </ul>
                            <p><a href="#pre-registration" class="btn btn-primary">Choose <?= Html::encode($plan['name']) ?></a></p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>

<section id="pre-registration" class="probootstrap-section probootstrap-section-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="probootstrap-heading mt0 mb50">Pre-registration</h2>
                <?= Alert::widget() ?>
                <?php $form = ActiveForm::begin([
                        'action' => Url::to(['/site/memberships', '#' => 'pre-registration']),
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
                    <?= Html::submitButton('Request pre-registration', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
