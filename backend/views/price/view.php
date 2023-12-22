<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 后台物价预览页面
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Price */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Price', 'url' => ['index']];
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
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'item_name:ntext',
            'title:ntext',
            'introduction:ntext',
            'measurement:ntext',
            'currency:ntext',
            't_class:ntext',
            'price:ntext',
            'img_path',
        ],
    ]) ?>

</div>
