<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 后台布局模板文件
 */

/* @var $this View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../web/statics/assets/img/favicon.png" rel="icon">
    <link href="../web/statics/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>

<body>
<?php $this->beginBody() ?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="../web/statics/assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">No Nuclear Wastewater</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src=<?= "../../common/static/images/users/default" . (Yii::$app->user->id % 4 + 1) .".png"?> alt="Profile" class="rounded-circle">

                    <?php if (Yii::$app->user->isGuest) { ?>
                        <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
                    <?php } else { ?>
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?= Yii::$app->user->identity->username ?>
                        </span>
                    <?php } ?>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="nav-profile dropdown-header">
                        <img src=<?= "../../common/static/images/users/default" . (Yii::$app->user->id % 4 + 1) .".png"?> alt="Profile" class="rounded-circle">
                        <?php if (! Yii::$app->user->isGuest) { ?>
                            <h6>
                                <?= Yii::$app->user->identity->username ?>
                            </h6>
                        <?php } ?>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <?php if (Yii::$app->user->isGuest) { ?>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    <?php } else { ?>

                        <li class="dropdown-item d-flex align-items-center">
                            <i class="bi bi-box-arrow-right"></i>
                            <?= Html::beginForm(['/site/logout'], 'post') ?>
                            <?= Html::submitButton('Sign Out',
                            ['class' => 'btn',
                            'style'=>'
                            font-size: 14px;
                            font-weight: 400;
                            width:240px
                            height:40px
                            color: #333333;
                            white-space: nowrap;']) ?>
                            <?= Html::endForm() ?>
                        </li>
          
                    <?php } ?>


                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Data</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed"  href="<?= Url::to('index.php?r=user') ?>">
                <i class="bi bi-person"></i><span>Users</span>
            </a>
        </li><!-- End Users Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>News</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= Url::to('index.php?r=news') ?>">
                        <i class="bi bi-circle"></i><span>News Content</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to('index.php?r=news-source') ?>">
                        <i class="bi bi-circle"></i><span>News Source</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to('index.php?r=news-comment') ?>">
                        <i class="bi bi-circle"></i><span>News Comment</span>
                    </a>
                </li>
            </ul>
        </li><!-- End News Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= Url::to('index.php?r=price') ?>">
                <i class="bi bi-gem"></i>
                <span>Price</span>
            </a>
        </li><!-- End Price Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= Url::to('index.php?r=photo') ?>">
                <i class="bi bi-chat-left-quote"></i>
                <span>photo</span>
            </a>
        </li><!-- End Photo Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= Url::to('index.php?r=qa') ?>">
                <i class="bi bi-question-circle"></i>
                <span>Q_&_A</span>
            </a>
        </li><!-- End Q_&_A Page Nav -->

        <li class="nav-heading">Personal</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#assn-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Assignments</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="assn-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= Url::to('index.php?r=site%2Fteam') ?>">
                        <i class="bi bi-circle"></i><span>团队作业</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to('index.php?r=site%2Flyw') ?>">
                        <i class="bi bi-circle"></i><span>刘雅文</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to('index.php?r=site%2Fljh') ?>">
                        <i class="bi bi-circle"></i><span>梁婧涵</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to('index.php?r=site%2Fqty') ?>">
                        <i class="bi bi-circle"></i><span>乔天溢</span>
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to('index.php?r=site%2Fsr') ?>">
                        <i class="bi bi-circle"></i><span>尚然</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Profile Page Nav -->


    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">
    <?= $content ?>
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>抵制核污水小队</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Template from<a href="https://bootstrapmade.com/">BootstrapMade</a>. Powered by <a href="https://www.yiichina.com/">Yii2</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

