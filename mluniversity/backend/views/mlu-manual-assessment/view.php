<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MluManualAssessment */

$this->title = ucwords($model->fname). ' ' .ucwords($model->lname);

$id = $model->id;
/*$this->params['breadcrumbs'][] = ['label' => 'Mlu Manual Assessments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>

<h3><?= Html::encode($this->title). ' <i><h4>(' .$model->id_number. ')</h4></i>' ?></h3>

<div class="mlu-manual-assessment-view">

<hr>

<?= Html::a('Create PDF', ['mlu-manual-assessment/attendedcert', 'id'=>$id], ['target' => '_blank', 'class'=>'btn btn-danger', 'title' => 'Training Attended', 'style' => 'height: 30px;']) ?>
<br /><br />

<!-- manual enrollee -->
  <div class="panel panel-info">
    <div class="panel-heading"><b>TRAINING SUMMARY</b> <i style="font-size: 13px;"> (via classroom) </i></div>
    <div class="panel-body">
      <table class="table table-striped table-hover table-bordered table-condensed">
        <tr style="color: #4ac4e2;">
          <th style="text-align: left;">Training Title</th>          
          <th style="text-align: left;">Date Conducted</th>
          <th style="text-align: left;">Facilitator</th>
        </tr>
<?php
    foreach($training_list as $training_list_result):
?>
        <tr>          
            <td style="text-align: left;"><?=ucwords($training_list_result->training->name)?></td>
<?php
$date_to_temp = date('F j, Y', strtotime($training_list_result->training->date_conduct_to));
if($date_to_temp != "January 1, 1970"){
  $date_to = date('j', strtotime($training_list_result->training->date_conduct_to));
?>
            <td style="text-align: left;"><?=date('F j-'.$date_to.', Y', strtotime($training_list_result->training->date_conduct))?></td>
<?php
} else{
?>
            <td style="text-align: left;"><?=date('F j, Y', strtotime($training_list_result->training->date_conduct))?></td>
<?php
}
?>
            <td style="text-align: left;"><?=ucwords($training_list_result->training->trainor)?></td>
        </tr>
<?php
    endforeach;
?>
      </table>
    </div>
  </div>
<!-- manual enrollee -->

<!-- sync enrollee -->
<?php
if($training_sync_list_count > 0){
?>
  <div class="panel panel-info">
    <div class="panel-heading"><b>TRAINING SUMMARY</b> <i style="font-size: 13px;"> (via LMS) </i></div>
    <div class="panel-body">
      <table class="table table-striped table-hover table-bordered table-condensed">
        <tr style="color: #4ac4e2;">
          <th style="text-align: left;">Training Title</th>   
        </tr>
<?php
    foreach($training_sync_list as $training_sync_list_result):
?>
        <tr>          
            <td style="text-align: left;"><?=ucwords($training_sync_list_result->course->name)?></td>
        </tr>
<?php
    endforeach;
?>
      </table>
    </div>
  </div>
<?php
}
?>
<!-- sync enrollee -->

</div>
