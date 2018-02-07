<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MluManualAssessment */

$this->title = 'Upload Conducted Training';
/*$this->params['breadcrumbs'][] = ['label' => 'Mlu Manual Assessments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="mlu-manual-assessment-create">

    <h3><?= Html::encode($this->title) ?></h3>
    <br />

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
