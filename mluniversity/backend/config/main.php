<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-mluniversity', 'httpOnly' => true],
            //'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backendmluniversity',
            //'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*additional for pretty url. i add web.config at root folder*/
        'urlManager' => [
        'class' => 'yii\web\UrlManager',
        // Disable index.php
        'showScriptName' => false,
        // Disable r= routes
        'enablePrettyUrl' => true,
        'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        ),
        ],
        /*additional for pretty url. i add web.config at root folder*/
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */

        /*this setup happen usually if template you use was conflict*/
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    //'sourcePath' => null, 'js' => ['//code.jquery.com/jquery-2.2.4.min.js'],
                    'sourcePath' => '@bower/adminbsb/outsource/', 'js' => ['jqueryv224.js'],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    //'sourcePath' => null, 'css' => ['//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'],
                    'sourcePath' => '@bower/adminbsb/outsource/', 'css' => ['bootstrapv337.css'],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    //'sourcePath' => null, 'js' => ['//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'],
                    'sourcePath' => '@bower/adminbsb/outsource/', 'js' => ['bootstrapv337.js'],
                ],
            ],
        ],
    /**/

    ],
    'params' => $params,
];
