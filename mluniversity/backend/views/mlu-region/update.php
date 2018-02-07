<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MluRegion */

$this->title = 'Update: ' . $model->full_name;
/*$this->params['breadcrumbs'][] = ['label' => 'Mlu Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';*/
?>
<div class="mlu-region-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <br />

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
