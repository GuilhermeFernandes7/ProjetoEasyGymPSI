<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Home';
$this->params['fullWidth'] = true;
$img = static fn (string $file): string => Url::to('@web/trainer/img/' . $file);
?>
<section class="probootstrap-intro" style="background-image: url(<?= $img('hero_bg_1_b.jpg') ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-7 probootstrap-intro-text">
                <h1 class="probootstrap-animate" data-animate-effect="fadeIn"><span>Easy Gym</span> Leiria</h1>
                <div class="probootstrap-subtitle probootstrap-animate" data-animate-effect="fadeIn">
                    <h2>Train with us</h2>
                </div>
                <p class="mt-4">
                    <?= Html::a('See memberships', ['/site/memberships'], ['class' => 'btn btn-primary btn-lg']) ?>
                </p>
            </div>
        </div>
    </div>
    <span class="probootstrap-animate"><a class="probootstrap-scroll-down js-next" href="#next-section">Scroll down <i class="icon-chevron-down"></i></a></span>
</section>

<section id="next-section" class="probootstrap-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="probootstrap-heading mt0 mb50">What we offer</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3 mb30">
                <div class="probootstrap-program">
                    <a href="<?= Url::to(['/site/memberships']) ?>"><img src="<?= $img('img_1.jpg') ?>" alt="Group classes" class="img-fluid rounded"></a>
                    <h3>Group classes</h3>
                    <p>Book your spot online.</p>
                    <p>HIIT, spinning, yoga and more. Check the schedule and book your spot online.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb30">
                <div class="probootstrap-program">
                    <a href="<?= Url::to(['/site/memberships']) ?>"><img src="<?= $img('img_2.jpg') ?>" alt="Personal training" class="img-fluid rounded"></a>
                    <h3>Personal training</h3>
                    <p>Follow-up by a personal trainer.</p>
                    <p>One-to-one sessions with our trainers, with a plan built around your goals.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb30">
                <div class="probootstrap-program">
                    <a href="<?= Url::to(['/site/memberships']) ?>"><img src="<?= $img('img_3.jpg') ?>" alt="Workout plans" class="img-fluid rounded"></a>
                    <h3>Workout plans</h3>
                    <p>A plan made for you.</p>
                    <p>Plans prescribed by your trainer, available in the member area and in the app.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb30">
                <div class="probootstrap-program">
                    <a href="<?= Url::to(['/site/memberships']) ?>"><img src="<?= $img('img_4.jpg') ?>" alt="Physical evaluations" class="img-fluid rounded"></a>
                    <h3>Physical evaluations</h3>
                    <p>Track your progress.</p>
                    <p>Regular evaluations of weight, body fat and muscle mass, to see your progress.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="probootstrap-section probootstrap-section-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="probootstrap-heading mt0 mb50">Why train with us</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="probootstrap-box">
                    <h4>Book online</h4>
                    <p>Reserve your group classes and PT evaluations from the member area.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="probootstrap-box">
                    <h4>Your plan, always with you</h4>
                    <p>Consult your workout plan and your membership details.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="probootstrap-box">
                    <h4>Stay informed</h4>
                    <p>Receive notifications about your classes and evaluations.</p>
                </div>
            </div>
        </div>
    </div>
</section>
