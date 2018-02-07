<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MluUserEnrolleeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mlu User Enrollees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mlu-user-enrollee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mlu User Enrollee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'id_number',
            'username',
            'enrollment_id',
            // 'course_id',
            // 'fname',
            // 'lname',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
