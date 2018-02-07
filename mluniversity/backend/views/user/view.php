<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\AuthAssignment;
use backend\models\MluRoleUser;
use backend\assets\tableAsset;
use backend\assets\FontawesomeAsset;

tableAsset::register($this);
FontawesomeAsset::register($this);

//use mdm\admin\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
/*$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];*/
/*$this->params['breadcrumbs'][] = $this->title;*/

if (Yii::$app->user->can('administrator')){
    $role = 'administrator';
} else if(Yii::$app->user->can('system admin')){
    $role = 'system admin';
} else{
    $role = 'user';
}

?>

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('assign')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Assign Role!</h4>
  <h5><?= Yii::$app->session->getFlash('assign') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('removeassign')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Remove Role!</h4>
  <h5><?= Yii::$app->session->getFlash('removeassign') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('setrole')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Add Role!</h4>
  <h5><?= Yii::$app->session->getFlash('setrole') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('removerole')): ?>
  <div class="alert alert-warning alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-close"></i>Remove Role!</h4>
  <h5><?= Yii::$app->session->getFlash('removerole') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('regionadd')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Region Add!</h4>
  <h5><?= Yii::$app->session->getFlash('regionadd') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<div class="user-view">

    <h3> <?= Html::encode($this->title) ?> </h3>


    <h5><i> <?='( ' .$check_exist->item_name. ' )'?> </i></h5>
<?php
switch ($role) {
    case "administrator":
        if ($model->id != 1){
            $role_count = AuthAssignment::find()->where(['user_id' => $model->id])
                                                ->andWhere(['item_name' => 'system admin'])
                                                ->count();
            if ($role_count > 0){
                echo Html::a('Remove Administrator', ['user/removeadmin', 'id'=>$model->id], ['data'=>['confirm' => 'Are you sure you want to remove this role to ' .$model->username. '?'], 'target' => '', 'class'=> 'btn btn-danger', 'title' => 'Remove as administrator', 'style' => 'height: 30px;']). '<br /> <br />';
            } else {
                echo Html::a('Administrator', ['user/setadmin', 'id'=>$model->id], ['data'=>['confirm' => 'Are you sure you want to proceed this role to ' .$model->username. '?'], 'target' => '', 'class'=> 'btn btn-warning', 'title' => 'Set as administrator', 'style' => 'height: 30px;']). '<br /> <br />';
            }
        }
        break;
    case "system admin":
        if (($model->id != 1) && ($model->id != 2)){
            $role_count = AuthAssignment::find()->where(['user_id' => $model->id])
                                                ->andWhere(['item_name' => 'system admin'])
                                                ->count();

            if ($role_count > 0){
                echo Html::a('Remove Administrator', ['user/removeadmin', 'id'=>$model->id], ['data'=>['confirm' => 'Are you sure you want to remove this role to ' .$model->username. '?'], 'target' => '', 'class'=> 'btn btn-danger', 'title' => '', 'style' => 'height: 30px;']). '<br /> <br />';
            } else {
                echo Html::a('Administrator', ['user/setadmin', 'id'=>$model->id], ['data'=>['confirm' => 'Are you sure you want to proceed this role to ' .$model->username. '?'], 'target' => '', 'class'=> 'btn btn-warning', 'title' => '', 'style' => 'height: 30px;']). '<br /> <br />';
            }
        }
        break;
    case "user":
        break;
    default:
}
?>

    <p>
        <?php // echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /*echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            //'status',
            //'created_at',
            //'updated_at',
        ],
    ]) ?>

<!-- ********************************************************************************* -->
<?php
if(($check_exist->item_name != 'administrator') && ($check_exist->item_name != 'system admin')){
?>
    <br />
    <br />
    <h5> Designation </h5>

    <div class="wrapper">
  
    <div class="table">
      <div class="row header green">
        <div class="cell">
          Short Name
        </div>
        <div class="cell">
          Full Name
        </div>
        <div class="cell" style="text-align: center;">
          Action
        </div>
      </div>

<?php
foreach($role_list as $role_list_result):
    $role_user_count = MluRoleUser::find()->where(['user_id' => $model->id])
                                          ->andWhere(['role_id' => $role_list_result['id']])
                                          ->count();
    $role_user_check = MluRoleUser::find()->where(['user_id' => $model->id])
                                          ->andWhere(['role_id' => $role_list_result['id']])
                                          ->one();

    if($role_user_count > 0){
        $font_color = 'green';
        $url_link = 'user/removerole';
        $fa_font = 'fa fa-check-circle';
        $message = 'Are you sure to remove this role from ' .$model->username. ' ?';
        $title = 'Remove role';
        $add_region = '&nbsp;&nbsp;&nbsp;' .Html::a('<span class="fa fa-plus" style="color: green"></span>', ['user/addregion', 'id' => $role_list_result->id, 'user' => $model->id, 'role_user' => $role_user_check->id], ['class'=>'', 'style'=>'', 'title'=>'Add region']);
    } else{
        $font_color = 'red';
        $url_link = 'user/setrole';
        $fa_font = 'fa fa-close';
        $message = 'Are you sure you want to add this role to ' .$model->username. ' ?';
        $title = 'Set role';
        $add_region = '';

    }
?>
      <div class="row" style="color: <?=$font_color?>;">
        <div class="cell">
            <?=$role_list_result->short_name?>
        </div>
        <div class="cell">
            <?=$role_list_result->full_name?>
        </div>
        <div class="cell" style="text-align: center;">
            <?=Html::a('<span class="'.$fa_font.'" style="color: '.$font_color.'"></span>', [$url_link, 'id' => $role_list_result->id, 'user' => $model->id], ['class'=>'', 'style'=>'', 'title'=>$title, 'data' => [
                  'confirm' => $message,
                  ],]);?>
            <?=$add_region?>
        </div>
      </div>
<?php
endforeach;
?>
      
    </div>
  
  </div>

<?php } ?>
    <!-- ********************************************************************************* -->

</div>
