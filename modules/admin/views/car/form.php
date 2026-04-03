<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1><?= $model->isNewRecord ? 'Создать объявление' : 'Редактировать объявление' ?></h1>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'title')->label('Заголовок') ?>
<?= $form->field($model, 'description')->textarea()->label('Описание') ?>
<?= $form->field($model, 'price')->label('Цена') ?>
<?= $form->field($model, 'photo_url')->label('Ссылка на фото') ?>
<?= $form->field($model, 'contacts')->label('Контакты') ?>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
