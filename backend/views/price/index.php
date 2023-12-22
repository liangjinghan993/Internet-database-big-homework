<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 后台物价管理主页
 */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\Price */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Price';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Price', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'item_name:ntext',
            'title:ntext',
            'introduction:ntext',
            'measurement:ntext',
            'currency:ntext',
            't_class:ntext',
            'price:ntext',
            'img_path',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
