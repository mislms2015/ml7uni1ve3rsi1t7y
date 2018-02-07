<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MluQuiz */

$this->title = 'Create Mlu Quiz';
$this->params['breadcrumbs'][] = ['label' => 'Mlu Quizzes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mlu-quiz-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
