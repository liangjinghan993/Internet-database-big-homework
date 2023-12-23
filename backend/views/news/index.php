<?php

/**
 * Team: 抵制核污水小队
 * Created by 乔天溢
 * 后台新闻管理主页
 */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'news_id',
            'news_title:ntext',
            'news_abstract:ntext',
            'news_content:ntext',
            'news_date',
            'news_source',
            'news_views',
            'news_photo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
