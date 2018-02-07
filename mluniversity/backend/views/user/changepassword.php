<?php
use yii\helpers\Html;
//use frontend\widgets\Alert;
use yii\widgets\Activeform;

$this->title = 'Change Password';
?>

<?php // echo Alert::widget() ?>

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Change password!</h4>
  <h5><?= Yii::$app->session->getFlash('success') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<h3><?= Html::encode($this->title) ?></h3>
<br />

<?php $form = Activeform::begin(); ?>

<?= $form->field($user, 'currentPassword', ['options' => [
                    'style' => 'width: 400px;',
                    ]])->passwordInput() ?>

<?= $form->field($user, 'newPassword', ['options' => [
                    'style' => 'width: 400px;',
                    ]])->passwordInput() ?>

<?= $form->field($user, 'newPasswordConfirm', ['options' => [
                    'style' => 'width: 400px;',
                    ]])->passwordInput() ?>

<div class="form-group">
		<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>

<?php Activeform::end(); ?>