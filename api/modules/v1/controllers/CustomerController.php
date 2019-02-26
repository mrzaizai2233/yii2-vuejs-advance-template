<?php

namespace api\modules\v1\controllers;

use yii;
use common\models\User;
use yii\rest\ActiveController;

/**
 * Default controller for the `V1` module
 */
class CustomerController extends ActiveController
{
    public $modelClass='common\models\Customer';

    public function actionTao(){
        $data =  Yii::$app->getRequest()->getBodyParams();
        $model = new $this->modelClass();
        $model->load($data);
        return $model;
    }
}
