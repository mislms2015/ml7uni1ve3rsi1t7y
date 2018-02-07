<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MluManualAssessmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manual Enrollee List';
?>

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('deleteexaminee')): ?>
  <div class="alert alert-danger alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-close"></i>Attendee Delete!</h4>
  <h5><?= Yii::$app->session->getFlash('deleteexaminee') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<h3><?= Html::encode($this->title) ?></h3>

<div class="mlu-manual-assessment-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php  

    if (Yii::$app->user->can('administrator') || Yii::$app->user->can('system admin')) {
        $action = '{view} {delete} ';
    } else {
        $action = '{view} ';
    }

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
        //    ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'training_id',
            'id_number',
            'fname',
            'lname',
            [
                'attribute' => 'training_id',
                'value' => 'training.name',
            ],
            'region',
            'area',
            /*[
                'attribute' => 'area',
                'value' => 'area',
                'format' => 'mb_strtoupper(area)'
            ],*/
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $action. ' {my_button}', 
                    'buttons' => [
                    'my_button' => function ($url, $model, $key)
                        {
                            return Html::a('<span class="fa fa-file-pdf-o" style="color: #ce0c0c">', ['mlu-manual-assessment/individualcert', 'id'=>$model->id], ['target' => '_blank', 'class'=>'', 'title' => 'Training Certificate', 'style' => 'height: 30px;']);
                        },
                    ]

            ],
        ],
    ]);  ?>
</div>
