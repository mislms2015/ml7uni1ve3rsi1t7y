<?php
return [
/*    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],*/
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    /*additional*/
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            /*'site/*', // site is for viewing  all the default yii2 page
            'admin/*',*/
        ],
    ],
    /*additional*/
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /*additional*/
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
        'user' => [
            //'class' => 'mdm\admin\models\User',
            'identityClass' => 'mdm\admin\models\User',
            //'loginUrl' => ['admin/user/login'],
        ],
        /*additional*/
        /*'request' => array(
            'baseUrl' => 'http://192.168.10.69/mluniversity',
        ),*/
    ],
];
