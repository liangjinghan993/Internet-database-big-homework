<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 照片更新界面
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\photo */

$this->title = 'Update Photo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Photo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('_form', [
    'model' => $model,
    'to' => 'update'
]) ?>
