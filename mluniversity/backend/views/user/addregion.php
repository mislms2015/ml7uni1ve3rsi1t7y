<?php

use backend\models\MluRoleAssignment;

use yii\bootstrap\Activeform;
use yii\helpers\Html;

$this->title = $username. ' » ' .$role_name;

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


<h3> <?= Html::encode($this->title) ?> </h3>
<br />
<br />

<div class="">
<?php Activeform::begin() ?>

<?=Html::submitButton('<i class"glyphicon glyphicon-ok"> </i> Assign Region/s', ['id' => 'update', 'class' => 'btn btn-primary'])?>

  <table class="table table-bordered table-condensed">
    <tr style="color: #337ab7;">
      <th> 
        <input type="checkbox" onclick="checkall(this)" id="select_all"> <label for="select_all"></label> 
      </th>
      <!-- <th> Short Name </th> -->
      <th> Name </th>
    </tr>

    <?php
    foreach($region_list as $query_result):
      $role_assign_check = MluRoleAssignment::find()->where(['assign_id' => $role_user])
                                                    ->andWhere(['region_id' => $query_result->id])
                                                    ->count();

      if ($role_assign_check == 0){
    ?>

      <tr>
        <td>
           <input type="checkbox" name="crs[]" value="<?=$query_result->id?>" id="<?=$query_result->id?>"><label for="<?=$query_result->id?>"> </label> 
           <!-- <input type="checkbox" name="crs[]" value="love" id="<?=$query_result->id?>"> -->
        </td>
        <!-- <td> <label for="<?=$query_result->id?>" style="cursor: pointer;"> <?=$query_result->short_name?> </label> </td> -->
        <td> <label for="<?=$query_result->id?>" style="cursor: pointer;"> <?=$query_result->full_name?> </label> </td>
      </tr>

    <?php
    }
    endforeach;
    ?>

  </table>

<?php Activeform::end() ?>
</div>


<?php
/*$script = <<< JS
$(document).ready(function(){
    ELEMENT.classList.remove("dropdown-menu open");
    ELEMENT.classList.remove("btn dropdown-toggle btn-default"); 
});

JS;
$this->registerJs($script);*/

?>
