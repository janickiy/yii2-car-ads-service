<?php

use yii\helpers\Html;

$this->title = 'Login';
?>

<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Login</h3>

                <?php if (Yii::$app->session->hasFlash('error')): ?>
                    <div class="alert alert-danger">
                        <?= Html::encode(Yii::$app->session->getFlash('error')) ?>
                    </div>
                <?php endif; ?>

                <form method="post">
                    <input type="hidden" name="<?= Html::encode(Yii::$app->request->csrfParam) ?>" value="<?= Html::encode(Yii::$app->request->getCsrfToken()) ?>">

                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Логин">
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Пароль">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Войти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
