<?php

declare(strict_types=1);

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Main frontend asset bundle.
 *
 * Usa o template "Trainer" (uiCookies, Bootstrap 5.3.8), instalado em
 * frontend/web/trainer. O Bootstrap vem do próprio template, por isso o
 * BootstrapAsset do Yii esta desativado em frontend/config/main.php
 * (evita carregar o Bootstrap duas vezes).
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Inconsolata|Rubik:300,400,700,900',
        'trainer/css/vendor/bootstrap.min.css',
        'trainer/css/style.min.css',
        'trainer/css/icomoon.css',
        'trainer/css/template-bs5.css',
        'trainer/css/trainer-modern.css',
        'css/site.css',
        'css/easygym.css',
    ];
    public $js = [
        'trainer/js/vendor/bootstrap.bundle.min.js',
        'trainer/js/custom.js',
    ];
    public $depends = [
        YiiAsset::class,
    ];
}
