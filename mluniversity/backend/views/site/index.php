<?php
/*use yii\helpers\Html;
use yii\grid\GridView;*/

use backend\models\User;

$asset = backend\assets\homeAsset::register($this);
$baseUrl = $asset->baseUrl;

$this->title = 'ML University';
?>

<?php //echo $this->render('_search', ['model' => $searchModel]); ?>

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('synccourses')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Sync Courses!</h4>
  <h5><?= Yii::$app->session->getFlash('synccourses') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('syncenrollee')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Sync Enrollee!</h4>
  <h5><?= Yii::$app->session->getFlash('syncenrollee') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('uploadmanual')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Upload Training!</h4>
  <h5><?= Yii::$app->session->getFlash('uploadmanual') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('uploadmanualfail')): ?>
  <div class="alert alert-warning alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-close"></i>Upload Training!</h4>
  <h5><?= Yii::$app->session->getFlash('uploadmanualfail') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('signme')): 

$date_time_temp = date('Y-m-d h:i:s', time());
$date_time_final = strtotime($date_time_temp);

$find_user = User::find()->where(['username' => Yii::$app->session['new_username']])->one();
Yii::$app->db->createCommand()->insert('auth_assignment', ['item_name' => 'system user', 'user_id' => $find_user['id'], 'created_at' => $date_time_final])->execute();

?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Register Account!</h4>
  <h5><?= Yii::$app->session->getFlash('signme') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('uploaderrorextension')): ?>
  <div class="alert alert-warning alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-close"></i>Upload Training!</h4>
  <h5><?= Yii::$app->session->getFlash('uploaderrorextension') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<!-- flash message -->
<?php if (Yii::$app->session->hasFlash('uploadinvalidform')): ?>
  <div class="alert alert-warning alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-close"></i>Upload Training!</h4>
  <h5><?= Yii::$app->session->getFlash('uploadinvalidform') ?></h5>
  </div>
<?php endif; ?>
<!-- flash message -->

<div class="site-index">

    <!-- <section id="home" class="home">
            <div class="home_overlay"> -->
                <!--111 <div class="container"> -->
                    <!-- <div class="row">
                        <div class="main_slider_area">
                            <div class="slider">
                                <div class="single_slider">
                                    <h3>ML University</h3>
                                    <p>Discover  -  Build  -  Challenge</p>
                                    <div class="single_slider_img_icon">
                                        <img src="<?=$baseUrl?>/assets/images/ii1.png" alt="" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> -->
                <!--111 </div> -->
            <!-- </div>
        </section> -->
</div>

<?php  /*echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'training_id',
            'fname',
            'lname',
            'id_number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);*/  ?>