<?php

/**
 * Team: 抵制核污水小队
 * Created by  尚然
 * 后台问答创建页面
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Qa */

$this->title = 'Create Q&A';
$this->params['breadcrumbs'][] = ['label' => 'Q&A', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'to' => 'create'
    ]) ?>

</div>
