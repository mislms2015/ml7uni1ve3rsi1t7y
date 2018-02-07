<?php
namespace backend\controllers;

use Yii;
use backend\models\MluManualTraining;
use backend\models\MluManualAssessment;
?>
<table align='center'>
 <tr>
    <th> MICHEL J. LHUILLIER FINANCIAL SERVICES INC. </th>
 </tr>
 <tr>
    <th align='center'> ML UNIVERSITY </th>
 </tr>
 <tr>
    <td align='center' style='font-style: italic; font-size: 11px;'> Heart Tower Building </td>
 </tr>
 <tr>
    <td align='center' style='font-style: italic; font-size: 11px;'> 108 Valero Street, Salcedo Village, Makati City </td>
 </tr>
</table>

    <br />
    <br />
    <br />
    <br />


<table align='center' style="border-collapse:collapse; font-size:12px;">
    <tr style='background-color: #f9a91d'>
      <th style='text-align: center;'> Training </th>
        <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
        <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
        <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <th style='text-align: center;'> Date Conduct </th>
        <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
        <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
        <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
      <th style='text-align: center;'> Facilitator </th>
    </tr>
    <tr> <td colspan=9> <hr /> </td> </tr>

    <tr>
      <td > <font color='$class'> <?=$title?> </td>
        <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
        <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
        <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <td style='text-align: center;'> <font color='$class'> <?=$date_conduct?> </td>
        <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
        <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
        <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td> 
      <td style='text-align: center;'> <font color='$class'> <?=$facilitator?> </td>
    </tr>
    <tr> <td colspan=9> <hr /> </td> </tr>
</table>

  <br />
  <br />

	<table class="table table-hover table-condensed table-striped" align='center' cellpadding="15" cellspacing="15">
		<tr>
			<th style="border-bottom: 1px dashed #000; border-top: 1px dashed #000; font-size: 12px;">Firstname</th>
			<th style="border-bottom: 1px dashed #000; border-top: 1px dashed #000; text-align: center; font-size: 12px;">Lastname</th>
			<th style="border-bottom: 1px dashed #000; border-top: 1px dashed #000; text-align: center; font-size: 12px;">Region</th>
			<th style="border-bottom: 1px dashed #000; border-top: 1px dashed #000; text-align: center; font-size: 12px;">Area</th>
		</tr>

<?php
foreach($attendee as $attendee_result):
?>
  <tr>
    <td style='text-align: left; font-size: 12px; border-bottom: 1px dashed #ccc;'><?=ucwords($attendee_result['fname'])?></td>
    <td style='text-align: center; font-size: 12px; border-bottom: 1px dashed #ccc;'><?=ucwords($attendee_result['lname'])?></td>
    <td style='text-align: center; font-size: 12px; border-bottom: 1px dashed #ccc;'><?=ucwords($attendee_result['region'])?></td>
    <td style='text-align: center; font-size: 12px; border-bottom: 1px dashed #ccc;'><?=ucwords($attendee_result['area'])?></td>
  </tr>
<?php
endforeach;
?>

	</table>