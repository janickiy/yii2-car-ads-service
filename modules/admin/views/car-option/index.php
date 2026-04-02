<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Характеристики автомобилей';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Характеристики автомобилей</h1>
    <?= Html::a('Создать характеристики', ['create'], ['class' => 'btn btn-success']) ?>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'car_id',
        'brand',
        'model',
        'year',
        'body',
        'mileage',
        [
            'class' => ActionColumn::class,
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'view' => static fn ($url) => Html::a('Просмотр', $url, ['class' => 'btn btn-sm btn-outline-secondary me-1']),
                'update' => static fn ($url) => Html::a('Редактировать', $url, ['class' => 'btn btn-sm btn-outline-primary me-1']),
                'delete' => static fn ($url) => Html::a('Удалить', $url, [
                    'class' => 'btn btn-sm btn-outline-danger',
                    'data-method' => 'post',
                    'data-confirm' => 'Удалить запись?',
                ]),
            ],
        ],
    ],
]); ?>
