<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MluRole */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mlu-role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'short_name', ['options' => ['style' => 'width: 300px;']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_name', ['options' => ['style' => 'width: 300px;']])->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
