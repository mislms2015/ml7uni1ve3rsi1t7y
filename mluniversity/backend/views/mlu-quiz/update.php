<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MluQuiz */

$this->title = 'Update Mlu Quiz: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mlu Quizzes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mlu-quiz-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
