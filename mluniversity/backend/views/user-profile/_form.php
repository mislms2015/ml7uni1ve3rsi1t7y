<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'picture')->fileInput() ?>

    <?php // echo $form->field($model, 'user_id')->textInput() ?>

    <?php //echo $form->field($model, 'picture')->widget(\trntv\filekit\widget\Upload::classname(), [
        //'url'=>['avatar-upload']
    //]) ?>

    <?= $form->field($model, 'firstname', ['options' => [
                    'style' => 'width: 400px;',
                    ]])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middlename', ['options' => [
                    'style' => 'width: 400px;',
                    ]])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname', ['options' => [
                    'style' => 'width: 400px;',
                    ]])->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'avatar_path')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'avatar_base_url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
