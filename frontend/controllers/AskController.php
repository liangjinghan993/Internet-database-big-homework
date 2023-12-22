<?php

/**
 * Team: 抵制核污水小队
 * Created by 尚然
 * 问答动作控制
 */

namespace frontend\controllers;
use Yii;
use yii\bootstrap\Alert;
use yii\web\Controller;
use common\models\Qa;
    /**
     * upload questions.
     *
     * @return mixed
     */
class AskController extends Controller
{
    public function actionAsk()
    {
        \yii\helpers\Url::remember();
        $model = new Qa();
        $model->question = Yii::$app->request->post('question');
        $model->save();
        Yii::$app->session->setFlash('success', 'Thank you for your question! We will reply soon.');
        $this->redirect(Yii::$app->request->referrer);
    }
}