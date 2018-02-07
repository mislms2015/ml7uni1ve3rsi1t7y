<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\FontawesomeAsset;
FontawesomeAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MluManualAssessmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
Yii::$app->session['training_id'] = $_GET['id'];
$this->title = $title;
?>
<h5>
    <?php //echo 'Sample value: ' .$sample_user_id. ' ' .$sample_region. ' ' .$counter?>
</h5>

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
<h5><i><?=$facilitator?></i></h5>
<h5><i><?=$date?></i></h5>

<div class="mlu-manual-assessment-index">

    <?php echo $this->render('_searchmanual', ['model' => $searchModel]); ?>

    <?php 
    if (Yii::$app->user->can('administrator') || Yii::$app->user->can('system admin')) {
        $action = '{view} {deletebutton} ';
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
            //'area',
                [
                'class' => 'yii\grid\ActionColumn',
                'template' => $action. ' {my_button}', 
                    'buttons' => [
                    'my_button' => function ($url, $model, $key)
                        {
                            return Html::a('<span class="fa fa-file-pdf-o" style="color: #ce0c0c">', ['mlu-manual-assessment/individualcert', 'id'=>$model->id], ['target' => '_blank', 'class'=>'', 'title' => 'Training Certificate', 'style' => 'height: 30px;']);
                        },
                    'deletebutton' => function ($url, $model, $key)
                        {
                            return Html::a('<span class="fa fa-trash-o" style="">', ['mlu-manual-assessment/deletexaminee', 'id'=>$model->id], ['class'=>'', 'title' => 'Delete', 'style' => 'height: 50px;', 'data' => ['confirm' => 'Are you sure you want to delete this item?']]);
                        },
                    ],

                ],
        ]
    ]);  ?>
</div>
