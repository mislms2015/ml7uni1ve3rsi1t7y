<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MluRegion */

$this->title = $model->full_name;
/*$this->params['breadcrumbs'][] = ['label' => 'Mlu Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="mlu-region-view">

    <h3><?= Html::encode($this->title) ?></h3>

<?php
if (Yii::$app->user->can('administrator')) {
?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'short_name',
            'full_name',
        ],
    ]) ?>

</div>
