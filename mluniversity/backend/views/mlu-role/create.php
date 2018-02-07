<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MluRole */

$this->title = 'Create MLU Role';
/*$this->params['breadcrumbs'][] = ['label' => 'Mlu Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="mlu-role-create">

    <h3><?= Html::encode($this->title) ?></h3>
    <br />

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
