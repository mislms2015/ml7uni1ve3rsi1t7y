<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\FontawesomeAsset;
FontawesomeAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MluManualAssessmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
Yii::$app->session['course_id'] = $_GET['id'];
$this->title = $title;
?>

<h3><?= Html::encode($this->title) ?></h3>

<div class="mlu-user-enrollee-index">

    <?php echo $this->render('_searchmanual', ['model' => $searchModel]); ?>

    <?php  echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
        //    ['class' => 'yii\grid\SerialColumn'],


            //'course_id',
            //'name',
            'id_number',
            'fname',
            'lname',
            [
                'attribute' => 'name',
                'value' => 'course.name',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {my_button}', 
                    'buttons' => [
                    'my_button' => function ($url, $model, $key)
                        {
                            return Html::a('<span class="fa fa-file-pdf-o" style="color: #ce0c0c">', ['mlu-course/synccert', 'id'=>$model->id], ['target' => '_blank', 'class'=>'', 'title' => 'Training Certificate', 'style' => 'height: 30px;']);
                        },
                    ]

            ],
        ]
    ]);  ?>
</div>
