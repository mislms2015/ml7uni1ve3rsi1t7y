<?php

namespace backend\assets;

use yii\web\AssetBundle;

class loginAsset extends AssetBundle
{
    /*public $basePath = '@webroot';
    public $baseUrl = '@web';*/

    public $sourcePath = '@bower/login/';
    public $css = [
        'assets/css/font.css',
        'assets/bootstrap/css/bootstrap.min.css',
        'assets/font-awesome/css/font-awesome.min.css',
        'assets/css/form-elements.css',
        'assets/css/style.css',
    ];

    public $js = [
        //'assets/js/jquery-1.11.1.min.js',
        //'assets/bootstrap/js/bootstrap.min.js',
        'assets/js/jquery.backstretch.min.js',
        'assets/js/scripts.js',
    ];
    public $depends = [
        /*'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',*/
    ];
}
