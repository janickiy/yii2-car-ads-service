<div class="row justify-content-center">
    <div class="col-md-4">
        <h1 class="mb-4">Вход в админку</h1>
        <form method="post">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
            <div class="mb-3">
                <label class="form-label">Логин</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button class="btn btn-primary">Войти</button>
        </form>
    </div>
</div>
