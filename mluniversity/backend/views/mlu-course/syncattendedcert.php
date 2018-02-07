<?php
namespace backend\controllers;

use Yii;
use backend\models\MluManualTraining;
use backend\models\MlumanualAssessment;
use backend\models\MluUserEnrollee;
use backend\models\MluCourse;

$id = Yii::$app->session['sync_attended_cert'];

$attended_cert = MluUserEnrollee::find()->where(['id' => $id])->one();
$attended_all = MluUserEnrollee::find()->where(['user_id' => $attended_cert['user_id']])->all();

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

<!-- ------------------------------------------------------------------------------------------------ -->
<?php
$manual_enrollee_count = MlumanualAssessment::find()->where(['id_number' => $attended_cert['id_number'] ])->count();
if ($manual_enrollee_count > 0){
$manual_enrollee = MlumanualAssessment::find()->where(['id_number' => $attended_cert['id_number'] ])->all();
?>
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
foreach($manual_enrollee as $manual_enrollee_result):
  $manual_attended_training = MluManualTraining::find()->where(['id' => $manual_enrollee_result['training_id']])->one();
?>

    <tr>
      <td > <font color='$class'> <?=ucwords($manual_attended_training['name'])?> </td>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <td style='text-align: center;'> <font color='$class'> <?=date('F j, Y', strtotime($manual_attended_training['date_conduct']))?> </td>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <td style='text-align: center;'> <font color='$class'> <?=ucwords($manual_attended_training['trainor'])?> </td>
    </tr>

<?php
endforeach;
?>

    <tr> <td colspan=5> <hr /> </td> </tr>
</table>

<span style="font-size:25px"><i>via classroom training.</i></span> <br/>
<span style="font-size:25px"><i>&</i></span> <br/>
<?php
}
?>
<!-- ------------------------------------------------------------------------------------------------ -->

       <!-- <span style="font-size:30px">Warriors Technique</span> <br/><br/> -->
<!-- <table align='center' style="border-collapse:collapse;">
    <tr> <td colspan=5> <hr /> </td> </tr> -->

<?php
foreach($attended_all as $attended_all_result):
  $attended_training = MluCourse::find()->where(['course_id' => $attended_all_result['course_id']])->one();
?> 

    <!-- <tr style='background-color: #a8a4a4'>
      <th style='text-align: center;'> <?php // echo ucwords($attended_training['name'])?> </th>
    </tr> -->
    <span style="font-size:15px; color: #2d6fd8"> <b><i> <?='"' .ucwords($attended_training['name']). '"'?> </i></b> </span> <br/>

<?php
endforeach;
?>

<!--     <tr> <td colspan=5> <hr /> </td> </tr>

</table> -->
       
       <br /><span style="font-size:25px"><i>via Learning Management System training.</i></span> <br/>
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
