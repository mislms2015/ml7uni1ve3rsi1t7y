<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MluManualTrainingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mlu Manual Trainings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mlu-manual-training-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mlu Manual Training', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'date_conduct',
            'trainor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
