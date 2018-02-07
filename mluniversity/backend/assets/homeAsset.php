<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class homeAsset extends AssetBundle
{
        /*public $basePath = '@webroot';
    public $baseUrl = '@web';*/
    public $sourcePath = '@bower/homepage/';

    public $css = [
        'assets/css/home.css',
    ];

    public $js = [
    ];
    public $depends = [];
}
