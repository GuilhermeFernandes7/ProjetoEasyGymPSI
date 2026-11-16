<?php

/* @var $this \yii\web\View */
/* @var $model \frontend\models\ContactForm */
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'About and Contacts';
?>

<style>
    header.probootstrap-header {
        position: relative !important;
        background-color: #141519 !important;
        min-height: 100px !important;
        overflow: visible !important;
        z-index: 999999 !important;
    }
    .site-about-fix {
        padding-top: 30px !important;
        background-color: #ffffff;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var header = document.querySelector('.probootstrap-header');
        if (header) {
            header.classList.add('probootstrap-header-solid');
        }
    });
</script>

<div class="container site-about-fix mb-5">

    <!-- Our Mission Section -->
    <div class="mb-5">
        <h2>Our mission</h2>
        <p class="lead">At Easy Gym Leiria we believe training is for everyone. We combine modern equipment, expert coaching and a simple online area where you can book classes, follow your plan and track your progress.</p>
        <div class="row text-center mt-4">
            <div class="col-md-4">
                <div class="card p-4 h-100 shadow-sm">
                    <h5>Commitment</h5>
                    <p class="mb-0">We support every member with personal follow-up, from the first evaluation to the last repetition.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100 shadow-sm">
                    <h5>Community</h5>
                    <p class="mb-0 ">Group classes and a welcoming atmosphere where everyone has a place.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100 shadow-sm">
                    <h5>Progress</h5>
                    <p class="mb-0">Clear goals, tailored workout plans and regular physical evaluations.</p>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <!-- Our Team Section -->
    <div class="mb-5">
        <h2>Our team</h2>
        <div class="row mt-4">
            <?php
            $team = [
                    ['Marta Oliveira', 'Gym Manager'],
                    ['Rui Andrade', 'Personal Trainer'],
                    ['Sofia Mendes', 'Front Desk'],
                    ['Tiago Ramos', 'Group Classes Instructor'],
            ];
            foreach ($team as [$name, $role]):
                $initials = implode('', array_map(static fn (string $w) => mb_substr($w, 0, 1), explode(' ', $name)));
                ?>
                <div class="col-md-3 text-center mb-3">
                    <div class="eg-avatar d-flex align-items-center justify-content-center mx-auto">
                        <span class="display-4 text-muted"><?= Html::encode($initials) ?></span>
                    </div>
                    <strong><?= Html::encode($name) ?></strong><br>
                    <small class="text-muted"><?= Html::encode($role) ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <hr class="my-5">

    <!-- Contact and Find Us Section -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <h2>Contact us</h2>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'placeholder' => 'Full name'])->label(false) ?>
            <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>
            <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Subject'])->label(false) ?>
            <?= $form->field($model, 'body')->textarea(['rows' => 5, 'placeholder' => 'Message'])->label(false) ?>

            <div class="form-group mt-3">
                <?= Html::submitButton('Send message', ['class' => 'btn btn-dark w-100', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-md-6 mb-4">
            <h2>Find us</h2>

            <iframe class="border-0 w-100 mb-3" style="height: 250px;" loading="lazy" title="Map of Leiria"
                    src="https://www.openstreetmap.org/export/embed.html?bbox=-8.83%2C39.73%2C-8.78%2C39.755&amp;layer=mapnik&amp;marker=39.7437%2C-8.8072"></iframe>

            <!-- Address Box -->
            <div class="card mb-3 p-3 shadow-sm">
                <strong class="mb-1">Easy gym Leiria</strong>
                <span class="eg-todo">Av. da malaposta 123, 2400-000 Leiria</span>
            </div>

            <!-- Operating Hours Box -->
            <div class="card p-3 shadow-sm">
                <strong class="mb-2">Operating Hours</strong>
                <ul class="list-unstyled mb-0 text-muted">
                    <li>Mon to Fri - 07:00 to 22:00</li>
                    <li>Saturday - 09:00 to 18:00</li>
                    <li>Sundays - 09:00 to 13:00</li>
                    <li>Holidays - 09:00 to 13:00</li>
                </ul>
            </div>
        </div>
    </div>
</div>