<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MluSubCourse */

$this->title = 'Create Mlu Sub Course';
$this->params['breadcrumbs'][] = ['label' => 'Mlu Sub Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mlu-sub-course-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
