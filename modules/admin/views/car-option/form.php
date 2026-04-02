<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1><?= $model->isNewRecord ? 'Создать характеристики' : 'Редактировать характеристики' ?></h1>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'car_id') ?>
<?= $form->field($model, 'brand') ?>
<?= $form->field($model, 'model') ?>
<?= $form->field($model, 'year') ?>
<?= $form->field($model, 'body') ?>
<?= $form->field($model, 'mileage') ?>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
