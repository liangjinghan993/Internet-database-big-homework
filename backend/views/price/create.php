<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 后台物价创建页面
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Price */

$this->title = 'Create Price';
$this->params['breadcrumbs'][] = ['label' => 'Price', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
    'to' => 'create'
]) ?>
