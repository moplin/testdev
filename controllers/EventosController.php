<?php

namespace app\controllers;

use Yii;
use app\models\Eventos;
use app\models\EventosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * EventosController implements the CRUD actions for Eventos model.
 */
class EventosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Eventos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $events = array();
//Testing
//        $Event = new \yii2fullcalendar\models\Event();
//        $Event->id = 1;
//        $Event->title = 'Testing';
//        $Event->start = date('Y-m-d\TH:i:s\Z');
//        $events[] = $Event;
//
//        $Event = new \yii2fullcalendar\models\Event();
//        $Event->id = 2;
//        $Event->title = 'Wobba Lobba Dub Dub!!';
//        $Event->start = date('Y-m-d\TH:i:s\Z',strtotime('tomorrow 6am'));
//        $events[] = $Event;


        $ev = Eventos::find()->all();

        foreach ($ev as $key => $value) {

            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $value->id;
            $Event->title = $value->titulo;
            $Event->start = date('Y-m-d\TH:i:s\Z',strtotime('tomorrow 6am'));
            $events[] = $Event;
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'events' => $events,
        ]);
    }

    /**
     * Displays a single Eventos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Eventos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Eventos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Eventos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Eventos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Eventos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Eventos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Eventos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
