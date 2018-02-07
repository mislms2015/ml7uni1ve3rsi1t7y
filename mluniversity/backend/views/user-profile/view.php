<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\MluRole;
use backend\models\MluRoleAssignment;
use backend\models\MluRegion;
use backend\assets\tableAsset;

tableAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\UserProfile */

$this->title = 'My Profile';
/*$this->params['breadcrumbs'][] = ['label' => 'User Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('uploaderrorextension')): ?>
  <div class="alert alert-warning alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-close"></i>Update profile!</h4>
  <h5><?= Yii::$app->session->getFlash('uploaderrorextension') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('profileupdate')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Update profile!</h4>
  <h5><?= Yii::$app->session->getFlash('profileupdate') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<div class="user-profile-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <br />

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /*echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'user_id',
            'firstname',
            'middlename',
            'lastname',
            //'avatar_path',
            //'avatar_base_url:url',
        ],
    ]) ?>

    <!-- ********************************************************* -->
<?php
if(($check_exist->item_name != 'administrator') && ($check_exist->item_name != 'system admin')){
?>
    <br />
    <div class="wrapper">
  
    <div class="table">
      <div class="row header green">
        <div class="cell">
          Designation
        </div>
        <div class="cell">
          Region/s
        </div>
      </div>
<?php
if ($count_user_role == 0){
        $designation = 'No designation assign';
        $region_list = 'No region assign';
?>
      <div class="row">
        <div class="cell">
            <?=$designation?>
        </div>
        <div class="cell">
            <?=$region_list?>
        </div>
      </div>
<?php

    } else{
foreach($get_user_role as $get_user_role_result):
    $region = '';
    $check_assignment = MluRoleAssignment::find()->where(['assign_id' => $get_user_role_result->id])->count();
    if (($count_user_role > 0) && ($check_assignment == 0)){
      //echo 'checked: ' .$check_assignment;
      //exit;
        $get_designation = MluRole::find()->where(['id' => $get_user_role_result->role_id])->one();
        $designation = ucwords($get_designation->full_name);
        $region = 'No region assigned';
    } else{
        $get_assignment = MluRoleAssignment::find()->where(['assign_id' => $get_user_role_result->id])->all();
        $get_designation = MluRole::find()->where(['id' => $get_user_role_result->role_id])->one();
        foreach($get_assignment as $get_assignment_result):
            $designation = ucwords($get_designation->full_name);
            $get_region = MluRegion::find()->where(['id' => $get_assignment_result->region_id])->one();

            $region = $region.$get_region->full_name. ', ';

        endforeach;
    }
    $region_list = substr($region, 0, -2);
?>
      <div class="row">
        <div class="cell">
            <?=$designation?>
        </div>
        <div class="cell">
            <?=$region_list?>
        </div>
      </div>
<?php
  endforeach;
}
?>
      
    </div>
  
  </div>
<?php } ?>
    <!-- ********************************************************* -->

</div>
