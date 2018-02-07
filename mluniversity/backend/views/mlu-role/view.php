<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;
use backend\assets\tableAsset;

tableAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\MluRole */

$this->title = $model->full_name;
/*$this->params['breadcrumbs'][] = ['label' => 'Mlu Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="mlu-role-view">

    <h3><?= Html::encode($this->title) ?></h3>

<?php
if (Yii::$app->user->can('administrator')) {
?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'short_name',
            'full_name',
        ],
    ]) ?>

    <!-- enrolled user -->
    <br />
    <br />
    <h5> Enrolled user </h5>

    <div class="wrapper">
  
    <div class="table">
      <div class="row header green">
        <div class="cell">
          Username
        </div>
      </div>

<?php
foreach($role_enrolled as $role_enrolled_result):
    $find_user = User::find()->where(['id' => $role_enrolled_result->user_id])->one();
    
?>
      <div class="row">
        <div class="cell">
            <?php echo $find_user->username?> 1
        </div>
      </div>
<?php
endforeach;
?>
      
    </div>
  
  </div>
    <!-- enrolled user -->

</div>
