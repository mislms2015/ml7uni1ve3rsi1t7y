<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserProfile */

$this->title = 'Update Profile: ' . $model->firstname;
/*$this->params['breadcrumbs'][] = ['label' => 'User Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';*/
?>
<div class="user-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <br />

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
