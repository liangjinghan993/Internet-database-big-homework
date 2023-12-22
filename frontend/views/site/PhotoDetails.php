<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文
 * 照片详情展示模块
 */

/* @var $this \yii\web\View */
/* @var $model photo */

use yii\helpers\Html;
use common\models\Photo;

$this->title = '照片背后的故事';
?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.php">Home</a></li>
                <li>Introduction</li>
            </ol>
            <h2>照片背后的故事</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">

                            <div class="swiper-slide">
                                <img src="<?="../../common/static/images/photo/" . $model->path?>" alt="">
                            </div>

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3>详细信息</h3>
                        <ul>
                            <li><strong>简介: </strong>
                                <?=$model->getDetails()?>
                            </li>
                            <li><strong>时间: </strong>
                                <?=$model->getGTime()?>
                            </li>
                        </ul>
                    </div>
                    <div class="portfolio-description">
                        <h2>
                            <?=$model->getTitle()?>
                        </h2>
                        <p>
                            <?=$model->getIntroduction()?>
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->
