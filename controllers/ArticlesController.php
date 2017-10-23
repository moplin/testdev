<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;

class ArticlesController extends ActiveController
{

    public $modelClass = 'app\models\Articles';

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'bearerAuth' => [
                'class' => HttpBearerAuth::className()
            ]
        ]);
    }

    /* public function init()
    {
        parent::init();
        //Yii::info('init()::', var_export($fileName,true));
        Yii::info('init()<<<');
        \Yii::$app->user->enableSession = false;
    } */


    public function actionWaxa()
    {
        $ret = ["waxa"=>"okkk"];
        return $ret;
    }
}
