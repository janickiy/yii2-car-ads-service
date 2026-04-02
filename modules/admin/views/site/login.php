<?php

$this->title = 'Вход в админку';
?>

<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h3 mb-4 text-center">Вход в админку</h1>

                <?php if (Yii::$app->session->hasFlash('error')): ?>
                    <div class="alert alert-danger">
                        <?= Yii::$app->session->getFlash('error') ?>
                    </div>
                <?php endif; ?>

                <form method="post">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>">

                    <div class="mb-3">
                        <label class="form-label">Логин</label>
                        <input type="text" name="username" class="form-control" placeholder="Введите логин">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Пароль</label>
                        <input type="password" name="password" class="form-control" placeholder="Введите пароль">
                    </div>

                    <button class="btn btn-primary w-100">Войти</button>
                </form>
            </div>
        </div>
    </div>
</div>
