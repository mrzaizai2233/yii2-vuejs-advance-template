<?php

namespace api\modules\v1\controllers;

use common\models\User;
use yii\rest\ActiveController;

/**
 * Default controller for the `V1` module
 */
class DefaultController extends ActiveController
{
    public $modelClass='common\models\User';
}
