<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1><?= $model->isNewRecord ? 'Create user' : 'Update user' ?></h1>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password_hash')->passwordInput()->label('Password') ?>
<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
