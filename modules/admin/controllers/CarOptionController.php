<?php

declare(strict_types=1);

namespace app\modules\admin\controllers;

use app\infrastructure\Persistence\ActiveRecord\CarOptionRecord;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class CarOptionController extends BaseAdminController
{
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CarOptionRecord::find()->orderBy(['id' => SORT_DESC]),
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('index', compact('dataProvider'));
    }

    public function actionCreate()
    {
        $model = new CarOptionRecord();
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

    private function findModel(int $id): CarOptionRecord
    {
        $model = CarOptionRecord::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('Car option not found.');
        }
        return $model;
    }
}
