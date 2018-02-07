<?php

use backend\assets\loginAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

loginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<link rel="shortcut icon" href="/mluniversity/dashboard/mlu.ico" type="image/x-icon">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    
    <div class="container">
        <?= $content ?>
    </div>
</div>

<!--<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?php // Yii::powered() ?></p>
    </div>
</footer>
-->

<!-- <footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <b>M. Lhuillier</b> <?= date('Y') ?></p>
        <p class="pull-right">Powered by <b>L&D</b> <i>v1.0</i> </p>
    </div>
</footer> -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
