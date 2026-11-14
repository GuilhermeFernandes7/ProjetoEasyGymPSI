<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use yii\helpers\Html;

$this->render('_head');

// As paginas "template" (hero a toda a largura) definem
// $this->params['fullWidth'] = true. As restantes (login, signup, ...)
// ficam dentro de uma secao com cabecalho escuro.
$fullWidth = !empty($this->params['fullWidth']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php $this->head() ?>
    <title><?= Html::encode($this->title) ?> | <?= Html::encode(Yii::$app->name) ?></title>
</head>
<body>
<?php $this->beginBody() ?>

<?= $this->render('_header', [
    'solid' => $this->params['solid'] ?? false
]) ?>

<?php if ($fullWidth): ?>
    <main id="main" role="main">
        <?= Alert::widget() ?>
        <?= $content ?>
    </main>
<?php else: ?>
    <main id="main" role="main">
        <section class="probootstrap-section">
            <div class="container">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </section>
    </main>
<?php endif ?>

<?= $this->render('_footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
