<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MluRole */

$this->title = 'Update: ' . $model->full_name;
/*$this->params['breadcrumbs'][] = ['label' => 'Mlu Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';*/
?>
<div class="mlu-role-update">

    <h3><?= Html::encode($this->title) ?></h3>
    <br />

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
