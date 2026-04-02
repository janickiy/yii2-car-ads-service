<?php

declare(strict_types=1);

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex(): string
    {
        return 'Car Ads Service';
    }

    public function actionError(): string
    {
        $exception = \Yii::$app->errorHandler->exception;

        if ($exception === null) {
            return 'Unknown error';
        }

        return $this->renderContent(sprintf(
            '<h1>%s</h1><p>%s</p>',
            htmlspecialchars((string)$exception->getCode(), ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8')
        ));
    }
}
