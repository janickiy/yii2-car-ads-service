<?php

use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title ?: 'Админка') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body class="bg-light">
<?php $this->beginBody() ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/admin">Админка</a>
        <div class="navbar-nav">
            <a class="nav-link" href="/admin/car/index">Объявления</a>
            <a class="nav-link" href="/admin/car-option/index">Характеристики</a>
            <a class="nav-link" href="/admin/user/index">Пользователи</a>
            <?php if (!Yii::$app->user->isGuest): ?>
                <?= Html::a('Выйти', ['/admin/site/logout'], ['class' => 'nav-link', 'data-method' => 'post']) ?>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">
    <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
        <div class="alert alert-<?= $type === 'error' ? 'danger' : 'success' ?>"><?= Html::encode($message) ?></div>
    <?php endforeach; ?>
    <?= $content ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
