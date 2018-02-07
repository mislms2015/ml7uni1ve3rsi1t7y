<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
        /*public $basePath = '@webroot';
    public $baseUrl = '@web';*/
    public $sourcePath = '@bower/adminbsb/';
    public $css = [
/*        'css/site.css',*/
        "font/font1.css",
        "font/font2.css",
        //"plugins/bootstrap/css/bootstrap.css",
        "plugins/node-waves/waves.css",
        "plugins/animate-css/animate.css",
        "plugins/morrisjs/morris.css",
        "css/style.css",
        "css/themes/all-themes.css"

    ];

    public $js = [
        //"plugins/jquery/jquery.min.js",
        //"plugins/bootstrap/js/bootstrap.js",
        "plugins/bootstrap-select/js/bootstrap-select.js",
        "plugins/jquery-slimscroll/jquery.slimscroll.js",
        "plugins/node-waves/waves.js",
/*        "plugins/jquery-countto/jquery.countTo.js",
        "plugins/raphael/raphael.min.js",
        "plugins/morrisjs/morris.js",
        "plugins/chartjs/Chart.bundle.js",*/
        "plugins/flot-charts/jquery.flot.js",
/*        "plugins/flot-charts/jquery.flot.resize.js",
        "plugins/flot-charts/jquery.flot.pie.js",
        "plugins/flot-charts/jquery.flot.categories.js",
        "plugins/flot-charts/jquery.flot.time.js",*/
        "plugins/jquery-sparkline/jquery.sparkline.js",
        "js/admin.js",
/*        "js/pages/index.js",*/
        "js/demo.js",
        //"outsource/analytics.js",
        "js/clickable.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}

/*
'js' => [
    'jquery.js', // all pages
    'jui.js' => ['product/create', 'product/update'], // only on pages which described by route
],
'css' => [
    'site.css',
    'selectize.css' => ['article/create'],
],
*/