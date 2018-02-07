<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MluCourse */

$this->title = 'Create Mlu Course';
$this->params['breadcrumbs'][] = ['label' => 'Mlu Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mlu-course-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
