<?php

declare(strict_types=1);

namespace app\controllers;

class SiteController extends \yii\web\Controller
{
    public function actionIndex(): string
    {
        return 'Car Ads Service is running';
    }

    public function actionError(): string
    {
        return 'Application error';
    }
}
