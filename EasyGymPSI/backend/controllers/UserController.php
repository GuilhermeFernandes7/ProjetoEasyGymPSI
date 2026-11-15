<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\models\UserForm;
use backend\models\UserSearch;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Gestao de utilizadores (so para quem tem a permissao gerirSistema, ou seja, o admin).
 */
class UserController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    ['allow' => true, 'roles' => ['gerirSistema']],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => ['delete' => ['post'], 'deactivate' => ['post'], 'activate' => ['post']],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate(): string|Response
    {
        $model = new UserForm();
        $model->status = User::STATUS_ACTIVE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'User created.');

            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate(int $id): string|Response
    {
        $model = UserForm::fromUser($this->findUser($id));

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'User updated.');

            return $this->redirect(['index']);
        }

        return $this->render('update', ['model' => $model]);
    }

    /**
     * Soft delete: so muda o status para 0, nunca apaga a linha.
     */
    public function actionDeactivate(int $id): Response
    {
        return $this->changeStatus($id, 'deactivate', 'User deactivated.');
    }

    public function actionActivate(int $id): Response
    {
        return $this->changeStatus($id, 'activate', 'User activated.');
    }

    /**
     * Soft delete: so muda o status para 0, nunca apaga a linha.
     */
    public function actionDelete(int $id): Response
    {
        return $this->changeStatus($id, 'softDelete', 'User deleted.');
    }

    private function changeStatus(int $id, string $method, string $message): Response
    {
        $user = $this->findUser($id);

        if ((int) $user->id === (int) Yii::$app->user->id) {
            Yii::$app->session->setFlash('error', 'You cannot change your own account status.');
        } else {
            $user->$method();
            Yii::$app->session->setFlash('success', $message);
        }

        return $this->redirect(['index']);
    }

    protected function findUser(int $id): User
    {
        $user = User::findOne($id);

        if ($user === null || $user->status === User::STATUS_DELETED) {
            throw new NotFoundHttpException('User not found.');
        }

        return $user;
    }
}