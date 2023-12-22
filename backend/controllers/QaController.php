<?php

/**
 * Team: 抵制核污水小队
 * Created by 
 * CRUD接口
 */

namespace backend\controllers;

use backend\models\RecordUtil;
use Yii;
use common\models\Qa;
use common\models\QaSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QaController implements the CRUD actions for Qa model.
 */
class QaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Qa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'backend_layout';
        $searchModel = new QaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Qa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'backend_layout';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Qa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'backend_layout';
        $model = new Qa();

        if (Yii::$app->request->post('is_create')) {
            $model->question = Yii::$app->request->post('question');
            $model->answer = Yii::$app->request->post('answer');
            $model->status = Yii::$app->request->post('status');
            $model->priority = Yii::$app->request->post('priority');
            $model->save();

            RecordUtil::generateRecord('qa', 'create');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Qa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'backend_layout';
        $model = $this->findModel($id);

        if (Yii::$app->request->post('is_update')) {
            $model->question = Yii::$app->request->post('question');
            $model->answer = Yii::$app->request->post('answer');
            $model->status = Yii::$app->request->post('status');
            $model->priority = Yii::$app->request->post('priority');
            $model->save();

            RecordUtil::generateRecord('qa', 'update');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Qa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        RecordUtil::generateRecord('qa', 'delete');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Qa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Qa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Qa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
