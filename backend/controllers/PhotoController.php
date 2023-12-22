<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 核污水相关照片CRUD接口
 */

namespace backend\controllers;

use backend\models\RecordUtil;
use Yii;
use common\models\Photo;
use common\models\PhotoSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PhotoController extends Controller
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
     * Lists all photo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'backend_layout';
        $searchModel = new PhotoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single photo model.
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
     * Creates a new photo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'backend_layout';
        $model = new Photo();

        if (Yii::$app->request->post('is_create')) {
            $model->type = Yii::$app->request->post('type');
            $model->details = Yii::$app->request->post('details');
            $model->introduction = Yii::$app->request->post('introduction');
            $model->title = Yii::$app->request->post('title');
            $model->time = Yii::$app->request->post('time');
            $model->path = 'tmp';
            $model->save();
            $model = Photo::find()->orderBy('id DESC')->limit(1)->one();
            $suffix = (explode('.', $_FILES['file']['name']))[1];
            $filename = 'photo-' . $model->id . '.' . $suffix;
            $temp_name = $_FILES['file']['tmp_name'];
            if (move_uploaded_file($temp_name, '../../common/static/images/photo/'.$filename)){
                $model->path = $filename;
            }
            $model->save();

            RecordUtil::generateRecord('photo', 'create');

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
            $model->type = Yii::$app->request->post('type');
            $model->details = Yii::$app->request->post('details');
            $model->introduction = Yii::$app->request->post('introduction');
            $model->title = Yii::$app->request->post('title');
            $model->time = Yii::$app->request->post('time');
            if($_FILES['file']['name'] !== "") {
                $suffix = (explode('.', $_FILES['file']['name']))[1];
                $filename = explode('.', $model->path)[0] . '.' . $suffix;
                $temp_name = $_FILES['file']['tmp_name'];
                if (move_uploaded_file($temp_name, '../../common/static/images/photo/'.$filename)){
                    $model->path = $filename;
                }
            }
            $model->save();

            RecordUtil::generateRecord('photo', 'update');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->layout = 'backend_layout';
        $this->findModel($id)->delete();
        RecordUtil::generateRecord('photo', 'delete');

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return photo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Photo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
