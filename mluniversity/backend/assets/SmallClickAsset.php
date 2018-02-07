<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class SmallClickAsset extends AssetBundle
{
        /*public $basePath = '@webroot';
    public $baseUrl = '@web';*/
    public $sourcePath = '@bower/adminbsb/';
    public $css = [
        //'css/normalize.min.css',
        //'css/style.css',
    ];

    public $js = [
        "plugins/jquery/jquery.min.js",
        "plugins/bootstrap/js/bootstrap.js",
        "plugins/bootstrap-select/js/bootstrap-select.js",
        "plugins/jquery-slimscroll/jquery.slimscroll.js",
    ];
    public $depends = [
    ];
}
