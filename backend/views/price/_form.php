<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 物价编辑页面
 */

use yii\helpers\Html;
use common\models\Price;

?>


<section class="section">

    <div class="card">
        <div class="card-body">
            <!-- General Form Elements -->
            <?php if($to === 'create'): ?>
                <h5 class="card-title"><b>新建物价</b></h5>
                <?= Html::beginForm('@web/index.php?r=price/create','post',['enctype' => 'multipart/form-data']) ?>
                <input type="hidden" name="is_create" value="true" />
            <?php else: ?>
                <h5 class="card-title"><b>更新物价</b></h5>
                <?= Html::beginForm('@web/index.php?r=price/update' . '&id=' . $model->id,'post',['enctype' => 'multipart/form-data']) ?>
                <input type="hidden" name="is_update" value="true" />
            <?php endif;?>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="inputText" class="col-form-label">物品名称</label>
                    <input type="text" class="form-control" name="item_name" value="<?=$model->item_name?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="inputPassword" class="col-form-label">物品标题</label>
                    <textarea class="form-control" style="height: 100px" name="title"><?=$model->title?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="inputPassword" class="col-form-label">价格分析</label>
                    <textarea class="form-control" style="height: 250px" name="introduction"><?=$model->introduction?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="inputText" class="col-form-label">计量单位</label>
                    <input type="text" class="form-control" name="measurement" value="<?=$model->measurement?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="inputText" class="col-form-label">货币(1:美元,2:人民币,3:欧元,4:日元,5:格里夫纳,6:卢布)</label>
                    <input type="text" class="form-control" name="currency" value="<?=$model->currency?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="inputText" class="col-form-label">物品类别</label>
                    <input type="text" class="form-control" name="t_class" value="<?=$model->t_class?>">
                </div>
                <div class="col-md-4">
                    <label for="inputText" class="col-form-label">物品价格</label>
                    <input type="text" class="form-control" name="price" value="<?=$model->price?>">
                </div>
                <div class="col-md-4">
                    <label for="inputNumber" class="col-form-label">配图上传</label>
                    <input type="file" id="formFile" name="file" value="<?=$model->img_path?>">
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
