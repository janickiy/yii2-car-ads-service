<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>
<h1>Cars</h1>
<p><?= Html::a('Create car', ['create'], ['class' => 'btn btn-success']) ?></p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'title',
        'price',
        'contacts',
        'created_at',
        ['class' => yii\grid\ActionColumn::class],
    ],
]) ?>
