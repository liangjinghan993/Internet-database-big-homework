<?php


/**
 * Team: 抵制核污水小队
 * Created by 尚然.
 * 前台登录注册模块
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model LoginForm | SignupForm*/

use common\models\LoginForm;
use frontend\models\SignupForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="forms-container">
        <div class="signin-signup">  
            <?php
                $this->title = 'Login';
                $this->params['breadcrumbs'][] = $this->title;
            ?>          

            <div class="sign-in-form">
                <div class="site-login">
                    <div class="row">
                        <div class="col-lg-5">
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                                <h2 class="title">登录</h2>
                                <div class="input-field">
                                    <i class="fas fa-user"></i>
                                    <?= $form->field($model, 'username')->textInput(['type' => 'text',  'style' => 'font-size:20px;padding-top:1px; height:50px;', 'placeholder' => "用户名"])->label('') ?>
                                </div>
                                <div class="input-field">
                                    <i class="fas fa-lock"></i>
                                    <?= $form->field($model, 'password')->passwordInput(['type' => 'password', 'style' => 'font-size:20px;padding-top:1px; height:50px;', 'placeholder' => "密码"])->label('') ?>
                                </div>

                                <div class="form-group" style="text-align:center">
                                        <?= Html::submitButton('立即登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sign-up-form">
                <div class="site-signup">

                    <?php
                        $this->title = 'Signup';
                        $this->params['breadcrumbs'][] = $this->title;
                    ?>
                    <h2 class="title">注册</h2>
                    <div class="row">
                        <div class="col-lg-5">
                            <?php $model = new SignupForm(); ?>
                            <?php $form = ActiveForm::begin(['id' => 'form-signup','action'=>['site/signup']]); ?>
                                    
                                    <div class="input-field">
                                        <i class="fas fa-user"></i>
                                        
                                        <?= $form->field($model, 'username')->textInput(['type' => 'text',  'style' => 'font-size:20px;padding-top:1px; height:50px;', 'placeholder' => "用户名"])->label('') ?>
                                    </div>
                                    <div class="input-field">
                                        <i class="fas fa-envelope"></i>
                                        
                                        <?= $form->field($model, 'email')->textInput(['type' => 'email',  'style' => 'font-size:20px;padding-top:1px; height:50px;', 'placeholder' => "邮箱"])->label('') ?>
                                    </div>                                
                                    <div class="input-field">
                                        <i class="fas fa-lock"></i>
                                        
                                        <?= $form->field($model, 'password')->passwordInput(['type' => 'password', 'style' => 'font-size:20px;padding-top:1px; height:50px;', 'placeholder' => "密码"])->label('') ?>
                                    </div>

                                    <div class="form-group" style="text-align:center">
                                        <?= Html::submitButton('立即注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                                    </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>

    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>加入我们</h3>
                <p>
                    加入我们，成为本站的一份子。
                </p>
                <button class="btn transparent" id="sign-up-btn">
                    去注册
                </button>
            </div>
            <img src="../web/statics/assets/img/login/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
            <div class="content">
                <h3>已有帐号？</h3>
                <p>
                    立即登录已有帐号，享受独家权益。
                </p>
                <button class="btn transparent" id="sign-in-btn">
                    去登录
                </button>
            </div>
            <img src="../web/statics/assets/img/login/register.svg" class="image" alt="" />
        </div>
    </div>
    
</div>

<script type="text/javascript">
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");

    sign_up_btn.addEventListener("click", () => {
        container.classList.add("sign-up-mode");
        <?php 
        $model = new SignupForm(); 
        ?>
    });

    sign_in_btn.addEventListener("click", () => {
        container.classList.remove("sign-up-mode");
    });
</script>

