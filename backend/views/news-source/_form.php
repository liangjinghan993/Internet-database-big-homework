<?php

/**
 * Team: 抵制核污水小队
 * Created by 乔天溢
 * 新闻来源编辑表单
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NewsSource */
/* @var $form yii\widgets\ActiveForm */
/* @var $to string*/
?>

<section class="section">

    <div class="card">
        <div class="card-body">
            <!-- General Form Elements -->
            <?php if($to === 'create'): ?>
                <h5 class="card-title"><b>新建新闻来源</b></h5>
                <?= Html::beginForm('@web/index.php?r=news-source/create','post',['enctype' => 'multipart/form-data']) ?>
            <?php else: ?>
                <h5 class="card-title"><b>更新新闻来源</b></h5>
                <?= Html::beginForm('@web/index.php?r=news-source/update' . '&id=' . $model->source_name,'post',['enctype' => 'multipart/form-data']) ?>
            <?php endif;?>
            <input type="hidden" name="is_create" value="true" />
            <input type="hidden" name="is_update" value="true" />
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="inputText" class="col-form-label">新闻来源名称</label>
                    <?php if($to === 'create'): ?>
                        <input type="text" class="form-control" name="source_name" value="<?=$model->source_name?>">
                    <?php else: ?>
                        <input type="text" class="form-control" name="source_name" value="<?=$model->source_name?>" readonly>
                    <?php endif;?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="inputText" class="col-form-label">新闻来源简介</label>
                    <textarea class="form-control" style="height: 100px" name="source_introduction"><?=$model->source_introduction?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="inputText" class="col-form-label">新闻来源Twitter</label>
                    <input class="form-control" name="bilibili_url" value="<?=$model->bilibili_url?>">
                </div>
                <div class="col-md-4">
                    <label for="inputText" class="col-form-label">新闻来源FaceBook</label>
                    <input class="form-control" name="weibo_url" value="<?=$model->weibo_url?>">
                </div>
                <div class="col-md-4">
                    <label for="inputText" class="col-form-label">新闻来源Instagram</label>
                    <input class="form-control" name="douyin_url" value="<?=$model->douyin_url?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="inputFile" class="col-form-label">配图上传</label>
                    <input type="file" id="formFile" name="file" value="<?=$model->source_photo?>">
                </div>
            </div>
            <!--                <div class="row mb-3">-->
            <!--                    <label for="inputTime" class="col-sm-2 col-form-label">Time</label>-->
            <!--                    <div class="col-sm-10">-->
            <!--                        <input type="time" class="form-control">-->
            <!--                    </div>-->
            <!--                </div>-->
            <br>
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
