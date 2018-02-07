<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FontawesomeAsset extends AssetBundle
{
        /*public $basePath = '@webroot';
    public $baseUrl = '@web';*/
    public $sourcePath = '@bower/adminbsb/';
    public $css = [
        'font-awesome/css/font-awesome.min.css',
    ];

    public $js = [
    ];
    public $depends = [
    ];
}
