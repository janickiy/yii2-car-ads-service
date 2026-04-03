<?php

declare(strict_types=1);

namespace app\modules\admin\controllers;

use app\infrastructure\Persistence\ActiveRecord\UserRecord;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SiteController extends Controller
{
    public $layout = 'main';

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/admin/site/index']);
        }

        if (Yii::$app->request->isPost) {
            $username = (string) Yii::$app->request->post('username');
            $password = (string) Yii::$app->request->post('password');
            $user = UserRecord::findByUsername($username);

            if ($user !== null && $user->validatePassword($password)) {
                Yii::$app->user->login($user, 3600 * 8);
                Yii::$app->session->setFlash('success', 'Вы успешно вошли в админку.');
                return $this->redirect(['/admin/site/index']);
            }

            Yii::$app->session->setFlash('error', 'Неверный логин или пароль.');
        }

        return $this->render('login');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('success', 'Вы вышли из админки.');
        return $this->redirect(['/admin/site/login']);
    }
}
