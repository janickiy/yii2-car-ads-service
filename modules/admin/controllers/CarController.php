<?php

declare(strict_types=1);

namespace app\modules\admin\controllers;

use app\infrastructure\Persistence\ActiveRecord\CarRecord;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class CarController extends BaseAdminController
{
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CarRecord::find()->orderBy(['id' => SORT_DESC]),
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('index', compact('dataProvider'));
    }

    public function actionCreate()
    {
        $model = new CarRecord();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('form', compact('model'));
    }

    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('form', compact('model'));
    }

    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    private function findModel(int $id): CarRecord
    {
        $model = CarRecord::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('Car not found.');
        }
        return $model;
    }
}
