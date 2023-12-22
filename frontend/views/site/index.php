<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文、乔天溢、尚然、梁婧涵
 * 前端主页
 */

use common\models\Qa;

/* @var $this yii\web\View */

use common\models\News;
use common\models\Photo;
use common\models\views;
use common\models\Price;
use common\models\User;
use yii\helpers\Html;

$this->title = '抵制核污水';
?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">日本核废水排放纪实</h1>
                <h2 data-aos="fade-up" data-aos-delay="400">Releasing Radioactive Water Into the Ocean</h2>
                <div data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center text-lg-start">

                        <a href="#news" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                            <span>查看详情</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="../web/statics/assets/img/footer-bg.png"></img>
            </div>
        </div>
    </div>

</section><!-- End Hero -->

<main id="main">

    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="news" class="recent-blog-posts">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>最新新闻消息</p>
            </header>

            <div class="row">
                <?php $latest_news = News::find()->orderBy('news_date DESC')->limit(3)->all(); ?>
                <?php foreach($latest_news as $news):?>
                    <div class="col-lg-4">
                        <div class="post-box">
                            <div class="post-img"><img src="<?="../../common/static/images/news/" . $news->news_photo?>" class="img-fluid" alt=""></div>
                            <span class="post-date"><?=$news->news_date?></span>
                            <h3 class="post-title"><?=$news->news_title?></h3>
                            <h3><?= Html::a('<span>Read More</span><i class="bi bi-arrow-right"></i>', ['site/show-news-content','news_id' => $news->news_id]) ?></h3>
                        </div>
                    </div>
                <?php endforeach;?>

            </div>

            <br><br>

            <header class="section-header">
                <h1><?= Html::a('<span>All News</span><i class="bi bi-arrow-right"></i>', ['site/show-news-list']) ?></h1>
            </header>


        </div>

    </section><!-- End Recent Blog Posts Section -->


    <!-- ======= Portfolio Section ======= -->
    <section id="photo" class="portfolio">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>核污水排放相关照片</p>
            </header>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">全部</li>
                        <li data-filter=".filter-equipment">海洋</li>
                        <li data-filter=".filter-civilian">人民</li>
                        <li data-filter=".filter-battlefield">生物</li>
                    </ul>
                </div>
            </div>

            <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

                <div class="col-lg-4 col-md-6 portfolio-item filter-equipment">
                    <div class="portfolio-wrap">
                        <?php
                        $t_id = 1;
                        $t_picture = Photo::findIdentity($t_id);
                        $t_path = $t_picture -> getPath();
                        $n_path = "../../common/static/images/photo/".$t_path;
                        echo "<img src=$n_path class='img-fluid' alt=''>"
                        ?>
                        <div class="portfolio-info">
                            <h4>
                                <?php
                                $t_id = 1;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_name = $t_picture -> getName();
                                echo $t_name
                                ?>
                            </h4>
                            <p>
                                <?php
                                $t_id = 1;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_detail = $t_picture -> getDetails();
                                echo $t_detail
                                ?>
                            </p>
                            <div class="portfolio-links">
                                <li>
                                    <?php
                                    $t_id = 1;
                                    $t_picture = Photo::findIdentity($t_id);
                                    $t_path = $t_picture -> getPath();
                                    $t_name = $t_picture -> getName();
                                    $n_path = "../../common/static/images/photo/".$t_path;
                                    echo "<a href=$n_path data-photo='portfolioPhoto' class='portfokio-lightbox' title=$t_name><i class='bi bi-plus'></i></a>"
                                    ?>
                                </li>
                                <li><?= Html::a('Learn More', ['site/show-photo-details','photo_id' => 1]) ?></li>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-equipment">
                    <div class="portfolio-wrap">
                        <?php
                        $t_id = 2;
                        $t_picture = Photo::findIdentity($t_id);
                        $t_path = $t_picture -> getPath();
                        $n_path = "../../common/static/images/photo/".$t_path;
                        echo "<img src=$n_path class='img-fluid' alt=''>"
                        ?>
                        <div class="portfolio-info">
                            <h4>
                                <?php
                                $t_id = 2;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_name = $t_picture -> getName();
                                echo $t_name
                                ?>
                            </h4>
                            <p>
                                <?php
                                $t_id = 2;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_detail = $t_picture -> getDetails();
                                echo $t_detail
                                ?>
                            </p>
                            <div class="portfolio-links">
                                <li>
                                    <?php
                                    $t_id = 2;
                                    $t_picture = Photo::findIdentity($t_id);
                                    $t_path = $t_picture -> getPath();
                                    $t_name = $t_picture -> getName();
                                    $n_path = "../../common/static/images/photo/".$t_path;
                                    echo "<a href=$n_path data-photo='portfolioPhoto' class='portfokio-lightbox' title=$t_name><i class='bi bi-plus'></i></a>"
                                    ?>
                                </li>
                                <li><?= Html::a('Learn More', ['site/show-photo-details','photo_id' => 2]) ?></li>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-equipment">
                    <div class="portfolio-wrap">
                        <?php
                        $t_id = 3;
                        $t_picture = Photo::findIdentity($t_id);
                        $t_path = $t_picture -> getPath();
                        $n_path = "../../common/static/images/photo/".$t_path;
                        echo "<img src=$n_path class='img-fluid' alt=''>"
                        ?>
                        <div class="portfolio-info">
                            <h4>
                                <?php
                                $t_id = 3;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_name = $t_picture -> getName();
                                echo $t_name
                                ?>
                            </h4>
                            <p>
                                <?php
                                $t_id = 3;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_detail = $t_picture -> getDetails();
                                echo $t_detail
                                ?>
                            </p>
                            <div class="portfolio-links">
                                <li>
                                    <?php
                                    $t_id = 3;
                                    $t_picture = Photo::findIdentity($t_id);
                                    $t_path = $t_picture -> getPath();
                                    $t_name = $t_picture -> getName();
                                    $n_path = "../../common/static/images/photo/".$t_path;
                                    echo "<a href=$n_path data-photo='portfolioPhoto' class='portfokio-lightbox' title=$t_name><i class='bi bi-plus'></i></a>"
                                    ?>
                                </li>
                                <li><?= Html::a('Learn More', ['site/show-photo-details','photo_id' => 3]) ?></li>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-civilian">
                    <div class="portfolio-wrap">
                        <?php
                        $t_id = 4;
                        $t_picture = Photo::findIdentity($t_id);
                        $t_path = $t_picture -> getPath();
                        $n_path = "../../common/static/images/photo/".$t_path;
                        echo "<img src=$n_path class='img-fluid' alt=''>"
                        ?>
                        <div class="portfolio-info">
                            <h4>
                                <?php
                                $t_id = 4;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_name = $t_picture -> getName();
                                echo $t_name
                                ?>
                            </h4>
                            <p>
                                <?php
                                $t_id = 4;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_detail = $t_picture -> getDetails();
                                echo $t_detail
                                ?>
                            </p>
                            <div class="portfolio-links">
                                <li>
                                    <?php
                                    $t_id = 4;
                                    $t_picture = Photo::findIdentity($t_id);
                                    $t_path = $t_picture -> getPath();
                                    $t_name = $t_picture -> getName();
                                    $n_path = "../../common/static/images/photo/".$t_path;
                                    echo "<a href=$n_path data-photo='portfolioPhoto' class='portfokio-lightbox' title=$t_name><i class='bi bi-plus'></i></a>"
                                    ?>
                                </li>
                                <li><?= Html::a('Learn More', ['site/show-photo-details','photo_id' => 4]) ?></li>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-civilian">
                    <div class="portfolio-wrap">
                        <?php
                        $t_id = 5;
                        $t_picture = Photo::findIdentity($t_id);
                        $t_path = $t_picture -> getPath();
                        $n_path = "../../common/static/images/photo/".$t_path;
                        echo "<img src=$n_path class='img-fluid' alt=''>"
                        ?>
                        <div class="portfolio-info">
                            <h4>
                                <?php
                                $t_id = 5;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_name = $t_picture -> getName();
                                echo $t_name
                                ?>
                            </h4>
                            <p>
                                <?php
                                $t_id = 5;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_detail = $t_picture -> getDetails();
                                echo $t_detail
                                ?>
                            </p>
                            <div class="portfolio-links">
                                <li>
                                    <?php
                                    $t_id = 5;
                                    $t_picture = Photo::findIdentity($t_id);
                                    $t_path = $t_picture -> getPath();
                                    $t_name = $t_picture -> getName();
                                    $n_path = "../../common/static/images/photo/".$t_path;
                                    echo "<a href=$n_path data-photo='portfolioPhoto' class='portfokio-lightbox' title=$t_name><i class='bi bi-plus'></i></a>"
                                    ?>
                                </li>
                                <li><?= Html::a('Learn More', ['site/show-photo-details','photo_id' => 5]) ?></li>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-civilian">
                    <div class="portfolio-wrap">
                        <?php
                        $t_id = 6;
                        $t_picture = Photo::findIdentity($t_id);
                        $t_path = $t_picture -> getPath();
                        $n_path = "../../common/static/images/photo/".$t_path;
                        echo "<img src=$n_path class='img-fluid' alt=''>"
                        ?>
                        <div class="portfolio-info">
                            <h4>
                                <?php
                                $t_id = 6;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_name = $t_picture -> getName();
                                echo $t_name
                                ?>
                            </h4>
                            <p>
                                <?php
                                $t_id = 6;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_detail = $t_picture -> getDetails();
                                echo $t_detail
                                ?>
                            </p>
                            <div class="portfolio-links">
                                <li>
                                    <?php
                                    $t_id = 6;
                                    $t_picture = Photo::findIdentity($t_id);
                                    $t_path = $t_picture -> getPath();
                                    $t_name = $t_picture -> getName();
                                    $n_path = "../../common/static/images/photo/".$t_path;
                                    echo "<a href=$n_path data-photo='portfolioPhoto' class='portfokio-lightbox' title=$t_name><i class='bi bi-plus'></i></a>"
                                    ?>
                                </li>
                                <li><?= Html::a('Learn More', ['site/show-photo-details','photo_id' => 6]) ?></li>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-battlefield">
                    <div class="portfolio-wrap">
                        <?php
                        $t_id = 7;
                        $t_picture = Photo::findIdentity($t_id);
                        $t_path = $t_picture -> getPath();
                        $n_path = "../../common/static/images/photo/".$t_path;
                        echo "<img src=$n_path class='img-fluid' alt=''>"
                        ?>
                        <div class="portfolio-info">
                            <h4>
                                <?php
                                $t_id = 7;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_name = $t_picture -> getName();
                                echo $t_name
                                ?>
                            </h4>
                            <p>
                                <?php
                                $t_id = 7;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_detail = $t_picture -> getDetails();
                                echo $t_detail
                                ?>
                            </p>
                            <div class="portfolio-links">
                                <li>
                                    <?php
                                    $t_id = 7;
                                    $t_picture = Photo::findIdentity($t_id);
                                    $t_path = $t_picture -> getPath();
                                    $t_name = $t_picture -> getName();
                                    $n_path = "../../common/static/images/photo/".$t_path;
                                    echo "<a href=$n_path data-photo='portfolioPhoto' class='portfokio-lightbox' title=$t_name><i class='bi bi-plus'></i></a>"
                                    ?>
                                </li>
                                <li><?= Html::a('Learn More', ['site/show-photo-details','photo_id' => 7]) ?></li>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-battlefield">
                    <div class="portfolio-wrap">
                        <?php
                        $t_id = 8;
                        $t_picture = Photo::findIdentity($t_id);
                        $t_path = $t_picture -> getPath();
                        $n_path = "../../common/static/images/photo/".$t_path;
                        echo "<img src=$n_path class='img-fluid' alt=''>"
                        ?>
                        <div class="portfolio-info">
                            <h4>
                                <?php
                                $t_id = 8;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_name = $t_picture -> getName();
                                echo $t_name
                                ?>
                            </h4>
                            <p>
                                <?php
                                $t_id = 8;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_detail = $t_picture -> getDetails();
                                echo $t_detail
                                ?>
                            </p>
                            <div class="portfolio-links">
                                <li>
                                    <?php
                                    $t_id = 8;
                                    $t_picture = Photo::findIdentity($t_id);
                                    $t_path = $t_picture -> getPath();
                                    $t_name = $t_picture -> getName();
                                    $n_path = "../../common/static/images/photo/".$t_path;
                                    echo "<a href=$n_path data-photo='portfolioPhoto' class='portfokio-lightbox' title=$t_name><i class='bi bi-plus'></i></a>"
                                    ?>
                                </li>
                                <li><?= Html::a('Learn More', ['site/show-photo-details','photo_id' => 8]) ?></li>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-battlefield">
                    <div class="portfolio-wrap">
                        <?php
                        $t_id = 9;
                        $t_picture = Photo::findIdentity($t_id);
                        $t_path = $t_picture -> getPath();
                        $n_path = "../../common/static/images/photo/".$t_path;
                        echo "<img src=$n_path class='img-fluid' alt=''>"
                        ?>
                        <div class="portfolio-info">
                            <h4>
                                <?php
                                $t_id = 9;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_name = $t_picture -> getName();
                                echo $t_name
                                ?>
                            </h4>
                            <p>
                                <?php
                                $t_id = 9;
                                $t_picture = Photo::findIdentity($t_id);
                                $t_detail = $t_picture -> getDetails();
                                echo $t_detail
                                ?>
                            </p>
                            <div class="portfolio-links">
                                <li>
                                    <?php
                                    $t_id = 9;
                                    $t_picture = Photo::findIdentity($t_id);
                                    $t_path = $t_picture -> getPath();
                                    $t_name = $t_picture -> getName();
                                    $n_path = "../../common/static/images/photo/".$t_path;
                                    echo "<a href=$n_path data-photo='portfolioPhoto' class='portfokio-lightbox' title=$t_name><i class='bi bi-plus'></i></a>"
                                    ?>
                                </li>
                                <li><?= Html::a('Learn More', ['site/show-photo-details','photo_id' => 9]) ?></li>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- End Portfolio Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="comments" class="testimonials">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>国际视野</p>
            </header>

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <?php
                                $t_id = 1;
                                $t_views = views::findIdentity($t_id);
                                $t_content = $t_views -> getContent();
                                echo $t_content
                                ?>
                            </p>
                            <div class="profile mt-auto">
                                <?php
                                $t_id = 1;
                                $t_views = views::findIdentity($t_id);
                                $t_path = $t_views -> getImg();
                                echo "<img src=$t_path class='testimonial-img' alt=''>"
                                ?>
                                <h3>
                                    <?php
                                    $t_id = 1;
                                    $t_views = views::findIdentity($t_id);
                                    $t_name = $t_views -> getAuthorName();
                                    echo $t_name
                                    ?>
                                </h3>
                                <h4>
                                    <?php
                                    $t_id = 1;
                                    $t_views = views::findIdentity($t_id);
                                    $t_identity = $t_views -> getIdentity();
                                    echo $t_identity;
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <?php
                                $t_id = 2;
                                $t_views = views::findIdentity($t_id);
                                $t_content = $t_views -> getContent();
                                echo $t_content
                                ?>
                            </p>
                            <div class="profile mt-auto">
                                <?php
                                $t_id = 2;
                                $t_views = views::findIdentity($t_id);
                                $t_path = $t_views -> getImg();
                                echo "<img src=$t_path class='testimonial-img' alt=''>"
                                ?>
                                <h3>
                                    <?php
                                    $t_id = 2;
                                    $t_views = views::findIdentity($t_id);
                                    $t_name = $t_views -> getAuthorName();
                                    echo $t_name
                                    ?>
                                </h3>
                                <h4>
                                    <?php
                                    $t_id = 2;
                                    $t_views = views::findIdentity($t_id);
                                    $t_identity = $t_views -> getIdentity();
                                    echo $t_identity;
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <?php
                                $t_id = 3;
                                $t_views = views::findIdentity($t_id);
                                $t_content = $t_views -> getContent();
                                echo $t_content
                                ?>
                            </p>
                            <div class="profile mt-auto">
                                <?php
                                $t_id = 3;
                                $t_views = views::findIdentity($t_id);
                                $t_path = $t_views -> getImg();
                                echo "<img src=$t_path class='testimonial-img' alt=''>"
                                ?>
                                <h3>
                                    <?php
                                    $t_id = 3;
                                    $t_views = views::findIdentity($t_id);
                                    $t_name = $t_views -> getAuthorName();
                                    echo $t_name
                                    ?>
                                </h3>
                                <h4>
                                    <?php
                                    $t_id = 3;
                                    $t_views = views::findIdentity($t_id);
                                    $t_identity = $t_views -> getIdentity();
                                    echo $t_identity;
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <?php
                                $t_id = 4;
                                $t_views = views::findIdentity($t_id);
                                $t_content = $t_views -> getContent();
                                echo $t_content
                                ?>
                            </p>
                            <div class="profile mt-auto">
                                <?php
                                $t_id = 4;
                                $t_views = views::findIdentity($t_id);
                                $t_path = $t_views -> getImg();
                                echo "<img src=$t_path class='testimonial-img' alt=''>"
                                ?>
                                <h3>
                                    <?php
                                    $t_id = 4;
                                    $t_views = views::findIdentity($t_id);
                                    $t_name = $t_views -> getAuthorName();
                                    echo $t_name
                                    ?>
                                </h3>
                                <h4>
                                    <?php
                                    $t_id = 4;
                                    $t_views = views::findIdentity($t_id);
                                    $t_identity = $t_views -> getIdentity();
                                    echo $t_identity;
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <?php
                                $t_id = 5;
                                $t_views = views::findIdentity($t_id);
                                $t_content = $t_views -> getContent();
                                echo $t_content
                                ?>
                            </p>
                            <div class="profile mt-auto">
                                <?php
                                $t_id = 5;
                                $t_views = views::findIdentity($t_id);
                                $t_path = $t_views -> getImg();
                                echo "<img src=$t_path class='testimonial-img' alt=''>"
                                ?>
                                <h3>
                                    <?php
                                    $t_id = 5;
                                    $t_views = views::findIdentity($t_id);
                                    $t_name = $t_views -> getAuthorName();
                                    echo $t_name
                                    ?>
                                </h3>
                                <h4>
                                    <?php
                                    $t_id = 5;
                                    $t_views = views::findIdentity($t_id);
                                    $t_identity = $t_views -> getIdentity();
                                    echo $t_identity;
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- End Testimonials Section -->

    
    <!-- ======= 价格部分 ======= -->
    <section id="pricing" class="pricing">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>核污水排放引起的物价变化</p>
            </header>

            <div class="row gy-4" data-aos="fade-left">
                
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="box">
              <span class="featured">
                  <?php
                  $t_id = 1;
                  $t_item = Price::findIdentity($t_id);
                  $t_class = $t_item -> getClass();
                  echo $t_class
                  ?>
              </span>
                        <h3 style="color: #07d5c0;">
                            <?php
                            $t_id = 1;
                            $t_item = Price::findIdentity($t_id);
                            $t_name = $t_item -> getItemName();
                            echo $t_name
                            ?>
                        </h3>
                        <div class="price">
                            <sup>
                                <?php
                                $t_id = 1;
                                $t_item = Price::findIdentity($t_id);
                                $t_currency = $t_item -> getCurrency();
                                echo $t_currency
                                ?>
                            </sup>
                            <?php
                            $t_id = 1;
                            $t_item = Price::findIdentity($t_id);
                            $t_price = $t_item -> getPrice();
                            echo $t_price
                            ?>
                            <span>
                                <?php
                      $t_id = 1;
                      $t_item = Price::findIdentity($t_id);
                      $t_measurement = $t_item -> getMeasurement();
                      $t_measure = "/ ".$t_measurement;
                      echo $t_measure
                      ?>
                  </span>
                </div>
                        <?php
                        $t_id = 1;
                        $t_item = Price::findIdentity($t_id);
                        $t_path = $t_item -> getImg();
                        $n_path = "../../common/static/images/price/".$t_path;
                        echo "<img src=$n_path class='img-fluid' alt=''>"
                        ?>
                        <h3>
                            <ul></ul>
                            <li><?= Html::a('More Details', ['site/show-price-details','price_id' => 1]) ?></li>
                        </h3>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="box">
                        <span class="featured">
                            <?php
                  $t_id = 2;
                  $t_item = Price::findIdentity($t_id);
                  $t_class = $t_item -> getClass();
                  echo $t_class
                  ?>
              </span>
              <h3 style="color: #65c600;">
                            <?php
                            $t_id = 2;
                            $t_item = Price::findIdentity($t_id);
                            $t_name = $t_item -> getItemName();
                            echo $t_name
                            ?>
                        </h3>
                        <div class="price">
                            <sup>
                                <?php
                                $t_id = 2;
                                $t_item = Price::findIdentity($t_id);
                                $t_currency = $t_item -> getCurrency();
                                echo $t_currency
                                ?>
                            </sup>
                            <?php
                            $t_id = 2;
                            $t_item = Price::findIdentity($t_id);
                            $t_price = $t_item -> getPrice();
                            echo $t_price
                            ?>
                            <span>
                                <?php
                      $t_id = 2;
                      $t_item = Price::findIdentity($t_id);
                      $t_measurement = $t_item -> getMeasurement();
                      $t_measure = "/ ".$t_measurement;
                      echo $t_measure
                      ?>
                  </span>
                        </div>
                        <?php
                        $t_id = 2;
                        $t_item = Price::findIdentity($t_id);
                        $t_path = $t_item -> getImg();
                        $n_path = "../../common/static/images/price/".$t_path;
                        echo "<img src=$n_path class='img-fluid' alt=''>"
                        ?>
                        <h3>
                            <ul></ul>
                            <li><?= Html::a('More Details', ['site/show-price-details','price_id' => 2]) ?></li>
                        </h3>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="box">
              <span class="featured">
                  <?php
                  $t_id = 3;
                  $t_item = Price::findIdentity($t_id);
                  $t_class = $t_item -> getClass();
                  echo $t_class
                  ?>
              </span>
                        <h3 style="color: #ff901c;">
                            <?php
                            $t_id = 3;
                            $t_item = Price::findIdentity($t_id);
                            $t_name = $t_item -> getItemName();
                            echo $t_name
                            ?>
                        </h3>
                        <div class="price">
                            <sup>
                                <?php
                                $t_id = 3;
                                $t_item = Price::findIdentity($t_id);
                                $t_currency = $t_item -> getCurrency();
                                echo $t_currency
                                ?>
                            </sup>
                            <?php
                            $t_id = 3;
                            $t_item = Price::findIdentity($t_id);
                            $t_price = $t_item -> getPrice();
                            echo $t_price
                            ?>
                            <span>
                                <?php
                      $t_id = 3;
                      $t_item = Price::findIdentity($t_id);
                      $t_measurement = $t_item -> getMeasurement();
                      $t_measure = "/ ".$t_measurement;
                      echo $t_measure
                      ?>
                  </span>
                </div>
                        <?php
                        $t_id = 3;
                        $t_item = Price::findIdentity($t_id);
                        $t_path = $t_item -> getImg();
                        $n_path = "../../common/static/images/price/".$t_path;
                        echo "<img src=$n_path class='img-fluid' alt=''>"
                        ?>
                        <h3>
                            <ul></ul>
                        <li><?= Html::a('More Details', ['site/show-price-details','price_id' => 3]) ?></li>
                    </h3>
                </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="box">
                        <span class="featured">
                  <?php
                  $t_id = 4;
                  $t_item = Price::findIdentity($t_id);
                  $t_class = $t_item -> getClass();
                  echo $t_class
                  ?>
              </span>
              <h3 style="color: #ff0071;">
                            <?php
                            $t_id = 4;
                            $t_item = Price::findIdentity($t_id);
                            $t_name = $t_item -> getItemName();
                            echo $t_name
                            ?>
                        </h3>
                        <div class="price">
                            <sup>
                                <?php
                                $t_id = 4;
                                $t_item = Price::findIdentity($t_id);
                                $t_currency = $t_item -> getCurrency();
                                echo $t_currency
                                ?>
                            </sup>
                            <?php
                            $t_id = 4;
                            $t_item = Price::findIdentity($t_id);
                            $t_price = $t_item -> getPrice();
                            echo $t_price
                            ?>
                            <span>
                                <?php
                      $t_id = 4;
                      $t_item = Price::findIdentity($t_id);
                      $t_measurement = $t_item -> getMeasurement();
                      $t_measure = "/ ".$t_measurement;
                      echo $t_measure
                      ?>
                  </span>
                        </div>
                        <?php
                        $t_id = 4;
                        $t_item = Price::findIdentity($t_id);
                        $t_path = $t_item -> getImg();
                        $n_path = "../../common/static/images/price/".$t_path;
                        echo "<img src=$n_path class='img-fluid' alt=''>"
                        ?>
                        <h3>
                            <ul></ul>
                            <li><?= Html::a('More Details', ['site/show-price-details','price_id' => 4]) ?></li>
                        </h3>
                    </div>
                </div>
                
            </div>

        </div>
        
    </section><!-- End Pricing Section -->

    <!-- ======= 视频播放部分 ======= -->
    <section id="values" class="values">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <header class="section-header">
            <p>值得反复观看的视频</p>
        </header>
        <div class="row">
            <div class="col-lg-4 mt-4 mt-lg-0 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                <div class="box"> 
                    <h3>太平洋不是日本下水道</h3>
                    <video src="../web/statics/assets/img/video0.mp4" class="video-fluid" controls style="object-fit: contain; width: 100%; height: 100%;"></video>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0 aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                <div class="box"> 
                    <h3>核污水该不该排放？</h3>
                    <video src="../web/statics/assets/img/video1.mp4" class="video-fluid" controls style="object-fit: contain; width: 100%; height: 100%;"></video>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0 aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                <div class="box"> 
                    <h3>核污水若无害日本何不自己留着？</h3>
                    <video src="../web/statics/assets/img/video2.mp4" class="video-fluid" controls style="object-fit: contain; width: 100%; height: 100%;"></video>
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- ======= Q_&_A Section ======= -->
    <section id="qa" class="qa">
        
        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>核污水知识科普问答</p>
            </header>

            <div class="row">
                <div class="col-lg-6">
                    <!-- Q_&_A List 1-->
                    <div class="accordion accordion-flush" id="qalist1">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#qa-content-1">
                                    <?php
                                    $qa = Qa::find()->where(['priority' => 1])->one();
                                    echo ($qa->question);
                                    ?>
                                </button>
                            </h2>
                            <div id="qa-content-1" class="accordion-collapse collapse" data-bs-parent="#qalist1">
                                <div class="accordion-body">
                                    <h4><?php
                                    $qa = Qa::find()->where(['priority' => 1])->one();
                                    echo ($qa->answer);
                                    ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#qa-content-2">
                                    <?php
                                    $qa = Qa::find()->where(['priority' => 2])->one();
                                    echo ($qa->question);
                                    ?>
                                </button>
                            </h2>
                            <div id="qa-content-2" class="accordion-collapse collapse" data-bs-parent="#qalist1">
                                <div class="accordion-body">
                                <h4><?php
                                    $qa = Qa::find()->where(['priority' => 2])->one();
                                    echo ($qa->answer);
                                    ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#qa-content-3">
                                    <?php
                                    $qa = Qa::find()->where(['priority' => 3])->one();
                                    echo ($qa->question);
                                    ?>
                                </button>
                            </h2>
                            <div id="qa-content-3" class="accordion-collapse collapse" data-bs-parent="#qalist1">
                                <div class="accordion-body">
                                <h4><?php
                                    $qa = Qa::find()->where(['priority' => 3])->one();
                                    echo ($qa->answer);
                                    ?></h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">

                    <!-- Q_&_A List 2-->
                    <div class="accordion accordion-flush" id="qalist2">

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#qa2-content-1">
                                    <?php
                                    $qa = Qa::find()->where(['priority' => 4])->one();
                                    echo ($qa->question);
                                    ?>
                                </button>
                            </h2>
                            <div id="qa2-content-1" class="accordion-collapse collapse" data-bs-parent="#qalist2">
                                <div class="accordion-body">
                                <h4><?php
                                    $qa = Qa::find()->where(['priority' => 4])->one();
                                    echo ($qa->answer);
                                    ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#qa2-content-2">
                                    <?php
                                    $qa = Qa::find()->where(['priority' => 5])->one();
                                    echo ($qa->question);
                                    ?>
                                </button>
                            </h2>
                            <div id="qa2-content-2" class="accordion-collapse collapse" data-bs-parent="#qalist2">
                                <div class="accordion-body">
                                <h4><?php
                                    $qa = Qa::find()->where(['priority' => 5])->one();
                                    echo ($qa->answer);
                                    ?></h4>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#qa2-content-3">
                                    <?php
                                    $qa = Qa::find()->where(['priority' => 6])->one();
                                    echo ($qa->question);
                                    ?>
                                </button>
                            </h2>
                            <div id="qa2-content-3" class="accordion-collapse collapse" data-bs-parent="#qalist2">
                                <div class="accordion-body">
                                <h4><?php
                                    $qa = Qa::find()->where(['priority' => 6])->one();
                                    echo ($qa->answer);
                                    ?></h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </section><!-- End Q_&_A Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
            <p>开发团队</p>
            </header>

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <a href="https://gitee.com/liang-jinghan888/internet-database2023" target="_blank">
                        <div class="member">
                            <div class="member-img">
                                <img src="../../common/static/images/team/lyw.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <h4>刘雅文</h4>
                                <span>组长 · 2113400</span>
                                <p>负责团队的分工协调和进度把控，完成照片展示、物价变化、国际物价情况数据库设计，后端照片展示管理，前端主页模板融合、照片展示、主页设计等</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                            <div class="member-img">
                                <img src="../../common/static/images/team/ljh.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <h4>梁婧涵</h4>
                                <span>组员 · 2112155</span>
                                <p>负责完成开发团队、用户评价、数据库移植等数据库设计，后端模板查找、用户管理、新闻评论管理等。</p>
                            </div>
                        </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                    <div class="member">
                        <div class="member-img">
                            <img src="../../common/static/images/team/qty.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>乔天溢</h4>
                            <span>组员 · 2112142</span>
                            <p>负责完成新闻来源的爬虫、后台访问人次、修改记录数据库设计，后端用户数据、新闻管理，前端新闻页</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                    <div class="member">
                        <div class="member-img">
                            <img src="../../common/static/images/team/sr.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>尚然</h4>
                            <span>组员 · 2111617</span>
                            <p>负责完成国家看法、知识科普等数据库设计，后端模板融合应用、知识科普管理、团队作业管理，前端国家看法、知识科普等</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- End Team Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>网站数据统计</p>
            </header>

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="bi bi-layout-text-sidebar-reverse" style="color: #ee6c20;"></i>
                        <?php $news_num = News::find()->count();?>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="<?=$news_num?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p>新闻数量</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="bi bi-graph-up" style="color: #15be56;"></i>
                        <?php $views_num = News::find()->sum('news_views')?>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="<?=$views_num?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p>浏览统计</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="bi bi-people" style="color: #bb0852;"></i>
                        <?php $users_num = User::find()->count();?>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="<?=$users_num?>" data-purecounter-duration="1" class="purecounter"></span>
                            <p>活跃用户</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Counts Section -->

</main><!-- End #main -->

<script language=javascript>
    function siteTime() {
        window.setTimeout("siteTime()", 1000);
        var seconds = 1000;
        var minutes = seconds * 60;
        var hours = minutes * 60;
        var today = new Date();
        var todayYear = today.getFullYear();
        var todayMonth = today.getMonth() + 1;
        var todayDate = today.getDate();
        var todayHour = today.getHours();
        var todayMinute = today.getMinutes();
        var todaySecond = today.getSeconds();
        var t1 = Date.UTC(2023, 2, 1, 0, 0, 0);
        var t2 = Date.UTC(todayYear, todayMonth, todayDate, todayHour, todayMinute, todaySecond);
        var diff = t2 - t1;
        var diffHours = Math.floor((diff) / hours);
        var diffMinutes = Math.floor((diff - diffHours * hours) / minutes);
        var diffSeconds = Math.floor((diff - diffHours * hours - diffMinutes * minutes) / seconds);
        document.getElementById("sitetime").innerHTML = diffHours + " h " + diffMinutes + " m " + diffSeconds + " s ";
    }
    siteTime();
</script>
