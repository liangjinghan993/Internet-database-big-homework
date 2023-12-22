<?php

/**
 * Team: 抵制核污水小队
 * Created by  
 * 问答编辑表单
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Qa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="section">
    <div class="card">
        <div class="card-body">
            <!-- General Form Elements -->
            <?php if($to === 'create'): ?>
                <h5 class="card-title"><b>创建新提问</b></h5>
                <?= Html::beginForm('@web/index.php?r=qa/create','post',['enctype' => 'multipart/form-data']) ?>
            <?php else: ?>
                <h5 class="card-title"><b>回答/编辑提问</b></h5>
                <?= Html::beginForm('@web/index.php?r=qa/update' . '&id=' . $model->id,'post',['enctype' => 'multipart/form-data']) ?>
            <?php endif;?>

        <input type="hidden" name="is_create" value="true" />
        <input type="hidden" name="is_update" value="true" />
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="inputText" class="col-form-label">问题</label>
                <input type="text" class="form-control" name="question" value="<?=$model->question?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <label for="inputText" class="col-form-label">回答</label>
                <textarea class="form-control" style="height: 100px" name="answer"><?=$model->answer?></textarea>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="inputDate" class="col-form-label">状态</label>
                <select class="form-select" aria-label="Default select example" name="status">
                    <?php if($model->status === 9):?>
                        <option value="<?= 9 ?>" selected>待回答</option>
                        <option value="<?= 10 ?>">已回答</option>
                    <?php else:?>
                        <option value="<?= 9 ?>">待回答</option>
                        <option value="<?= 10 ?>" selected>已回答</option>
                    <?php endif;?>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <label for="inputText" class="col-form-label">优先级（前6名将显示在qa中）</label>
                <input type="text" class="form-control" name="priority" value="<?=$model->priority?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-10">
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>

        <?= Html::endForm() ?>
        </div>
    </div>
</section>