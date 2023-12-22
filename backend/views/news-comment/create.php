<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文.
 * 后台新闻评论创建页面
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NewsComment */

$this->title = 'Create News Comment';
$this->params['breadcrumbs'][] = ['label' => 'News Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
    'to' => 'create'
]) ?>
