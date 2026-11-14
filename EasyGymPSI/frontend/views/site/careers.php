<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

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
                <?php /* TODO (back-end): este formulario ainda nao grava nada.
                         Sera ligado ao registo: cria o utilizador em estado "pendente"
                         com o role funcionario, e o admin aprova em "Users and access". */ ?>
                <form class="probootstrap-form probootstrap-form-box" onsubmit="return false;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="app-name">Name</label>
                                <input type="text" class="form-control" id="app-name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="app-email">Email</label>
                                <input type="email" class="form-control" id="app-email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="app-phone">Phone</label>
                        <input type="text" class="form-control" id="app-phone">
                    </div>
                    <div class="form-group mb-3">
                        <label for="app-message">Message</label>
                        <textarea rows="6" class="form-control" id="app-message"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary">Send application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
