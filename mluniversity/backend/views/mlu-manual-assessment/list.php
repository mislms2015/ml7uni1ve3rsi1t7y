<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MluManualAssessmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Classroom training list';
?>

<!-- <h3><?php // echo Html::encode($this->title) ?></h3> -->

<div class="mlu-manual-assessment-index">

    <div class="panel panel-info">
            <div class="panel-heading"><b>CLASSROOM TRAINING LIST<b/></div>
            <div class="panel-body">
              <table class="table table-striped table-hover table-bordered table-condensed">
                <tr>
                    <th style="text-align: center;">Training</th>          
                    <th style="text-align: center;">Date Conducted</th>
                    <th style="text-align: center;">Facilitator</th>
                </tr>

<?php
    foreach($training_list as $training_list_result):

        $date_to_temp = date('F j, Y', strtotime($training_list_result['date_conduct_to']));
        if($date_to_temp != "January 1, 1970"){
            $date_to = date('j', strtotime($training_list_result['date_conduct_to']));

            $training_date = date('F j-'.$date_to.', Y', strtotime($training_list_result['date_conduct'])); 

        } else{

            $training_date = date('F j, Y', strtotime($training_list_result['date_conduct']));

        }
?>

                <tr>
                    <td style="text-align: center; color: #3c8dbc; cursor: pointer;" class='clickable-row' data-href="../mlu-manual-assessment/manualenrollee?id=<?php echo $training_list_result->id ?>"> <?=ucwords($training_list_result->name)?> </td>
                    <td style="text-align: center; color: #3c8dbc; cursor: pointer;" class='clickable-row' data-href="../mlu-manual-assessment/manualenrollee?id=<?php echo $training_list_result->id ?>"> <?=$training_date?> </td>
                    <td style="text-align: center; color: #3c8dbc; cursor: pointer;" class='clickable-row' data-href="../mlu-manual-assessment/manualenrollee?id=<?php echo $training_list_result->id ?>"> <?=ucwords($training_list_result->trainor)?> </td>
                </tr>
<?php
    endforeach;
?>

            </table>
        </div>
    </div>

</div>
