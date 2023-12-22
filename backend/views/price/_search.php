<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 物价查询页面
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PriceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'item_name') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'introduction') ?>

    <?= $form->field($model, 'measurement') ?>

    <?= $form->field($model, 'currency') ?>

    <?= $form->field($model, 't_class') ?>

    <?= $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'news_source') ?>

    <?php // echo $form->field($model, 'news_abstract') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
