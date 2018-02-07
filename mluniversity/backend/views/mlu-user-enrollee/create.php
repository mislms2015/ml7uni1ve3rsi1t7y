<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MluUserEnrollee */

$this->title = 'Create Mlu User Enrollee';
$this->params['breadcrumbs'][] = ['label' => 'Mlu User Enrollees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mlu-user-enrollee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
