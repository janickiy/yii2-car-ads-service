<?php

declare(strict_types=1);

namespace app\modules\admin\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    public $layout = 'main';

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionLogin(): string
    {
        return $this->render('login');
    }
}