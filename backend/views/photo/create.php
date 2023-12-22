<?php
/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 创建照片
 */

use yii\helpers\Html;


$this->title = 'Create Photo';
$this->params['breadcrumbs'][] = ['label' => 'Photo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
    'to' => 'create'
]) ?>
