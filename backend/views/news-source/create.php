<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文.
 * 后台新闻来源创建页面
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NewsSource */

$this->title = 'Create News Source';
$this->params['breadcrumbs'][] = ['label' => 'News Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
    'to' => 'create'
]) ?>
