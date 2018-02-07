<?php
namespace backend\controllers;

use Yii;
use backend\models\MluManualTraining;
use backend\models\MlumanualAssessment;
use backend\models\MluUserEnrollee;
use backend\models\MluCourse;

?>

<div style="width:1000px; height:1000px; padding:20px; text-align:center; border: 10px solid #787878">
<div style="width:950px; height:900px; padding:20px; text-align:center; border: 5px solid #787878">
<!-- <p align='center'> <img src="<?php // echo dirname(__FILE__).'/../../../backend/pdf/watermark/header.jpg'?>" width='250' height='90'> </p> -->

       <span style="font-size:40px; font-weight:bold; color:red">Certificate of Completion</span>
       <br/><br/>
       <span style="font-size:25px"><i>This is to certify that</i></span>
       <br/><br/>
       <span style="font-size:30px"><b><?=ucwords($attended_cert['fname']). ' ' .ucwords($attended_cert['lname'])?></b></span><br/><br/>
       <span style="font-size:25px"><i>has attended: </i></span> <br/><br/>

       <!-- <span style="font-size:30px">Warriors Technique</span> <br/><br/> -->
<table align='center' style="border-collapse:collapse;">
    <tr style='background-color: #a8a4a4'>
      <th style='text-align: center;'> Training </th>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <th style='text-align: center;'> Date Conduct </th>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <th style='text-align: center;'> Facilitator </th>
    </tr>
    <tr> <td colspan=5> <hr /> </td> </tr>
<?php
foreach($attended_all as $attended_all_result):
  $attended_training = MluManualTraining::find()->where(['id' => $attended_all_result['training_id']])->one();
?>

    <tr>
      <td > <font color='$class'> <?=ucwords($attended_training['name'])?> </td>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
<?php
$date_to_temp = date('F j, Y', strtotime($attended_training['date_conduct_to']));
if($date_to_temp != "January 1, 1970"){
  $date_to = date('j', strtotime($attended_training['date_conduct_to']));
?>
      <td style='text-align: center;'> <font color='$class'> <?=date('F j-'.$date_to.', Y', strtotime($attended_training['date_conduct']))?> </td>
<?php
} else{
?>
      <td style='text-align: center;'> <font color='$class'> <?=date('F j, Y', strtotime($attended_training['date_conduct']))?> </td>
<?php
}
?>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <td style='text-align: center;'> <font color='$class'> <?=ucwords($attended_training['trainor'])?> </td>
    </tr>

<?php
endforeach;
?>

    <tr> <td colspan=5> <hr /> </td> </tr>
</table>
       
       <span style="font-size:25px"><i>via classroom training.</i></span> <br/>

<?php
$sync_enrollee_count = MluUserEnrollee::find()->where(['id_number' => $attended_cert['id_number'] ])->count();

if ($sync_enrollee_count > 0){
?>
       <span style="font-size:25px"><i>&</i></span> <br/>
<?php
$sync_enrollee = MluUserEnrollee::find()->where(['id_number' => $attended_cert['id_number'] ])->all();

foreach($sync_enrollee as $sync_enrollee_result):
$sync_training = MluCourse::find()->where(['course_id' => $sync_enrollee_result['course_id']])->one();
?>
       <span style="font-size:15px; color: #2d6fd8"> <b><i> <?='"' .ucwords($sync_training['name']). '"'?> </i></b> </span> <br/>
<?php
endforeach;
?>
       <br /><span style="font-size:25px"><i>via Learning Management System training.</i></span> <br/>

<?php } ?>
  <!--      <span style="font-size:20px">on <b><?php // echo "May 1, 1901"?></b></span> <br/>

<br/><br/> -->
<!-- <table>
   <tr>
      <td align="left" style="font-size: 20px;"><b><u> <?php // echo "Mark Lee"?> </u></b></td>
   </tr>

   <tr>
      <td align="left" style="font-size: 20px;"> Training Facilitator </td>
   </tr>

</table> -->
       <!-- <span style="font-size:25px"><i>dated</i></span><br><br/>
      #set ($dt = $DateFormatter.getFormattedDate($grade.getAwardDate(), "MMMM dd, yyyy"))
      <span style="font-size:30px">$dt</span> -->
</div>
</div>
