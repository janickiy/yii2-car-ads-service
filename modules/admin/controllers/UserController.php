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
        $behaviors['verbs'] = ['class' => VerbFilter::class, 'actions' => ['delete' => ['POST']]];
        return $behaviors;
    }

    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => UserRecord::find()->orderBy(['id' => SORT_DESC]),
            'pagination' => ['pageSize' => 20],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView(int $id): string
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    public function actionCreate(): string|Response
    {
        $model = new UserRecord();
        if ($model->load(Yii::$app->request->post())) {
            $plain = (string)$model->password_hash;
            $model->setPassword($plain);
            $model->auth_key = bin2hex(random_bytes(16));
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Пользователь создан.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate(int $id): string|Response
    {
        $model = $this->findModel($id);
        $currentHash = (string)$model->password_hash;
        if ($model->load(Yii::$app->request->post())) {
            $submitted = (string)$model->password_hash;
            if ($submitted !== '' && $submitted !== $currentHash && strlen($submitted) < 60) {
                $model->setPassword($submitted);
            } else {
                $model->password_hash = $currentHash;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Пользователь обновлён.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('form', ['model' => $model]);
    }

    public function actionDelete(int $id): Response
    {
        $model = $this->findModel($id);
        if ($model->username === 'admin') {
            Yii::$app->session->setFlash('error', 'Нельзя удалить пользователя admin.');
            return $this->redirect(['index']);
        }
        $model->delete();
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
