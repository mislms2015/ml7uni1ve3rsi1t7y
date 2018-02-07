<?php

use yii\bootstrap\Activeform;
use yii\helpers\Html;
use common\models\User;

$this->title = 'Sample checklist';

?>

<script type="text/javascript">
  function checkall(source){
    checkbox = document.querySelectorAll('input[type="checkbox"');
    for(var i = 0; i < checkbox.length; i++){
      if(checkbox[i] != source)
        checkbox[i].checked = source.checked;
      }
  }
</script>

<h5> <?php // echo $samplequery?> </h5>

<?php
        print_r($a);
?>

<h3> <?= Html::encode($this->title) ?> </h3>
<br />
<br />


<!-- sample hashing password -->
<?php
$hash_me = new User();

$sample_password = 'december072015';
echo 'Password: ' .$sample_password. '<br />';
//echo 'Hash: ' .$hash_me->setPassword($sample_password). '<br />';
//print_R($hash_me);
?>
<!-- sample hashing password -->


<div>
<?php //Activeform::begin() ?>
  <table class="table table-bordered table-condensed">
    <tr>
      <th> ID </th>
      <th> Course ID </th>
      <th> Name </th>
      <th> Enroll ID </th>
      <th> 
        <input type="checkbox" onclick="checkall(this)" id="select_all"> <label for="select_all"> Select All </label> 
      </th>
    </tr>

    <?php
    foreach($query as $query_result):
    ?>

      <tr>
        <td> <?=$query_result->id?> </td>
        <td> <?=$query_result->course_id?> </td>
        <td> <?=$query_result->name?> </td>
        <td> <?=$query_result->enroll_id?> </td>

        <td>
           <input type="checkbox" name="crs[]" value="<?=$query_result->id?>" id="<?=$query_result->id?>"><label for="<?=$query_result->id?>"> </label> 
           <!-- <input type="checkbox" name="crs[]" value="love" id="<?=$query_result->id?>"> -->
        </td>
      </tr>

    <?php
    endforeach;
    ?>

  </table>
<?php //Activeform::end() ?>
</div>
