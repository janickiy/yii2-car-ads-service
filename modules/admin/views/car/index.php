<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>
<h1>Объявления</h1>
<p><?= Html::a('Создать объявление', ['create'], ['class' => 'btn btn-success']) ?></p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => ['id', 'title', 'price', 'contacts', 'created_at', ['class' => yii\grid\ActionColumn::class]],
]) ?>
