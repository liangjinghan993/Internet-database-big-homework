<?php
/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 后台照片编辑页面
 */

use yii\helpers\Html;
use common\models\Photo;
?>

<section class="section">
    <div class="card">
        <div class="card-body">
            <!-- General Form Elements -->
            <?php if($to === 'create'): ?>
                <h5 class="card-title"><b>新建照片</b></h5>
                <?= Html::beginForm('@web/index.php?r=photo/create','post',['enctype' => 'multipart/form-data']) ?>
            <?php else: ?>
                <h5 class="card-title"><b>更新照片</b></h5>
                <?= Html::beginForm('@web/index.php?r=photo/update' . '&id=' . $model->id,'post',['enctype' => 'multipart/form-data']) ?>
            <?php endif;?>
            <input type="hidden" name="is_create" value="true" />
            <input type="hidden" name="is_update" value="true" />
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="inputText" class="col-form-label">照片类型</label>
                    <input type="text" class="form-control" name="news_title" value="<?=$model->type?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="inputPassword" class="col-form-label">照片简介</label>
                    <textarea class="form-control" style="height: 100px" name="news_abstract"><?=$model->details?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="inputText" class="col-form-label">详细描述</label>
                    <textarea class="form-control" style="height: 250px" name="news_content"><?=$model->introduction?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="inputText" class="col-form-label">原新闻标题</label>
                    <input type="text" class="form-control" name="news_title" value="<?=$model->title?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="inputText" class="col-form-label">发布时间</label>
                    <input type="text" class="form-control" name="news_date" value="<?=$model->time?>">
                </div>
                <div class="col-md-4">
                    <label for="inputNumber" class="col-form-label">照片上传/更新</label>
                    <input type="file" id="formFile" name="file" value="<?=$model->path?>">
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
