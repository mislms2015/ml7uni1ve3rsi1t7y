<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\tableAsset;
use yii\widgets\LinkPager;
tableAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MluCourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;

//$id = $_GET['id'];
?>

<?php

$totalCount = $pagination->totalCount;
$begin = $pagination->getPage() * $pagination->pageSize + 1;
$begin_end = $pagination->getPage() + 1;
$count = $pagination->pageCount;
//$end = $begin + $count - 1;
$end = $begin_end * $perpage;
if ($begin > $end) {
    $begin = $end;
}
/*****************************************/
//$number_of_pages = ceil($totalCount/$perpage);
if($count == $begin_end){
  $end = $totalCount;
  //echo $begin_end. '<br />';
}
/*****************************************/

$page = $pagination->getPage() + 1;
$pageCount = $pagination->pageCount;
?>

<div class="mlu-course-index">
    <h3>
      <?= Html::encode($this->title) ?>
    </h3>
    <br />

<?php echo $this->render('_searchmanuallist', ['model' => $searchModel]); ?>

<?=Yii::t('yii', 'Showing <b>{begin, number} to {end, number}</b> of <b>{totalCount, number}</b> {totalCount, plural, one{item} other{items}}.', [
    'begin' => $begin,
    'end' => $end,
    'count' => $count,
    'totalCount' => $totalCount,
    'page' => $page,
    'pageCount' => $pageCount,
])?>

  <div class="wrapper">
  
    <div class="table">
      
      <div class="row header">
        <div class="cell">
          ID Number
        </div>
        <div class="cell">
          Name
        </div>
        <div class="cell">
          Region
        </div>
        <div class="cell" style="text-align: center;">
          Area
        </div>
        <div class="cell" style="text-align: center;">
          Action
        </div>
      </div>

<?php
foreach($enrollee as $enrollee_result):
?>
      <div class="row">
        <div class="cell">
          <?=$enrollee_result['id_number']?>
        </div>
        <div class="cell">
          <?=ucwords($enrollee_result['fname']). ' ' .ucwords($enrollee_result['lname'])?>
        </div>
        <div class="cell">
          <?=ucwords($enrollee_result['region'])?>
        </div>
        <div class="cell" style="text-align: center;">
          <?=ucwords($enrollee_result['area'])?>
        </div>
        <div class="cell" style="text-align: center;">
          <!-- attended training -->
          <?php // echo Html::a('Training Certificate', ['mlu-manual-assessment/individualcert', 'id'=>$enrollee_result['id']], ['target' => '_blank', 'class'=>'btn btn-primary']) ?>
          <?php // echo Html::a('<span class="material-icons">picture_as_pdf </span>', ['mlu-manual-assessment/individualcert', 'id'=>$enrollee_result['id']], ['target' => '_blank', 'class'=>'btn btn-primary', 'title' => 'Training Certificate', 'style' => 'height: 30px;']) ?>

          <?php // echo Html::a('Training Attended', ['mlu-manual-assessment/attendedcert', 'id'=>$enrollee_result['id']], ['target' => '_blank', 'class'=>'btn btn-success', 'title' => 'Training Attended']) ?>
          <?= Html::a('<span class="material-icons">font_download picture_as_pdf </span>', ['mlu-manual-assessment/attendedcert', 'id'=>$enrollee_result['id']], ['target' => '_blank', 'class'=>'btn btn-success', 'title' => 'Training Attended', 'style' => 'height: 30px;']) ?>
        </div>
      </div>
<?php
endforeach;
?>
      
    </div>
  
  </div>

</div>

<!-- ******************* -->
<?= LinkPager::widget(['pagination' => $pagination]) ?>
<!-- ******************* -->
