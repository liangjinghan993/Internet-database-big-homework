<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 页面跳转
 */

namespace frontend\controllers;

use Cassandra\Date;
use common\models\HistoricalViews;
use common\models\News;
use common\models\NewsComment;
use frontend\models\NewsListUtil;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Photo;
use common\models\Price;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'login_layout';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
        // return $this->render('index');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    /**
     * 展示新闻列表
     *
     * @return mixed
     */
    public function actionShowNewsList()
    {
        $this->layout = 'news_layout';
        if(Yii::$app->request->post('search_keywords')):
            NewsListUtil::init(['search_keywords' => Yii::$app->request->post('search_keywords')]);
        else:
            NewsListUtil::init();
        endif;
        return $this->render('newsList');
    }

    /**
     * 展示新闻内容
     *
     * @return mixed
     */
    public function actionShowNewsContent($news_id)
    {
        $this->layout = 'news_layout';
        $model = News::find()->where(['news_id' => $news_id])->one();
        ++$model->news_views;
        $model->save();
        $current_date = date('Y-m-d');
        $historical_view = HistoricalViews::find()->where(['time' => $current_date])->one();
        if($historical_view === null) {
            $historical_view = new HistoricalViews();
            $historical_view->time = $current_date;
            $historical_view->count = 0;
        }
        ++$historical_view->count;
        $historical_view->save();
        return $this->render('newsContent',[
            'model' => $model
        ]);
    }

    /**
     * 展示指定新闻页
     *
     * @return mixed
     */
    public function actionShowTargetNewsPage($news_page)
    {
        $this->layout = 'news_layout';
        NewsListUtil::init();
        $news_page = (int)$news_page;
        if($news_page * 4 > NewsListUtil::$news_num):{
            --$news_page;
        }
        endif;
        NewsListUtil::$current_news_page = $news_page;
        return $this->render('newsList');
    }

    /**
     * 筛选新闻来源分类
     *
     * @return mixed
     */
    public function actionFilterNewsSource($news_source)
    {
        $this->layout = 'news_layout';
        NewsListUtil::init(['news_source' => $news_source]);
        return $this->render('newsList');
    }

    /**
     * 增加新闻评论
     *
     * @return mixed
     */
    public function actionAddNewsComment()
    {
        $this->layout = 'news_layout';
        $model = new NewsComment();
        $model->comment_news = Yii::$app->request->post('news_id');
        $model->comment_user = Yii::$app->request->post('user_id');
        $model->comment_content = Yii::$app->request->post('comment');
        date_default_timezone_set('PRC');
        $model->comment_time = date('Y-m-d H:i:s');
        if ($model->comment_user == '') {
            return $this->redirect('index.php?r=site%2Flogin');
        }else{
            $model->save();
            return $this->redirect('index.php?r=site%2Fshow-news-content&news_id=' . Yii::$app->request->post('news_id'));
        }
    }

    /**
     * 展示照片
     *
     * @return mixed
     */
    public function actionShowPhotoDetails($photo_id)
    {
        $this->layout = 'photo_layout';
        $model = Photo::findIdentity($photo_id);
        return $this->render('PhotoDetails',[
            'model' => $model
        ]);
    }

    /**
     * 展示价格分析页
     *
     * @return mixed
     */
    public function actionShowPriceDetails($price_id)
    {
        $this->layout = 'price_layout';
        $model = Price::findIdentity($price_id);
        return $this->render('PriceDetails',[
            'model' => $model
        ]);
    }
}
