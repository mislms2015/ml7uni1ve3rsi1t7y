<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class TableAsset extends AssetBundle
{
        /*public $basePath = '@webroot';
    public $baseUrl = '@web';*/
    public $sourcePath = '@bower/adminbsb/table/responsive_table';
    public $css = [
        'css/normalize.min.css',
        'css/style.css',
    ];

    public $js = [
        'js/jquery.min.js',
    ];
    public $depends = [
    ];
}
