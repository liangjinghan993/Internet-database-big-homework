<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文 梁婧涵 乔天溢 尚然
 * 页面路由 后台登录动作
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\BackendLoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['lyw', 'ljh', 'qty', 'sr', 'team'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'backend_layout';
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        
        
       if (!Yii::$app->user->isGuest) {
           return $this->goHome();
       }

       $model = new BackendLoginForm();
       if ($model->load(Yii::$app->request->post()) && $model->login()) 
       {
           // $this->layout = 'backend_layout';
           return $this->goBack();
           // return $this->render('index');
       } else {
           $model->password = '';

           return $this->render('login', [
               'model' => $model,
           ]);
       }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLyw()
    {
        $this->layout = 'backend_layout';
        return $this->render('/site/lyw');
    }

    public function actionLjh()
    {
        $this->layout = 'backend_layout';
        return $this->render('/site/ljh');
    }

    public function actionQty()
    {
        $this->layout = 'backend_layout';
        return $this->render('/site/qty');
    }

    public function actionSr()
    {
        $this->layout = 'backend_layout';
        return $this->render('/site/sr');
    }

    public function actionTeam()
    {
        $this->layout = 'backend_layout';
        return $this->render('/site/team');
    }
}
