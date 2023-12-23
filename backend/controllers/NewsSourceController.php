<?php

/**
 * Team: 抵制核污水小队
 * Created by 乔天溢
 * 新闻来源CRUD接口
 */

namespace backend\controllers;

use Yii;
use common\models\NewsSource;
use common\models\NewsSourceSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NewsSourceController implements the CRUD actions for NewsSource model.
 */
class NewsSourceController extends Controller
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
     * Lists all NewsSource models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'backend_layout';
        $searchModel = new NewsSourceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NewsSource model.
     * @param string $id
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
     * Creates a new NewsSource model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'backend_layout';
        $model = new NewsSource();

        if (Yii::$app->request->post('is_create')) {
            $model->source_name = Yii::$app->request->post('source_name');
            $model->source_introduction = Yii::$app->request->post('source_introduction');
            $model->bilibili_url = Yii::$app->request->post('bilibili_url');
            $model->weibo_url = Yii::$app->request->post('weibo_url');
            $model->douyin_url = Yii::$app->request->post('douyin_url');
            $suffix = (explode('.', $_FILES['file']['name']))[1];
            $filename = $model->source_name . '.' . $suffix;
            $temp_name = $_FILES['file']['tmp_name'];
            if (move_uploaded_file($temp_name, '../../common/static/images/news_source/'.$filename)){
                $model->source_photo = $filename;
            }
            var_dump($model);
            $model->save();

            RecordUtil::generateRecord('news_source', 'create');

            return $this->redirect(['view', 'id' => $model->source_name]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NewsSource model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'backend_layout';
        $model = $this->findModel($id);

        if (Yii::$app->request->post('is_update')) {
            $model->source_name = Yii::$app->request->post('source_name');
            $model->source_introduction = Yii::$app->request->post('source_introduction');
            $model->bilibili_url = Yii::$app->request->post('bilibili_url');
            $model->weibo_url = Yii::$app->request->post('weibo_url');
            $model->douyin_url = Yii::$app->request->post('douyin_url');
            if($_FILES['file']['name'] !== "") {
                $suffix = (explode('.', $_FILES['file']['name']))[1];
                $filename = explode('.', $model->source_name)[0] . '.' . $suffix;
                $temp_name = $_FILES['file']['tmp_name'];
                if (move_uploaded_file($temp_name, '../../common/static/images/news/'.$filename)){
                    $model->source_photo = $filename;
                }
            }
            $model->save();

            RecordUtil::generateRecord('news_source', 'update');

            return $this->redirect(['view', 'id' => $model->source_name]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NewsSource model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->layout = 'backend_layout';
        $this->findModel($id)->delete();

        RecordUtil::generateRecord('news_source', 'delete');

        return $this->redirect(['index']);
    }

    /**
     * Finds the NewsSource model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return NewsSource the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NewsSource::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
