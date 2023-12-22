<?php
/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 照片查询
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'details') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'introduction') ?>

    <?= $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'news_source') ?>

    <?php // echo $form->field($model, 'news_abstract') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
