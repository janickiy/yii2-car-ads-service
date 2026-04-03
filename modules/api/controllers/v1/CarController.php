<?php

declare(strict_types=1);

namespace app\modules\api\controllers\v1;

use app\application\DTO\CreateCarRequest;
use app\application\Exception\DomainValidationException;
use app\application\Service\CreateCarService;
use app\application\Service\GetCarByIdService;
use app\application\Service\ListCarsService;
use Yii;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CarController extends Controller
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;

        return $behaviors;
    }

    public function actionCreate(): array
    {
        try {
            $body = Yii::$app->request->bodyParams;
            $dto = CreateCarRequest::fromArray(is_array($body) ? $body : []);
            $car = Yii::$container->get(CreateCarService::class)->handle($dto);

            Yii::$app->response->statusCode = 201;
            return $car->toArray();
        } catch (DomainValidationException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    public function actionView(int $id): array
    {
        $car = Yii::$container->get(GetCarByIdService::class)->handle($id);
        if ($car === null) {
            throw new NotFoundHttpException('Объявление не найдено.');
        }

        return $car->toArray();
    }

    public function actionList(int $page = 1): array
    {
        return Yii::$container->get(ListCarsService::class)->handle($page, 10);
    }
}
