<?php

/**
 * Team: 抵制核污水小队
 * Created by 尚然.
 * 后台用户编辑页面
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\SignupForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $to string */
?>

<section class="section">

    <div class="card">
        <div class="card-body">
            <!-- General Form Elements -->
            <?php if($to === 'create'): ?>
                <h5 class="card-title"><b>新建用户</b></h5>
                <?= Html::beginForm('@web/index.php?r=user/create','post',['enctype' => 'multipart/form-data']) ?>
                <input type="hidden" name="is_create" value="true" />
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="inputText" class="col-form-label">用户名</label>
                        <input type="text" class="form-control" name="username" value="<?=$model->username?>">
                    </div>
                    <div class="col-md-4">
                        <label for="inputText" class="col-form-label">邮箱</label>
                        <input type="email" class="form-control" name="email" value="<?=$model->email?>">
                    </div>
                    
                    <div class="col-md-4">
                        <label for="inputText" class="col-form-label">密码</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="col-md-4">
                        <label for="inputText" class="col-form-label">权限</label>
                        <div class="form-check" style="padding-left: 5em;">
                            <input id="administrator" class="form-check-input" name="purview" type="radio" value="1">
                            <label for="administrator" class="form-check-label">管理员</label>
                        </div>
                        <div class="form-check" style="padding-left: 5em;">
                            <input id="common_user" class="form-check-input" name="purview" type="radio" checked="checked" value="0">
                            <label for="common_user" class="form-check-label">普通用户</label>
                        </div>
                    </div> 
                </div>
                <div class="row mb-3">
                    <div class="col-md-10">
                            <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
                <?= Html::endForm() ?>                               
            <?php else: ?>
                <h5 class="card-title"><b>更新用户</b></h5>
                <?= Html::beginForm('@web/index.php?r=user/update' . '&id=' . $model->id, 'post',['enctype' => 'multipart/form-data']) ?>
                    <input type="hidden" name="is_update" value="true" />
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="inputText" class="col-form-label">用户名</label>
                            <input type="text" class="form-control" name="username" value="<?=$model->username?>">
                        </div>
                        <div class="col-md-4">
                            <label for="inputText" class="col-form-label">邮箱</label>
                            <input type="email" class="form-control" name="email" value="<?=$model->email?>" readonly>
                        </div>                    
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-10">
                                <button type="submit" class="btn btn-primary">更改用户信息</button>
                        </div>
                    </div>  
                <?= Html::endForm() ?>  

                <?= Html::beginForm('@web/index.php?r=user/updatepurview' . '&id=' . $model->id, 'post',['enctype' => 'multipart/form-data']) ?>
                    <input type="hidden" name="is_update" value="true" />
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="inputText" class="col-form-label">权限</label>
                            <div class="form-check" style="padding-left: 5em;">
                                <input id="administrator" class="form-check-input" name="purview" type="radio" value="1">
                                <label for="administrator" class="form-check-label">管理员</label>
                            </div>
                            <div class="form-check" style="padding-left: 5em;">
                                <input id="common_user" class="form-check-input" name="purview" type="radio" checked="checked" value="0">
                                <label for="common_user" class="form-check-label">普通用户</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-primary">更改用户权限</button>
                        </div>
                    </div>
                <?= Html::endForm() ?>    
                
                <?= Html::beginForm('@web/index.php?r=user/updatepassword' . '&id=' . $model->id, 'post',['enctype' => 'multipart/form-data']) ?>
                    <input type="hidden" name="is_update" value="true" />
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="inputText" class="col-form-label">密码</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-primary">重置用户密码</button>
                        </div>
                    </div>
                <?= Html::endForm() ?>
                
            <?php endif;?>
        </div>
    </div>
</section>