<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MluRoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MLU Role';
/*$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="mlu-role-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php

if ((Yii::$app->user->can('administrator')) || (Yii::$app->user->can('system admin'))) {
?>
    <p>
        <?= Html::a('Create MLU Role', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php
}
if (Yii::$app->user->can('administrator')) {

?>
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
