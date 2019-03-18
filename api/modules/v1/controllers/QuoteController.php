<?php

namespace api\modules\v1\controllers;

use common\models\Quote;
use common\models\search\QuoteSearch;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

/**
 * Default controller for the `V1` module
 */
class QuoteController extends ActiveController
{
    public $modelClass='common\models\Quote';
    public function actions()
    {
        return [];
    }

    public function actionIndex(){
       return (new QuoteSearch())->search(\Yii::$app->request->bodyParams);
    }

    public function actionCreate(){
        $session = Yii::$app->session;
        $quote = new Quote();
        $quote->setAttributes(\Yii::$app->request->bodyParams);
        if(!$quote->save()){
            foreach ($quote->getErrors() as $error) {
                $session->addFlash('errors',$error);
            }
        }
        if($session->hasFlash('errors')){
            return $session->getFlash('errors');
        } else {
            return $quote;
        }
    }

    public function actionDelete($id){

    }
}
