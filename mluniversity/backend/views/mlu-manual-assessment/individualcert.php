<?php
namespace backend\controllers;

use Yii;
use backend\models\MluManualTraining;
use backend\models\MlumanualAssessment;
use backend\models\MluManualDiamond;
use backend\models\MluManualGold;

//$id = Yii::$app->session['manual_individual'];

?>

<div style="width:1000px; height:1000px; padding:20px; text-align:center; border: 10px solid #787878">
<div style="width:950px; height:900px; padding:20px; text-align:center; border: 5px solid #787878">
<!-- <p align='center'> <img src="<?php // echo dirname(__FILE__).'/../../../backend/pdf/watermark/header.jpg'?>" width='250' height='90'> </p> -->

       <span style="font-size:40px; font-weight:bold; color:red">Certificate of Completion</span>
       <br/><br/><br/><br/>
       <span style="font-size:25px"><i>This is to certify that</i></span>
       <br/><br/><br/>
       <span style="font-size:30px"><b><?=ucwords($individual_cert['fname']). ' ' .ucwords($individual_cert['lname'])?></b></span><br/><br/>
       <span style="font-size:25px"><i>has attended the </i></span> <br/><br/>
       <span style="font-size:30px"><b><?=ucwords($training['name'])?></b></span> <br/><br/>
       <span style="font-size:25px"><i>training </i></span> <br/><br/>

<!-- if grading exist -->
<?php
if ($diamond_check > 0){
  $diamond_list = MluManualDiamond::find()->where(['examinee_id' => $id])->all();
?>
<table align='center' style="border-collapse:collapse;">
    <tr style='background-color: #a8a4a4'>
      <th style='text-align: center;'> Clarity </th>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <th style='text-align: center;'> Color </th>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <th style='text-align: center;'> Cut </th>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <th style='text-align: center;'> Carat </th>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <th style='text-align: center;'> Average </th>
    </tr>
    <tr> <td colspan=9> <hr /> </td> </tr>

<?php
foreach($diamond_list as $diamond_list_result):
  $clarity = preg_replace('/\D/', '', $diamond_list_result->clarity);
  $color = preg_replace('/\D/', '', $diamond_list_result->color);
  $cut = preg_replace('/\D/', '', $diamond_list_result->cut);
  $carat = preg_replace('/\D/', '', $diamond_list_result->carat);
  $ave = (intval($clarity) + intval($color) + intval($cut) + intval($carat)) / 4;
?>
<tr>
      <td > <?=$diamond_list_result->clarity?> </td>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <td > <?=$diamond_list_result->color?> </td>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <td > <?=$diamond_list_result->cut?> </td>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <td > <?=$diamond_list_result->carat?> </td>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <td > <?=$ave.'%'?> </td>
    </tr>
<?php
endforeach;
?>

    <tr> <td colspan=9> <hr /> </td> </tr>
</table>
<br />
<?php
}else if ($gold_check > 0){
  $gold_list = MluManualGold::find()->where(['examinee_id' => $id])->all();
?>
<table align='center' style="border-collapse:collapse;">
    <tr style='background-color: #a8a4a4'>
      <th style='text-align: center;'> Day 1 </th>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <th style='text-align: center;'> Day 2 </th>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <th style='text-align: center;'> Average </th>
    </tr>
    <tr> <td colspan=7> <hr /> </td> </tr>

<?php
//$average = [];
foreach($gold_list as $gold_list_result):
  $aveday1 = preg_replace('/\D/', '', $gold_list_result->day1);
  $aveday2 = preg_replace('/\D/', '', $gold_list_result->day2);
  $ave = (intval($aveday1) + intval($aveday2)) / 2;
?>
<tr>
      <td > <?=$gold_list_result->day1?> </td>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <td > <?=$gold_list_result->day2?> </td>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
      <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <td > <?=$ave.'%'?> </td>
    </tr>
<?php
endforeach;
?>

    <tr> <td colspan=7> <hr /> </td> </tr>
</table>
<br />
<?php
} else {
  echo '<br />';
}
?>
<!-- if grading exist -->
       
<?php
$date_to_temp = date('F j, Y', strtotime($training['date_conduct_to']));
if($date_to_temp != "January 1, 1970"){
  $date_to = date('j', strtotime($training['date_conduct_to']));
?>
       <span style="font-size:20px">on <b><?=date('F j-'.$date_to.', Y', strtotime($training['date_conduct']))?></b></span> 
<?php
} else{
?>
       <span style="font-size:20px">on <b><?=date('F j, Y', strtotime($training['date_conduct']))?></b></span> 
<?php
}
?>
       <br/><br/><br/>

<table>
<?php
$training_facility = $training['trainor'];
$arr_var = explode('&', $training_facility);

if (strpos($training_facility, '&')){
  for ($i = 0; $i < sizeof($arr_var); $i++){
?>
  <tr>
      <td align="left" style="font-size: 20px;"><b><u> <?=ucwords($arr_var[$i])?> </u></b></td>
   </tr>

   <tr>
      <td align="left" style="font-size: 20px;"> Training Facilitator </td>
   </tr>
   <tr>
      <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
   </tr>
   <tr>
      <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
   </tr>
<?php
  }
} else{
?>
   <tr>
      <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
   </tr>
   <tr>
      <td align="left" style="font-size: 20px;"><b><u> <?=ucwords($training['trainor'])?> </u></b></td>
   </tr>

   <tr>
      <td align="left" style="font-size: 20px;"> Training Facilitator </td>
   </tr>

<?php
}
?>
   

</table>
       <!-- <span style="font-size:25px"><i>dated</i></span><br><br/>
      #set ($dt = $DateFormatter.getFormattedDate($grade.getAwardDate(), "MMMM dd, yyyy"))
      <span style="font-size:30px">$dt</span> -->
</div>
</div>
