<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MluManualAssessment */

$this->title = 'Update Mlu Manual Assessment: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mlu Manual Assessments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mlu-manual-assessment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
