<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register new user';
/*$this->params['breadcrumbs'][] = $this->title;*/
?>

<h3><?= Html::encode($this->title) ?></h3>

<div class="site-signup">

    <p>Please fill out the following fields to signup:</p>
    <br />

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => false]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'email') ?>

                <div class="form-group">
                    <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'data' => ['confirm' => 'Are you sure you want to register this account?']]) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
