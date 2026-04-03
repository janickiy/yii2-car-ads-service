<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1><?= $model->isNewRecord ? 'Создать характеристики' : 'Редактировать характеристики' ?></h1>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'car_id')->label('ID объявления') ?>
<?= $form->field($model, 'brand')->label('Марка') ?>
<?= $form->field($model, 'model')->label('Модель') ?>
<?= $form->field($model, 'year')->label('Год') ?>
<?= $form->field($model, 'body')->label('Кузов') ?>
<?= $form->field($model, 'mileage')->label('Пробег') ?>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
