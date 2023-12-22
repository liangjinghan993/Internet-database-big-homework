<?php

/**
 * Team: 抵制核污水小队
 * Created by  
 * 后台问答管理主页
 */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\QaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Q&A';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Q&A', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'question',
            'answer',
            'status',
            'priority',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
