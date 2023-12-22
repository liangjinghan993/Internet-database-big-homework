<?php


/**
 * Team:  抵制核污水小队
 * Created by 尚然.
 * 后台登录页面

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a class="logo d-flex align-items-center w-auto">
                            <img src="assets/img/logo.png" alt="">
                            <span class="d-none d-lg-block">No Nuclear Wastewater</span>
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                <p class="text-center small">Enter your username & password to login</p>
                            </div>

                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                                <div class="col-12">
                                    <div class="input-group has-validation">
                                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <?= $form->field($model, 'password')->passwordInput() ?>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100 ', 'name' => 'login-button']) ?>
                                    </div>                                    
                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                    <div class="credits">
                        <!-- All the links in the footer should remain intact. -->
                        <!-- You can delete the links only if you purchased the pro version. -->
                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                        Template from <a href="https://bootstrapmade.com/">BootstrapMade</a>
                    </div>

                </div>
            </div>
        </div>

    </section>

</div>
