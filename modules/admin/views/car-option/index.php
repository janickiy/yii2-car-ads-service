<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>
<h1>Характеристики автомобилей</h1>
<p><?= Html::a('Создать характеристики', ['create'], ['class' => 'btn btn-success']) ?></p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => ['id', 'car_id', 'brand', 'model', 'year', 'body', 'mileage', ['class' => yii\grid\ActionColumn::class]],
]) ?>
