<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
/*use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;*/

//AppAsset::register($this);
$asset = backend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="shortcut icon" href="/mluniversity/dashboard/mlu.ico" type="image/x-icon">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<!-- add im for background image in index -->
<body class="theme-red im">
<?php $this->beginBody() ?>

<?php
//Yii::$app->session['baseurl'] = '../vendor/bower/adminbsb/';
Yii::$app->session['dp'] = '/mluniversity/dashboard/dp/';
?>
<!-- <div class=""> -->
    <?= $this->render('pageloader.php', ['baseUrl' => $baseUrl]) ?>
    <div class="overlay"></div>
    <?= $this->render('navigation.php', ['baseUrl' => $baseUrl]) ?>
    <?= $this->render('sectionleft.php', ['baseUrl' => $baseUrl]) ?>
    <?php // echo $this->render('navsec.php', ['baseUrl' => $baseUrl]) ?>
    <?= $this->render('content.php', ['content' => $content]) ?>
<!-- </div> -->

<!-- <footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?php // echo Html::encode(Yii::$app->name) ?> <?php // echo date('Y') ?></p>

        <p class="pull-right"><?php // echo Yii::powered() ?></p>
    </div>
</footer> -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
