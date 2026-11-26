<?php

declare(strict_types=1);

namespace backend\modules\api\controllers;

use common\models\User;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

class BaseController extends ActiveController
{
    public ?User $user = null;

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::class,
            'auth' => [$this, 'authenticate'],
        ];

        return $behaviors;
    }

    public function authenticate(string $username, string $password): ?User
    {
        $user = User::findByUsername($username);

        if ($user !== null && $user->validatePassword($password)) {
            $this->user = $user;

            return $user;
        }

        return null;
    }
}