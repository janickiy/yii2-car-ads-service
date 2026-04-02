<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Вход в админку';
?>

<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h3 text-center mb-4">Вход в админку</h1>

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'username')->textInput(['placeholder' => 'Введите логин']) ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Введите пароль']) ?>

                <div class="d-grid">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
