<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 后台物价更新页面
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Price */

$this->title = 'Update Price: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Price', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('_form', [
    'model' => $model,
    'to' => 'update'
]) ?>
