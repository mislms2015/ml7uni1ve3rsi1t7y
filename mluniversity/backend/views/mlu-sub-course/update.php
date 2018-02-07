<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MluSubCourse */

$this->title = 'Update Mlu Sub Course: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mlu Sub Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mlu-sub-course-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
