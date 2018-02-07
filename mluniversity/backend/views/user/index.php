<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
/*$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="user-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    /*if (Yii::$app->user->can('administrator') || Yii::$app->user->can('system admin')){
        $template = '{view} {update} {delete}';
    } else{
        $template = '';
    }*/

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
        //    ['class' => 'yii\grid\SerialColumn'],

        //    'id',
            'username',
        //    'auth_key',
        //    'password_hash',
        //    'password_reset_token',
            // 'email:email',
            // 'status',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>
