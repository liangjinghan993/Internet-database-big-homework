<?php

/**
 * Team: 抵制核污水小队
 * Created by 乔天溢
 * 后台新闻查询页面
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'news_id') ?>

    <?= $form->field($model, 'news_title') ?>

    <?= $form->field($model, 'news_content') ?>

    <?= $form->field($model, 'news_photo') ?>

    <?= $form->field($model, 'news_date') ?>

    <?php // echo $form->field($model, 'news_source') ?>

    <?php // echo $form->field($model, 'news_abstract') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
