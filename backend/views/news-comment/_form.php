<?php

/**
 * Team: 抵制核污水小队
 * Created by 梁婧涵
 * 新闻评论编辑表单
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NewsComment */
/* @var $form yii\widgets\ActiveForm */
/* @var $to string */
?>

<section class="section">

    <div class="card">
        <div class="card-body">
            <!-- General Form Elements -->
            <?php if($to === 'create'): ?>
                <h5 class="card-title"><b>新建新闻评论</b></h5>
                <?= Html::beginForm('@web/index.php?r=news-comment/create','post',['enctype' => 'multipart/form-data']) ?>
            <?php else: ?>
                <h5 class="card-title"><b>更新新闻评论</b></h5>
                <?= Html::beginForm('@web/index.php?r=news-comment/update' . '&id=' . $model->comment_id,'post',['enctype' => 'multipart/form-data']) ?>
            <?php endif;?>
            <input type="hidden" name="is_create" value="true" />
            <input type="hidden" name="is_update" value="true" />
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="inputText" class="col-form-label">所属新闻ID</label>
                    <?php if($to === 'create'): ?>
                        <input type="text" class="form-control" name="comment_news" value="<?=$model->comment_news?>">
                    <?php else: ?>
                        <input type="text" class="form-control" name="comment_news" value="<?=$model->comment_news?>" readonly>
                    <?php endif;?>
                </div>
                <div class="col-md-4">
                    <label for="inputText" class="col-form-label">来源用户ID</label>
                    <?php if($to === 'create'): ?>
                        <input type="text" class="form-control" name="comment_user" value="<?=$model->comment_user?>">
                    <?php else: ?>
                        <input type="text" class="form-control" name="comment_user" value="<?=$model->comment_user?>" readonly>
                    <?php endif;?>
                </div>
                <div class="col-md-4">
                    <label for="inputText" class="col-form-label">评论时间</label>
                    <?php if($to === 'create'): ?>
                        <input type="text" class="form-control" name="comment_time" value="<?=$model->comment_time?>">
                    <?php else: ?>
                        <input type="text" class="form-control" name="comment_time" value="<?=$model->comment_time?>" readonly>
                    <?php endif;?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="inputText" class="col-form-label">评论内容</label>
                    <textarea class="form-control" style="height: 100px" name="comment_content"><?=$model->comment_content?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-10">
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </div>

            <?= Html::endForm() ?>
            </form>
        </div>
    </div>
</section>
