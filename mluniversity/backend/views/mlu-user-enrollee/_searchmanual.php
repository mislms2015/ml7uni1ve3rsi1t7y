<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MluManualAssessmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mlu-course-search">

    <?php 
    $id = Yii::$app->session['course_id'];
    $form = ActiveForm::begin([
        'action' => ['enrollee?id='.$id],
        'method' => 'get',
        'enableClientScript' => false,
    ]); ?>

                <?= $form->field($model, 'globalSearch', ['options' => [
                    'tag' => 'div',
                    'class' => 'form-group has-feedback required',
                    'style' => 'width: 300px;',
                    ],
                    'template' => '{input}<span class="glyphicon glyphicon-search form-control-feedback"></span>
                    {error}{hint}'
                ])->textInput(['placeholder' => 'Search', 'title'=>'Search']) ?>

    <?php // echo $form->field($model, 'manual_id')->textInput(['readonly' => false, 'value' => Yii::$app->session['training_id']]) ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'training_id') ?>

    <?php // echo $form->field($model, 'fname') ?>

    <?php // echo $form->field($model, 'lname') ?>

    <?php // echo $form->field($model, 'id_number') ?>

    <!-- <div class="form-group">
        <?php // echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php // echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>
