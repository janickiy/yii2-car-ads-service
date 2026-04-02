<?php

use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админка</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/admin">Админка</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="/admin/car/index">Объявления</a>
                <a class="nav-link" href="/admin/car-option/index">Характеристики</a>
                <a class="nav-link" href="/admin/user/index">Пользователи</a>
            </div>
            <div class="navbar-nav">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <?= Html::a('Выйти', ['/admin/site/logout'], ['class' => 'nav-link']) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
        <div class="alert alert-<?= $type === 'error' ? 'danger' : 'success' ?>">
            <?= Html::encode($message) ?>
        </div>
    <?php endforeach; ?>

    <?= $content ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
