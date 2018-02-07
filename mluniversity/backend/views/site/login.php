<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
  <!--   <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p> -->

    <div class="top-content">
            
            <div class="inner-bg">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Login to ML University</h3>
                                    <!-- <p>Enter your username and password to log on:</p> -->
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'form']); ?>
                                    <div class="form-group">
                                        <?=$form->field($model, 'username')->textInput(['placeholder' => 'Username'])->label(false);?>
                                    </div>
                                    <div class="form-group">
                                        <?=$form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false);?>
                                    </div>
                                    <button type="submit" class="btn">Sign in!</button>
                                    <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

</div>
