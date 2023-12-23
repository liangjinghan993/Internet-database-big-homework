<?php

/**
 * Team: 抵制核污水小队
 * Created by 乔天溢
 * 后台新闻来源搜索页面
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NewsSourceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-source-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'source_name') ?>

    <?= $form->field($model, 'source_introduction') ?>

    <?= $form->field($model, 'bilibili_url') ?>

    <?= $form->field($model, 'weibo_url') ?>

    <?= $form->field($model, 'douyin_url') ?>

    <?php // echo $form->field($model, 'source_photo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
