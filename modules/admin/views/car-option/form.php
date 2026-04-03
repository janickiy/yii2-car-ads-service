<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1><?= $model->isNewRecord ? 'Create car option' : 'Update car option' ?></h1>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'car_id') ?>
<?= $form->field($model, 'brand') ?>
<?= $form->field($model, 'model') ?>
<?= $form->field($model, 'year') ?>
<?= $form->field($model, 'body') ?>
<?= $form->field($model, 'mileage') ?>
<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
