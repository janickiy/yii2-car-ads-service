<?php

declare(strict_types=1);

namespace app\modules\admin\controllers;

use app\infrastructure\Persistence\ActiveRecord\UserRecord;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class UserController extends BaseAdminController
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
            'query' => UserRecord::find()->orderBy(['id' => SORT_DESC]),
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
        $model = new UserRecord();
        $model->created_at = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->plain_password !== '') {
                $model->setPassword($model->plain_password);
            }

            if (empty($model->auth_key)) {
                $model->auth_key = Yii::$app->security->generateRandomString();
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Пользователь успешно создан.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('form', [
            'model' => $model,
        ]);
    }

    public function actionUpdate(int $id): string|Response
    {
        $model = $this->findModel($id);
        $model->plain_password = '';

        if ($model->load(Yii::$app->request->post())) {
            if ($model->plain_password !== '') {
                $model->setPassword($model->plain_password);
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Пользователь успешно обновлён.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('form', [
            'model' => $model,
        ]);
    }

    public function actionDelete(int $id): Response
    {
        $user = $this->findModel($id);

        if ((string) $user->username === 'admin') {
            Yii::$app->session->setFlash('error', 'Нельзя удалить администратора admin.');
            return $this->redirect(['index']);
        }

        $user->delete();
        Yii::$app->session->setFlash('success', 'Пользователь удалён.');

        return $this->redirect(['index']);
    }

    private function findModel(int $id): UserRecord
    {
        $model = UserRecord::findOne($id);

        if ($model === null) {
            throw new NotFoundHttpException('Пользователь не найден.');
        }

        return $model;
    }
}
