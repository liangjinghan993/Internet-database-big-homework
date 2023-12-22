<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 照片信息预览
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\photo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Photo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="price-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure to delete ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type:ntext',
            'details:ntext',
            'introduction:ntext',
            'title:ntext',
            'time:ntext',
            'path',
        ],
    ]) ?>

</div>
