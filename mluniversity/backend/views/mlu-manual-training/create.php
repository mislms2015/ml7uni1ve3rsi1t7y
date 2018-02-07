<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MluManualTraining */

$this->title = 'Create Mlu Manual Training';
$this->params['breadcrumbs'][] = ['label' => 'Mlu Manual Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mlu-manual-training-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
