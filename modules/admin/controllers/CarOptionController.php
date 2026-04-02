<?php

declare(strict_types=1);

namespace app\modules\admin\controllers;

use app\infrastructure\Persistence\ActiveRecord\CarOptionRecord;
use app\infrastructure\Persistence\ActiveRecord\CarRecord;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CarOptionController extends BaseAdminController
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'delete' => ['POST'],
            ],
        ];

        return $behaviors;
    }

    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CarOptionRecord::find()->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate(): string|Response
    {
        $model = new CarOptionRecord();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Характеристики успешно созданы.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('form', [
            'model' => $model,
            'carItems' => ArrayHelper::map(CarRecord::find()->orderBy(['id' => SORT_DESC])->all(), 'id', 'title'),
        ]);
    }

    public function actionUpdate(int $id): string|Response
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Характеристики успешно обновлены.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('form', [
            'model' => $model,
            'carItems' => ArrayHelper::map(CarRecord::find()->orderBy(['id' => SORT_DESC])->all(), 'id', 'title'),
        ]);
    }

    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Характеристики удалены.');

        return $this->redirect(['index']);
    }

    private function findModel(int $id): CarOptionRecord
    {
        $model = CarOptionRecord::findOne($id);

        if ($model === null) {
            throw new NotFoundHttpException('Характеристики не найдены.');
        }

        return $model;
    }
}
