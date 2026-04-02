<?php

use yii\helpers\Html;
use yii\bootstrap5\BootstrapAsset;
use yii\bootstrap5\BootstrapPluginAsset;

BootstrapAsset::register($this);
BootstrapPluginAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title ?: 'Админка') ?></title>
    <?php $this->head() ?>
</head>
<body class="bg-light">
<?php $this->beginBody() ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <?= Html::a('Админка', ['/admin/site/index'], ['class' => 'navbar-brand']) ?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <?php if (!Yii::$app->user->isGuest): ?>
                <div class="navbar-nav me-auto">
                    <?= Html::a('Объявления', ['/admin/car/index'], ['class' => 'nav-link']) ?>
                    <?= Html::a('Характеристики', ['/admin/car-option/index'], ['class' => 'nav-link']) ?>
                    <?= Html::a('Пользователи', ['/admin/user/index'], ['class' => 'nav-link']) ?>
                </div>

                <div class="navbar-nav ms-auto">
                    <?= Html::a('Выйти', ['/admin/site/logout'], [
                        'class' => 'nav-link',
                        'data-method' => 'post',
                    ]) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">
    <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
        <div class="alert alert-<?= $type === 'error' ? 'danger' : ($type === 'warning' ? 'warning' : 'success') ?>">
            <?= Html::encode($message) ?>
        </div>
    <?php endforeach; ?>

    <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
