<?php

declare(strict_types=1);

namespace app\controllers;

use app\application\Service\Swagger\OpenApiSpecificationBuilder;
use yii\web\Controller;
use yii\web\Response;

class SwaggerController extends Controller
{
    public $layout = false;

    public function __construct($id, $module, private readonly OpenApiSpecificationBuilder $builder, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionOpenapi(): array
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        return $this->builder->build();
    }
}
