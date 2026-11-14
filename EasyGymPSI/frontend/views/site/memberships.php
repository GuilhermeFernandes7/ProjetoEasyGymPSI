<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Memberships';
$this->params['fullWidth'] = true;

// Nomes dos planos tirados dos wireframes (Basic / Premium / Student).
// Precos e beneficios ainda por definir.
$plans = [
    ['name' => 'Basic', 'popular' => false],
    ['name' => 'Premium', 'popular' => true],
    ['name' => 'Student', 'popular' => false],
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
                                <span class="probootstrap-price eg-todo">[price]</span>
                                <span class="probootstrap-price-per-month">per month</span>
                            </div>
                            <ul>
                                <li class="eg-todo">[benefit]</li>
                                <li class="eg-todo">[benefit]</li>
                                <li class="eg-todo">[benefit]</li>
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
                <?php /* TODO (back-end): este formulario ainda nao grava nada.
                         Sera ligado ao registo: cria o utilizador em estado "pendente"
                         com o role cliente, e o admin aprova em "Users and access". */ ?>
                <form class="probootstrap-form probootstrap-form-box" onsubmit="return false;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="pre-name">Name</label>
                                <input type="text" class="form-control" id="pre-name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="pre-email">Email</label>
                                <input type="email" class="form-control" id="pre-email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="pre-phone">Phone</label>
                                <input type="text" class="form-control" id="pre-phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="pre-plan">Plan</label>
                                <select class="form-control" id="pre-plan">
                                    <?php foreach ($plans as $plan): ?>
                                        <option><?= Html::encode($plan['name']) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary">Request pre-registration</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
