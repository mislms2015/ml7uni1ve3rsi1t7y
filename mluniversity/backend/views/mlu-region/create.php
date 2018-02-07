<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MluRegion */

$this->title = 'Create MLU Region';
/*$this->params['breadcrumbs'][] = ['label' => 'Mlu Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="mlu-region-create">

    <h3><?= Html::encode($this->title) ?></h3>
    <br />

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
