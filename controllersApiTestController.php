<?php

namespace app;

class controllersApiTestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPruebas()
    {
        return $this->render('pruebas');
    }

    public function actionTokengen()
    {
        return $this->render('tokengen');
    }

}
