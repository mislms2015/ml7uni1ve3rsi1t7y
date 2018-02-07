<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MluManualAssessment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mlu-manual-assessment-form">

    <?php $form = ActiveForm::begin(
    	[
    		'options' => ['enctype' => 'multipart/form-data'],
    		'enableClientScript' => false,
    		//'enableClientValidation'=>false,
    		//'id'=>'mluassessmet'
    	]); ?>

    <?php // echo $form->field($model, 'training_id')->textInput() ?>

    <?php // echo $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'id_number')->textInput() ?>

    <?php /* echo $form->field($model, 'trainingtitle',
    				['options' => [
                    'style' => 'width: 300px;',
                    ]])->textInput() */?>

    <?= $form->field($model, 'trainingupload')->fileInput(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data' => ['confirm' => 'Are you sure to upload this file?']]) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php // echo Html::a('Create PDF', ['mlu-manual-assessment/attendedcert', 'id'=>156], ['target' => '_blank', 'class'=>'btn btn-danger', 'title' => 'Training Attended', 'style' => 'height: 30px;']) ?>

</div>
