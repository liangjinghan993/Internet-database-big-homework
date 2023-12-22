<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/statics';
    public $css = [
//        'css/site.css',
        'assets/vendor/bootstrap/css/bootstrap.min.css',
        'assets/vendor/bootstrap-icons/bootstrap-icons.css',
        'assets/vendor/boxicons/css/boxicons.min.css',
        'assets/vendor/quill/quill.snow.css',
        'assets/vendor/quill/quill.bubble.css',
        'assets/vendor/remixicon/remixicon.css',
        'assets/vendor/simple-datatables/style.css',
        'assets/css/style.css'
    ];
    public $js = [
        'assets/vendor/apexcharts/apexcharts.min.js',
        'assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'assets/vendor/chart.js/chart.umd.js',
        'assets/vendor/echarts/echarts.min.js',
        'assets/vendor/quill/quill.min.js',
        'assets/vendor/simple-datatables/simple-datatables.js',
        'assets/vendor/tinymce/tinymce.min.js',
        'assets/vendor/php-email-form/validate.js',
        'assets/js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
