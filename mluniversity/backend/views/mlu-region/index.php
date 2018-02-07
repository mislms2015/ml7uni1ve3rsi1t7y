<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MluRegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MLU Region';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mlu-region-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php
if (Yii::$app->user->can('administrator')) {
?>
    <p>
        <?= Html::a('Create MLU Region', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'short_name',
            'full_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

<?php } else { ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'short_name',
            'full_name',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>


<?php } ?>

</div>
