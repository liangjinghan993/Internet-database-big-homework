<?php

/**
 * Team: 抵制核污水小队
 * Created by  
 * 后台问答更新页面
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Qa */

$this->title = 'Update Q&A: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Q&A', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'to' => 'update'
    ]) ?>

</div>
