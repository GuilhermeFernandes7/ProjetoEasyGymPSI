<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'About';
$this->params['fullWidth'] = true;
?>
<section class="probootstrap-intro probootstrap-intro-inner" style="background-image: url(<?= Url::to('@web/trainer/img/hero_bg_1_b.jpg') ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-7 probootstrap-intro-text">
                <h1 class="probootstrap-animate" data-animate-effect="fadeIn">About us</h1>
                <div class="probootstrap-subtitle probootstrap-animate" data-animate-effect="fadeIn">
                    <h2><?= Html::encode(Yii::$app->name) ?></h2>
                </div>
            </div>
        </div>
    </div>
    <span class="probootstrap-animate"><a class="probootstrap-scroll-down js-next" href="#next-section">Scroll down <i class="icon-chevron-down"></i></a></span>
</section>

<section id="next-section" class="probootstrap-section">
    <div class="container">
        <div class="row probootstrap-gutter60 mb50">
            <div class="col-md-6">
                <figure><img src="<?= Url::to('@web/trainer/img/about_me.jpg') ?>" alt="<?= Html::encode(Yii::$app->name) ?>" class="img-fluid"></figure>
            </div>
            <div class="col-md-6">
                <h2 class="probootstrap-heading">Our mission</h2>
                <p class="eg-todo">[mission text]</p>
                <p><?= Html::a('Get in touch', ['/site/contact'], ['class' => 'btn btn-primary']) ?></p>
            </div>
        </div>

        <h2 class="probootstrap-heading mb50">Our team</h2>
        <div class="row">
            <?php for ($i = 0; $i < 4; $i++): ?>
                <div class="col-6 col-md-3 mb30">
                    <div class="eg-avatar"></div>
                    <h4 class="eg-todo">[name]</h4>
                    <p class="eg-todo">[role]</p>
                </div>
            <?php endfor ?>
        </div>
    </div>
</section>
