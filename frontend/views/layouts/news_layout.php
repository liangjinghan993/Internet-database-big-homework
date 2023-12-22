<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文.
 * 新闻相关布局文件
 */

/* @var $this View */
/* @var $content string */

use yii\helpers\Html;
use yii\web\View;
use frontend\assets\AppAsset;
use common\models\NewsSource;

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
</head>
<body>
<?php $this->beginBody() ?>

<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="index.php" class="logo d-flex align-items-center">
            <img src="<?="../web/statics/assets/img/logo.png"?>" alt="">
            <span>No Nuclear Wastewater</span>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="index.php#hero">Home</a></li>
                <li><a class="nav-link scrollto active" href="index.php#news">News</a></li>
                <li><a class="nav-link scrollto" href="index.php#photo">Photo</a></li>
                <li><a class="nav-link scrollto" href="index.php#comments">Comments</a></li>
                <li><a class="nav-link scrollto" href="index.php#pricing">Price</a></li>
                <li><a class="nav-link scrollto" href="index.php#qa">qa</a></li>
                <li><a class="nav-link scrollto" href="index.php#team">Team</a></li>
                <!-- biandi -->
                <!-- <li><a class="getstarted scrollto" href="#about">Login</a></li> -->
                <?php  if (Yii::$app->user->isGuest) { ?>

                    <?= Html::a('Login', ['site/login'],['class'=>'getstarted scrollto']) ?>

                <?php } else { ?>

                    <li class="nav-link scrollto">
                        <?= Html::beginForm(['/site/logout'], 'post') ?>
                        <?= Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn',
                                'style' =>
                                    'display: flex;
              align-items: center;
              justify-content: space-between;
              font-family: "Nunito", sans-serif;
              font-size: 16px;
              font-weight: 700;
              color: #013289;
              white-space: nowrap;

              background: #4154f1;
              padding: 8px 20px;
              margin-left: 30px;
              border-radius: 4px;
              color: #fff;']) ?>
                        <!-- <?= Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')',['class' => 'btn-logout']) ?> -->
                        <?= Html::endForm() ?>
                    </li>

                <?php }  ?>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><?= Html::a('Home', ['site/index']) ?></li>
                <li><?= Html::a('News', ['site/show-news-list']) ?></li>
            </ol>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <?= $content ?>

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title">Search</h3>
                        <div class="sidebar-item search-form">
                            <?= Html::beginForm() ?>
                            <input type="text" name="search_keywords">
                            <button type="submit"><i class="bi bi-search"></i></button>
                            <?= Html::endForm()?>
                        </div><!-- End sidebar search formn-->

                        <h3 class="sidebar-title">News Source</h3>
                        <div class="sidebar-item categories">
                            <?php
                            $news_sources_num = NewsSource::find()->count();
                            $news_sources = NewsSource::find()->orderBy('source_name ASC')->all();
                            ?>
                            <ul>
                                <?php for($i = 0; $i < $news_sources_num; $i++): ?>
                                    <li>
                                        <?= Html::a($news_sources[$i]->source_name . '(' . $news_sources[$i]->getNewsNum() . ')', ['site/filter-news-source', 'news_source' => $news_sources[$i]->source_name]) ?>
                                    </li>
                                <?php endfor;?>
                            </ul>
                        </div><!-- End sidebar categories-->

                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Single Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <h4>向我们提问</h4>
                    <p>请在下方留言或提问</p>
                </div>
                <div class="col-lg-6">
                    <?= Html::beginForm('@web/index.php?r=ask%2Fask','post') ?>
                    <input type="text" class="form-control" name="question" >
                    <input type="submit" value="提交">
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>抵制核污水小队</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/RUA VS UKR-bootstrap-startup-template/ -->
            Template from <a href="https://bootstrapmade.com/">BootstrapMade</a>. Powered by <a href="https://www.yiichina.com/">Yii2</a>
        </div>
    </div>
</footer><!-- End Footer -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
