<?php

/* @var $this \yii\web\View */
/* @var $model \frontend\models\ContactForm */
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'About and Contacts';
?>

<!-- 1. ESTILOS FORÇADOS (Garante a altura, o fundo escuro e impede o corte do texto) -->
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

<!-- 2. SCRIPT DE APOIO (Adiciona a classe do teu easygym.css automaticamente) -->
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
        <p class="eg-todo">[Mission statement (two or three lines about the gym's purpose and values)]</p>

        <div class="row text-center mt-4">
            <div class="col-md-4">
                <div class="card p-4 h-100 shadow-sm">
                    <h5>[Value 1]</h5>
                    <p class="mb-0 eg-todo">[Description]</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100 shadow-sm">
                    <h5>[Value 2]</h5>
                    <p class="mb-0 eg-todo">[Description]</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100 shadow-sm">
                    <h5>[Value 3]</h5>
                    <p class="mb-0 eg-todo">[Description]</p>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <!-- Our Team Section -->
    <div class="mb-5">
        <h2>Our team</h2>
        <div class="row mt-4">
            <?php for($i = 0; $i < 4; $i++): ?>
                <div class="col-md-3 text-center mb-3">
                    <div class="eg-avatar d-flex align-items-center justify-content-center mx-auto">
                        <span class="text-muted">Foto</span>
                    </div>
                    <strong>[Name]</strong><br>
                    <small class="text-muted">Role</small>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <hr class="my-5">

    <!-- Contact and Find Us Section -->
    <div class="row">
        <!-- Contact Form (Left Column) -->
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

        <!-- Find Us (Right Column) -->
        <div class="col-md-6 mb-4">
            <h2>Find us</h2>

            <!-- Map Placeholder -->
            <div class="bg-light border d-flex align-items-center justify-content-center mb-3 w-100" style="height: 250px;">
                <span class="text-muted border bg-white p-2">Google Map Area</span>
            </div>

            <!-- Address Box -->
            <div class="card mb-3 p-3 shadow-sm">
                <strong class="mb-1">Easy gym Leiria</strong>
                <span class="eg-todo">[Address - Street - Zip Code - Location]</span>
            </div>

            <!-- Operating Hours Box -->
            <div class="card p-3 shadow-sm">
                <strong class="mb-2">Operating Hours</strong>
                <ul class="list-unstyled mb-0 text-muted">
                    <li>Mon to Fri - [07:00 to 22:00]</li>
                    <li>Saturday - [09:00 to 18:00]</li>
                    <li>Sundays - [09:00 to 13:00]</li>
                    <li>Holidays - [09:00 to 13:00]</li>
                </ul>
            </div>
        </div>
    </div>
</div>