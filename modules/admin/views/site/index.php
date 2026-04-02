<?php

use yii\helpers\Html;

$this->title = 'Панель администратора';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-1">Панель администратора</h1>
        <p class="text-muted mb-0">Выберите нужный раздел для управления данными.</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Объявления</h5>
                <p class="card-text">Создание, редактирование и удаление объявлений автомобилей.</p>
                <?= Html::a('Перейти к объявлениям', ['/admin/car/index'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Характеристики</h5>
                <p class="card-text">Управление техническими характеристиками автомобилей.</p>
                <?= Html::a('Перейти к характеристикам', ['/admin/car-option/index'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Пользователи</h5>
                <p class="card-text">Управление пользователями административной панели.</p>
                <?= Html::a('Перейти к пользователям', ['/admin/user/index'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>
