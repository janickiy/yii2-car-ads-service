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
        <title><?= Html::encode($this->title ?: 'Admin') ?></title>
        <?php $this->head() ?>
    </head>
    <body class="bg-light">

    <?php $this->beginBody() ?>

    <div class="container mt-5">
        <?= $content ?>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>