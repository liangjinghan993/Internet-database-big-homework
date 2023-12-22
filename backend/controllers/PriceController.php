<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 核污水物价变化CRUD接口
 */

namespace backend\controllers;

use backend\models\RecordUtil;
use Yii;
use common\models\Price;
use common\models\PriceSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NewsController implements the CRUD actions for Price model.
 */
class PriceController extends Controller
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
     * Lists all Price models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'backend_layout';
        $searchModel = new PriceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Price model.
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
     * Creates a new Price model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'backend_layout';
        $model = new Price();

        if (Yii::$app->request->post('is_create')) {
            $model->item_name = Yii::$app->request->post('item_name');
            $model->title = Yii::$app->request->post('title');
            $model->introduction = Yii::$app->request->post('introduction');
            $model->measurement = Yii::$app->request->post('measurement');
            $model->currency = Yii::$app->request->post('currency');
            $model->t_class = Yii::$app->request->post('t_class');
            $model->price = Yii::$app->request->post('price');
            $model->img_path = 'tmp';
            $model->save();
            $model = Price::find()->orderBy('id DESC')->limit(1)->one();
            $suffix = (explode('.', $_FILES['file']['name']))[1];
            $filename = 'price-' . $model->id . '.' . $suffix;
            $temp_name = $_FILES['file']['tmp_name'];
            if (move_uploaded_file($temp_name, '../../common/static/images/price/'.$filename)){
                $model->img_path = $filename;
            }
            $model->save();

            RecordUtil::generateRecord('price', 'create');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Price model.
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
            $model->item_name = Yii::$app->request->post('item_name');
            $model->title = Yii::$app->request->post('title');
            $model->introduction = Yii::$app->request->post('introduction');
            $model->measurement = Yii::$app->request->post('measurement');
            $model->currency = Yii::$app->request->post('currency');
            $model->t_class = Yii::$app->request->post('t_class');
            $model->price = Yii::$app->request->post('price');
            if($_FILES['file']['name'] !== "") {
                $suffix = (explode('.', $_FILES['file']['name']))[1];
                $filename = explode('.', $model->img_path)[0] . '.' . $suffix;
                $temp_name = $_FILES['file']['tmp_name'];
                if (move_uploaded_file($temp_name, '../../common/static/images/price/'.$filename)){
                    $model->img_path = $filename;
                }
            }
            $model->save();

            RecordUtil::generateRecord('price', 'update');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Price model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->layout = 'backend_layout';
        $this->findModel($id)->delete();
        RecordUtil::generateRecord('price', 'delete');

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Price the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Price::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
