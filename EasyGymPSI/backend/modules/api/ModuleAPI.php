<?php

namespace backend\modules\api;

use Yii;

class ModuleAPI extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\api\controllers';

    public function init()
    {
        parent::init();

        Yii::$app->user->enableSession = false;
        Yii::$app->user->loginUrl = null;
        Yii::$app->errorHandler->errorAction = null;
    }
}