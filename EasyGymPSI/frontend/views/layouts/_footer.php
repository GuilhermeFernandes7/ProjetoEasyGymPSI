<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;

?>
<footer class="probootstrap-footer">
    <div class="probootstrap-backtotop"><a href="#" class="js-backtotop"><i class="icon-chevron-thin-up"></i></a></div>
    <div class="container">
        <div class="row mb50">
            <div class="col-md-4">
                <div class="probootstrap-footer-widget">
                    <h4><?= Html::encode(Yii::$app->name) ?></h4>
                    <p>Group classes, personal training, workout plans and physical evaluations.</p>
                </div>
            </div>
            <div class="col-md-3 offset-md-1">
                <div class="probootstrap-footer-widget">
                    <h4>Opening hours</h4>
                    <ul class="probootstrap-footer-link">
                        <li class="eg-todo">[to be filled in]</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="probootstrap-footer-widget">
                    <h4>Links</h4>
                    <ul class="probootstrap-footer-link float">
                        <li><?= Html::a('Home', ['/site/index']) ?></li>
                        <li><?= Html::a('Memberships', ['/site/memberships']) ?></li>
                        <li><?= Html::a('About', ['/site/about']) ?></li>
                    </ul>
                    <ul class="probootstrap-footer-link float">
                        <li><?= Html::a('Careers', ['/site/careers']) ?></li>
                        <li><?= Html::a('Contact', ['/site/contact']) ?></li>
                        <li><?= Html::a('Login', ['/site/login']) ?></li>
                    </ul>
                </div>
                <div class="probootstrap-footer-widget">
                    <h4>Contact info</h4>
                    <ul class="probootstrap-contact-info">
                        <li><i class="icon-location2"></i> <span class="eg-todo">[address]</span></li>
                        <li><i class="icon-mail"></i><span class="eg-todo">[email]</span></li>
                        <li><i class="icon-phone2"></i><span class="eg-todo">[phone]</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center border-top">
                <p class="mb0">
                    &copy; <?= date('Y') ?> <?= Html::encode(Yii::$app->name) ?>.<br>
                    Template <a href="https://uicookies.com/" rel="external">Trainer by uiCookies</a>.
                    Demo images Unsplash.com &amp; Pexels.com
                </p>
            </div>
        </div>
    </div>
</footer>
