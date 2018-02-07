<?php
namespace backend\controllers;

use Yii;
use backend\models\MluUserEnrollee;
use backend\models\MluCourse;

$id = Yii::$app->session['sync_cert'];


$sync_cert = MluUserEnrollee::find()->where(['id' => $id])->one();
$training = MluCourse::find()->where(['course_id' => $sync_cert['course_id']])->one();

?>

<div style="width:1000px; height:1000px; padding:20px; text-align:center; border: 10px solid #787878">
<div style="width:950px; height:900px; padding:20px; text-align:center; border: 5px solid #787878">
<!-- <p align='center'> <img src="<?php // echo dirname(__FILE__).'/../../../backend/pdf/watermark/header.jpg'?>" width='250' height='90'> </p> -->

       <span style="font-size:40px; font-weight:bold; color:red">Certificate of Completion</span>
       <br/><br/><br/><br/>
       <span style="font-size:25px"><i>This is to certify that</i></span>
       <br/><br/><br/>
       <span style="font-size:30px"><b><?=ucwords($sync_cert['fname']). ' ' .ucwords($sync_cert['lname'])?></b></span><br/><br/>
       <span style="font-size:25px"><i>has attended the </i></span> <br/><br/>
       <span style="font-size:30px"><b><?=ucwords($training['name'])?></b></span> <br/><br/>
       <span style="font-size:25px"><i>training </i></span> <br/><br/>
       <span style="font-size:25px"><i>via Learning Management System </i></span> <br/><br/><br/>
       <!-- <span style="font-size:20px">on <b><?php // echo date('F j, Y', strtotime($training['date_conduct']))?></b></span> <br/><br/><br/><br/><br/><br/><br/> -->
<br /><br />
<!-- <table>
   <tr>
      <td align="left" style="font-size: 20px;"><b><u> <?='training'?> </u></b></td>
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
