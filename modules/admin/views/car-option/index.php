<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>
<h1>Car Options</h1>
<p><?= Html::a('Create car option', ['create'], ['class' => 'btn btn-success']) ?></p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id', 'car_id', 'brand', 'model', 'year', 'body', 'mileage',
        ['class' => yii\grid\ActionColumn::class],
    ],
]) ?>
