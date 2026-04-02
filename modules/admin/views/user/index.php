<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>
<h1>Пользователи</h1>
<p><?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?></p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'username',
        'created_at',
        ['class' => yii\grid\ActionColumn::class],
    ],
]) ?>
