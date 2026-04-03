<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1><?= $model->isNewRecord ? 'Создать пользователя' : 'Редактировать пользователя' ?></h1>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'username')->label('Логин') ?>
<?= $form->field($model, 'password_hash')->passwordInput()->label('Пароль') ?>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
