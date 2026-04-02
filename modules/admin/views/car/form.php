<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1><?= $model->isNewRecord ? 'Create car' : 'Update car' ?></h1>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'description')->textarea() ?>
<?= $form->field($model, 'price') ?>
<?= $form->field($model, 'photo_url') ?>
<?= $form->field($model, 'contacts') ?>
<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
