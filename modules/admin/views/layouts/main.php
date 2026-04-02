<?php

use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/admin">Admin</a>
        <div class="navbar-nav">
            <a class="nav-link" href="/admin/car/index">Cars</a>
            <a class="nav-link" href="/admin/car-option/index">Car Options</a>
            <a class="nav-link" href="/admin/user/index">Users</a>
            <?php if (!Yii::$app->user->isGuest): ?>
                <?= Html::a('Logout', ['/admin/site/logout'], ['class' => 'nav-link']) ?>
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
</body>
</html>
