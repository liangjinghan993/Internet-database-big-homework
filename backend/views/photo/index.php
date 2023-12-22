<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 照片管理index
 */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\photo */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Photo', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type:ntext',
            'details:ntext',
            'introduction:ntext',
            'title:ntext',
            'time:ntext',
            'path',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
