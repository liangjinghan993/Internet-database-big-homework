<?php

/**
 * Team: 抵制核污水小队
 * Created by 乔天溢
 * 新闻编辑表单
 */

use yii\helpers\Html;
use common\models\NewsSource;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
/* @var $to string*/
/* @var $news_id integer*/
?>


<section class="section">

    <div class="card">
        <div class="card-body">
            <!-- General Form Elements -->
            <?php if($to === 'create'): ?>
                <h5 class="card-title"><b>新建新闻</b></h5>
                <?= Html::beginForm('@web/index.php?r=news/create','post',['enctype' => 'multipart/form-data']) ?>
            <?php else: ?>
                <h5 class="card-title"><b>更新新闻</b></h5>
                <?= Html::beginForm('@web/index.php?r=news/update' . '&id=' . $model->news_id,'post',['enctype' => 'multipart/form-data']) ?>
            <?php endif;?>
                <input type="hidden" name="is_create" value="true" />
                <input type="hidden" name="is_update" value="true" />
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="inputText" class="col-form-label">新闻标题</label>
                        <input type="text" class="form-control" name="news_title" value="<?=$model->news_title?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="inputPassword" class="col-form-label">新闻摘要</label>
                        <textarea class="form-control" style="height: 100px" name="news_abstract"><?=$model->news_abstract?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="inputPassword" class="col-form-label">新闻内容</label>
                        <textarea class="form-control" style="height: 350px" name="news_content"><?=$model->news_content?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="inputDate" class="col-form-label">新闻日期</label>
                        <input type="date" class="form-control" name="news_date" value="<?=$model->news_date?>">
                    </div>
                    <div class="col-md-4">
                        <label for="inputDate" class="col-form-label">新闻来源</label>
                        <div>
                            <select class="form-select" aria-label="Default select example" name="news_source">
                                <?php
                                    $news_sources_num = NewsSource::find()->count();
                                    $news_sources = NewsSource::find()->orderBy('source_name ASC')->all();
                                ?>
                                <?php for($i = 0; $i < $news_sources_num; $i++): ?>
                                    <?php if($news_sources[$i]->source_name === $model->news_source):?>
                                        <option value="<?= $news_sources[$i]->source_name ?>" selected><?= $news_sources[$i]->source_name ?></option>
                                    <?php else:?>
                                        <option value="<?= $news_sources[$i]->source_name ?>"><?= $news_sources[$i]->source_name ?></option>
                                    <?php endif;?>
                                <?php endfor;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="inputNumber" class="col-form-label">配图上传</label>
                        <input type="file" id="formFile" name="file" value="<?=$model->news_photo?>">
                    </div>
                </div>
<!--                <div class="row mb-3">-->
<!--                    <label for="inputTime" class="col-sm-2 col-form-label">Time</label>-->
<!--                    <div class="col-sm-10">-->
<!--                        <input type="time" class="form-control">-->
<!--                    </div>-->
<!--                </div>-->

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
