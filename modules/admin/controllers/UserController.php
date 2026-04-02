<?php

declare(strict_types=1);

namespace app\modules\admin\controllers;

use app\infrastructure\Persistence\ActiveRecord\UserRecord;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class UserController extends BaseAdminController
{
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => UserRecord::find()->orderBy(['id' => SORT_DESC]),
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('index', compact('dataProvider'));
    }

    public function actionCreate()
    {
        $model = new UserRecord();
        if ($model->load(\Yii::$app->request->post())) {
            $model->setPassword((string)$model->password_hash);
            $model->auth_key = bin2hex(random_bytes(16));
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('form', compact('model'));
    }

    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        if ($model->load(\Yii::$app->request->post())) {
            if (!empty($model->password_hash) && strlen($model->password_hash) < 60) {
                $model->setPassword((string)$model->password_hash);
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('form', compact('model'));
    }

    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    private function findModel(int $id): UserRecord
    {
        $model = UserRecord::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('User not found.');
        }
        return $model;
    }
}
