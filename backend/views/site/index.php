<?php

/**
 * Team: 抵制核污水小队
 * Created by  
 * 后台管理主页面
 */

/* @var $this yii\web\View */

use common\models\HistoricalViews;
use common\models\News;
use common\models\User;

$this->title = '抵制核污水';
?>

<div class="pagetitle">
    <h1>Dashboard</h1>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
            <div class="row">

                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Number of News</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-layout-text-sidebar-reverse"></i>
                                </div>
                                <div class="ps-3">
                                    <?php $news_num = News::find()->count();?>
                                    <h6><?=$news_num?></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Number of Views</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <div class="ps-3">
                                    <?php $views_num = News::find()->sum('news_views')?>
                                    <h6><?=$views_num?></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-4 col-xl-12">

                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Number of Users</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <?php $users_num = User::find()->count();?>
                                    <h6><?=$users_num?></h6>
                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- End Customers Card -->

                <!-- History Views -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">History Views</h5>

                            <!-- Line Chart -->
                            <div id="reportsChart"></div>
                            <script>
                                let historical_views = [];
                                let historical_times = [];
                                <?php
                                    $historical_view = HistoricalViews::find()->orderBy('time ASC')->limit(10)->all();
                                    foreach ($historical_view as $item) {
                                        echo "historical_views.push(".$item->count.");";
                                        echo "historical_times.push('".$item->time."');";
                                    }
                                ?>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#reportsChart"), {
                                        series: [{
                                            name: 'Historical Views',
                                            data: historical_views,
                                        }],
                                        chart: {
                                            height: 350,
                                            type: 'area',
                                            toolbar: {
                                                show: false
                                            },
                                        },
                                        markers: {
                                            size: 4
                                        },
                                        colors: ['#4154f1'],
                                        fill: {
                                            type: "gradient",
                                            gradient: {
                                                shadeIntensity: 1,
                                                opacityFrom: 0.3,
                                                opacityTo: 0.4,
                                                stops: [0, 90, 100]
                                            }
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        stroke: {
                                            curve: 'smooth',
                                            width: 2
                                        },
                                        xaxis: {
                                            type: 'date',
                                            categories: historical_times
                                        },
                                        tooltip: {
                                            x: {
                                                format: 'dd/MM/yy'
                                            },
                                        }
                                    }).render();
                                });
                            </script>
                            <!-- End Line Chart -->
                        </div>
                    </div>
                </div><!-- End History Views -->

                <!-- Top Views-->
                <div class="col-12">
                    <!-- Budget Report -->
                    <div class="card">

                        <div class="card-body pb-0">
                            <h5 class="card-title">Visiting Statistics</h5>
                            <canvas id="barChart" style="max-height: 400px;"></canvas>
                            <script>
                                <?php $newsList = \common\models\News::find()->orderBy('news_views DESC')->limit(10)->all();?>
                                let newsTitles = [];
                                let times = [];
                                <?php for($i = 0,$iMax = count($newsList, COUNT_RECURSIVE); $i < $iMax; $i++):?>
                                <?php $news = $newsList[$i]; ?>
                                newsTitles.push("<?=$news->news_id?>");
                                times.push("<?=$news->news_views?>");
                                <?php endfor?>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new Chart(document.querySelector('#barChart'), {
                                        type: 'bar',
                                        data: {
                                            labels: newsTitles,
                                            datasets: [{
                                                label: 'Top Views',
                                                data: times,
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)',
                                                    'rgba(255, 205, 86, 0.2)',
                                                    'rgb(199,255,82, 0.2)',
                                                    'rgb(100,252,150, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgb(66,101,250, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(201, 203, 207, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgb(255, 99, 132)',
                                                    'rgb(255, 159, 64)',
                                                    'rgb(255, 205, 86)',
                                                    'rgb(199,255,82)',
                                                    'rgb(100,252,150)',
                                                    'rgb(75, 192, 192)',
                                                    'rgb(54, 162, 235)',
                                                    'rgb(66,101,250)',
                                                    'rgb(153, 102, 255)',
                                                    'rgb(201, 203, 207)',
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                            <!-- End Bar CHart -->

                        </div>
                    </div><!-- End Budget Report -->
                </div><!-- End Top Views -->

            </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

            <!-- Recent Activity -->
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">Recent Activity</h5>

                    <div class="activity">
                        <?php $activeTab = common\models\HistoricalActivity::find()->orderBy('time DESC')->limit(15)->all();?>
                        <?php for($i = 0, $iMax = count($activeTab, COUNT_RECURSIVE); $i < $iMax; $i++):?>
                            <?php $activity = $activeTab[$i];?>
                            <?php $userName = common\models\User::find()->where(['id' => $activity->user_id])->all()[0]->username;?>
                            <div class="activity-item d-flex">
                                <div class="activite-label"><?=$activity->time?>&nbsp&nbsp</div>

                                <?php if($activity->operation==='create'):?>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <?php elseif($activity->operation==='delete'):?>
                                    <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                <?php elseif($activity->operation==='update'):?>
                                    <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                <?php else:?>
                                    <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                                <?php endif?>

                                <div class="activity-content">
                                    <a href="<?="index.php?r=user"?>" class="fw-bold text-muted"><?=$userName?></a>
                                    <?php if($activity->operation==='create'):?>
                                        <a class="fw-bold text-success">created</a>
                                    <?php elseif($activity->operation==='delete'):?>
                                        <a class="fw-bold text-danger">deleted</a>
                                    <?php elseif($activity->operation==='update'):?>
                                        <a class="fw-bold text-primary">updated</a>
                                    <?php else:?>
                                        <a class="fw-bold text-info">modified</a>
                                    <?php endif?>
                                    in
                                    <?php $herf = str_replace('_','-', $activity->table_name);?>
                                    <a href="<?="index.php?r=" . $herf ?>" class="fw-bold text-dark"><?=$activity->table_name?></a>
                                </div>
                            </div><!-- End activity item-->
                        <?php endfor?>

                    </div>

                </div>
            </div><!-- End Recent Activity -->

            <!-- Website Traffic -->
            <div class="card">

                <div class="card-body pb-0">
                    <h5 class="card-title">Source Statistics</h5>

                    <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                    <script>
                        <?php $sourceList = \common\models\NewsSource::find()->all();?>
                        let input = [];
                        <?php for($i = 0,$iMax = count($sourceList, COUNT_RECURSIVE); $i < $iMax; $i++):?>
                        <?php $source = $sourceList[$i]; ?>
                        input.push({
                            value: <?= $source->getNewsNum();?>,
                            name: '<?= $source->source_name;?>'
                        });
                        <?php endfor?>
                        document.addEventListener("DOMContentLoaded", () => {
                            echarts.init(document.querySelector("#trafficChart")).setOption({
                                tooltip: {
                                    trigger: 'item'
                                },
                                legend: {
                                    top: '5%',
                                    left: 'center'
                                },
                                series: [{
                                    name: 'Access From',
                                    type: 'pie',
                                    radius: ['40%', '70%'],
                                    avoidLabelOverlap: false,
                                    label: {
                                        show: false,
                                        position: 'center'
                                    },
                                    emphasis: {
                                        label: {
                                            show: true,
                                            fontSize: '18',
                                            fontWeight: 'bold'
                                        }
                                    },
                                    labelLine: {
                                        show: false
                                    },
                                    data: input
                                }]
                            });
                        });
                    </script>

                </div>
            </div><!-- End Website Traffic -->

        </div><!-- End Right side columns -->

    </div>
</section>


