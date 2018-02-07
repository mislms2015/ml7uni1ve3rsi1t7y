<?php

namespace backend\controllers;

use Yii;
use backend\models\MluCourse;
use backend\models\MluQuiz;
use backend\models\MluManualTraining;
use backend\models\MluManualAssessment;
use backend\models\MluRegion;
use backend\models\MluRoleUser;
use backend\models\UserProfile;
use backend\models\MluRoleAssignment;
use yii\helpers\Html;

//use backend\assets\SmallClickAsset;
//SmallClickAsset::register($this);

$username = Yii::$app->user->identity->username;
$user_email = Yii::$app->user->identity->email;

if(basename($_SERVER['REQUEST_URI'], '?'.$_SERVER['QUERY_STRING']) == 'manualenrollee') {
  $training_id = $_GET['id'];
  //SELECT DISTINCT id, training_id, fname, lname, id_number, region, area FROM mlu_manual_assessment where training_id=7
  //$region_training = MluManualAssessment::find()->where(['training_id' => $training_id])->select(['id', 'training_id', 'fname', 'lname', 'id_number', 'region', 'area'])->distinct()->all();
  $region_training = MluManualAssessment::find()
                    ->where(['training_id' => $training_id])
                    ->select(['region'])
                    ->distinct()
                    ->orderBy(['region' => SORT_ASC])
                    ->all();
}
?>

<section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <!-- <div > --> <div class="image"> <!-- use this div for circle image -->
                    <!-- <img src="<?=$baseUrl?>/images/mlu.png" width="48" height="48" alt="User" /> -->
                    <!-- <img src="<?=Yii::$app->session['dp']?>21-DP.png" onerror="this.src='<?=Yii::$app->session['dp']?>mlu.png'" width="48" height="48" alt="User" /> -->
<?php
$check_DP = UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->count();
    if ($check_DP > 0){
        $get_DP = UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
    }
?>
                    <img src="<?=$get_DP->avatar_base_url.$get_DP->avatar_path?>" onerror="this.src='<?=Yii::$app->session['dp']?>mlu.png'" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
<?php
$check_profile_name = UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->count();
    if ($check_profile_name > 0){
        $get_profile_name = UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
        if ($get_profile_name->firstname == '-'){
            $profile_name = $username;
        } else {
            $profile_name = ucwords($get_profile_name->firstname). ' ' .ucwords($get_profile_name->lastname);
        }
    }
?>
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$profile_name?></div>
                    <div class="email"><?=$user_email?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
<?php
$check_profile_id = UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->count();
    if ($check_profile_id > 0){
        $get_profile_id = UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
    }
?>
                            <li><?php echo Html::a('<i class="material-icons">person</i>Profile', ['/user-profile/view', 'id' => $get_profile_id->id]);?></li>
                            <li><?php echo Html::a('<i class="material-icons">vpn_key</i>Change Password', ['/user/changepassword']);?></li>
                            <!-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li> -->
                            <!-- <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li> -->
                            <!-- <li role="seperator" class="divider"></li> -->
                            <!-- <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li> -->
                            <li><?php echo Html::a('<i class="material-icons">input</i>Sign out', ['/site/logout'], ['data'=>['method'=>'post'], 'class'=>'']);?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="/mluniversity/dashboard/">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>

                    <?php
                    if (Yii::$app->user->can('administrator') || Yii::$app->user->can('system admin')) {
                    ?>
<?php
/*
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">cloud_download</i>
                            <span>Sync</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <?php echo Html::a('<i class="material-icons">local_library</i> <span>MLU Courses</span>', ['/mlu-course/synccourse'], ['data'=>['confirm' => 'Are you sure you want to sync courses?'], 'class'=>'']);?>
                            </li>
                            <li>
                                <?php echo Html::a('<i class="material-icons">group</i> <span>MLU Enrollee</span>', ['/mlu-course/syncenrollee'], ['data'=>['confirm' => 'Are you sure you want to sync enrollees?'], 'class'=>'']);?>
                            </li>
                            
                        </ul>
                    </li>
*/
?>
                    <?php } ?>
<?php
/*
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons"><!-- trending_up -->library_books</i>
                            <span>MLU Courses</span>
                        </a>
*/
?>
                        <ul class="ml-menu">
<?php
$courses = MluCourse::find()->all();

foreach($courses as $courses_result):

    $quiz_count = MluQuiz::find()->where(['course_id' => $courses_result['course_id']])->count();
    if ($quiz_count > 0){
        $quiz = MluQuiz::find()->where(['course_id' => $courses_result['course_id']])->all();
?>                         
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <i class="material-icons">markunread_mailbox</i>
                                    <span><?=ucwords($courses_result['name'])?></span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                    <?php echo Html::a('<i class="material-icons">supervisor_account</i> <span>Enrollee</span>', ['/mlu-user-enrollee/enrollee/', 'id'=>$courses_result['course_id']]);?>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle">
                                            <i class="material-icons">assessment</i>
                                            <span>Assessment</span>
                                        </a>
                                        <ul class="ml-menu">
<?php
foreach($quiz as $quiz_result):
?>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <i class="material-icons">create</i>
                                                    <span><?=ucwords($quiz_result['name'])?></span>
                                                </a>
                                            </li>
<?php
endforeach;
?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

<?php
    } else{
?>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <i class="material-icons">markunread_mailbox</i>
                                    <span><?=ucwords($courses_result['name'])?></span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                    <?php echo Html::a('<i class="material-icons">supervisor_account</i> <span>Enrollee</span>', ['/mlu-user-enrollee/enrollee/', 'id'=>$courses_result['course_id']]);?>
                                    </li>
                                </ul>
                            </li>
<?php     
    }
endforeach;
?>
                        </ul>
                    </li>

                    <!-- <li>
                        <a href="/mluniversity/dashboard/">
                            <i class="material-icons">create</i>
                            <span>MLU Manual Assessment</span>
                        </a>
                        <?php //echo Html::a('<i class="material-icons">create</i> <span>MLU Manual Assessment</span>', ['/mlu-manual-assessment/create/']);?>
                    </li> -->

                    <!-- ******************************************************************** -->
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">description</i>
                            <span>Forms</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <?php echo Html::a('<i class="material-icons">assignment_returned</i> <span>Default</span>', ['/mlu-manual-assessment/downloadform/']);?>
                            </li>
                            <li>
                                <?php echo Html::a('<i class="material-icons">assignment_returned</i> <span>Form for Gold</span>', ['/mlu-manual-assessment/downloadformgold/']);?>
                            </li>
                            <li>
                                <?php echo Html::a('<i class="material-icons">assignment_returned</i> <span>Form for Diamond</span>', ['/mlu-manual-assessment/downloadformdiamond/']);?>
                            </li>
                        </ul>
                    </li>
                    <!-- ******************************************************************** -->

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">border_color</i>
                            <span>MLU Classroom Training</span>
                        </a>
                        <ul class="ml-menu">
                            <!-- download here before -->
<?php
if (Yii::$app->user->can('system user')){
?>
                            <li>
                                <?php echo Html::a('<i class="material-icons">line_weight</i> <span>Classroom Training List</span>', ['/mlu-manual-assessment/list']);?>
                            </li>
<?php
}
if (Yii::$app->user->can('administrator') || Yii::$app->user->can('system admin')) {
?>
                            <li>
                                <?php echo Html::a('<i class="material-icons">backup</i> <span>Upload Training</span>', ['/mlu-manual-assessment/create/']);?>
                            </li>

                            <!-- <li>
                                <?php //echo Html::a('<i class="material-icons">line_weight</i> <span>Classroom Training List</span>', ['/mlu-manual-assessment/list']);?>
                            </li> -->

                            <li>
                                <?php echo Html::a('<i class="material-icons">find_in_page</i> <span>Search</span>', ['/mlu-manual-assessment/']);?>
                            </li>
<?php } ?>

<?php
$manual_courses = MluManualTraining::find()->all();
//markunread_mailbox
foreach($manual_courses as $manual_course_list):
    $course = ucwords($manual_course_list['name']);
?>
                            <li class="header">
                                <?php echo Html::a("<i class='material-icons'>markunread_mailbox</i> <span>$course</span>", ['/mlu-manual-assessment/manualenrollee', 'id'=>$manual_course_list['id']]);?>
                            </li>
<?php
endforeach;
?>
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; <?=date('Y')?> <a href="/mluniversity/dashboard/">ML University</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.5.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>

        <!-- *************************************************************************************** -->

        <!-- ***************************** right sidebar ******************************** -->
         <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#region" data-toggle="tab">REGION</a></li>
                <li role="presentation"><a href="#area" data-toggle="tab">AREA</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="region">
                    <ul class="demo-choose-skin">
<?php
if(basename($_SERVER['REQUEST_URI'], '?'.$_SERVER['QUERY_STRING']) == 'manualenrollee') {
    if (Yii::$app->user->can('administrator') || Yii::$app->user->can('system admin')){
?>
                        <li data-theme="" class="active">
                            <div class=""></div>
                            <span><?php echo "<i class='material-icons'>view_headline</i>" .Html::a("<span>All Region</span>", ['mlu-manual-assessment/trainingreport', 'id' => $training_id], ['target' => '_blank'])?></span>
                        </li>
<?php
    }
}
?>
<?php
//Html::a('<span class="material-icons">view_headline </span>', ['mlu-manual-assessment/trainingreport', 'id' => $id], ['target' => '_blank', 'class'=>'btn btn-warning', 'title' => 'Report', 'style' => 'height: 30px;']);

if(basename($_SERVER['REQUEST_URI'], '?'.$_SERVER['QUERY_STRING']) == 'manualenrollee') {
    if (Yii::$app->user->can('administrator') || Yii::$app->user->can('system admin')){
        foreach($region_training as $region_training_result):
            $training_title = ucwords($region_training_result['region']);
?>
                        <!-- this is the original link -->
                        <li data-theme="">
                            <div class=""></div>
                            <span><?php // echo ucwords($region_training_result['region'])?></span>
                            <?php echo "<i class='material-icons'>account_balance_wallet</i>" .Html::a("<span>$training_title</span>", ['/mlu-manual-assessment/regionreport', 'id' => $training_id, 'rname' => $region_training_result['region']], ['target' => '_blank']);?>
                        </li>
<?php
        endforeach;
    } else{
        /* here for the user */
        $region_array = [];
        $user_id = Yii::$app->user->identity->id;
          $count_role_user = MluRoleUser::find()->where(['user_id' => $user_id])->count();
          if ($count_role_user > 0){
            $check_role_user = MluRoleUser::find()->where(['user_id' => $user_id])->all();
              foreach($check_role_user as $check_role_user_result):
                $count_role_assign = MluRoleAssignment::find()->where(['assign_id' => $check_role_user_result->id])->count();
                if ($count_role_assign > 0){
                  $role_assign = MluRoleAssignment::find()->where(['assign_id' => $check_role_user_result->id])->all();
                  foreach($role_assign as $role_assign_result):
                    $region_assign = MluRegion::find()->where(['id' => $role_assign_result->region_id])->one();
                    $region_name = ucwords($region_assign->full_name);
                    $region_counter = 0;
                        for($x = 0; $x < sizeof($region_array); $x++){
                            if ($region_array[$x] == $region_assign->full_name){
                                $region_counter = $region_counter + 1;
                            }
                        }
                            if ($region_counter == 0){
?>
                                <li data-theme="">
                                    <div class=""></div>
                                    <span><?php // echo ucwords($region_training_result['region'])?></span>
                                    <?php echo "<i class='material-icons'>account_balance_wallet</i>" .Html::a("<span>$region_name</span>", ['/mlu-manual-assessment/regionreport', 'id' => $training_id, 'rname' => $region_assign->full_name], ['target' => '_blank']);?>
                                </li>
<?php
                            }
                    $region_array[] = $region_assign->full_name;
                  endforeach;
                }
              endforeach;
          }
?>
        
<?php
        /* here for the user */
    }
}
?>
                        <!-- <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li> -->                        
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="area">
                    <div class="demo-settings">
                        <ul class="demo-choose-skin">
<?php
if(basename($_SERVER['REQUEST_URI'], '?'.$_SERVER['QUERY_STRING']) == 'manualenrollee') {
    if (Yii::$app->user->can('administrator') || Yii::$app->user->can('system admin')){
        foreach($region_training as $region_area_training_result):
            $training_title = ucwords($region_area_training_result['region']);
            $region_area_training = MluManualAssessment::find()
                            ->where(['training_id' => $training_id])
                            ->andWhere(['region' => $region_area_training_result['region']])
                            ->select(['area'])
                            ->distinct()
                            ->orderBy(['area' => SORT_ASC])
                            ->all();
?>                        
                        <p><?=$training_title?></p>
<?php
            foreach($region_area_training as $region_area_result):
                $area = ucwords($region_area_result['area']);
?>
                        <li data-theme="" class="">
                            <div class=""></div>
                            <span><?php echo "<i class='material-icons'>layers</i>" .Html::a("<span>$area</span>", ['/mlu-manual-assessment/areareport', 'id' => $training_id, 'rname' => $region_area_training_result['region'], 'aname' => $region_area_result['area']], ['target' => '_blank'])?></span>
                        </li>
                        
<?php
            endforeach;

        endforeach;
    } else{
        /* here for the user */
        $region_array = [];
        $user_id = Yii::$app->user->identity->id;
          $count_role_user = MluRoleUser::find()->where(['user_id' => $user_id])->count();
          if ($count_role_user > 0){
            $check_role_user = MluRoleUser::find()->where(['user_id' => $user_id])->all();
              foreach($check_role_user as $check_role_user_result):
                $count_role_assign = MluRoleAssignment::find()->where(['assign_id' => $check_role_user_result->id])->count();
                if ($count_role_assign > 0){
                  $role_assign = MluRoleAssignment::find()->where(['assign_id' => $check_role_user_result->id])->all();
                  foreach($role_assign as $role_assign_result):
                    $region_assign = MluRegion::find()->where(['id' => $role_assign_result->region_id])->one();
                    $region_name = ucwords($region_assign->full_name);
                    $region_counter = 0;
                        for($x = 0; $x < sizeof($region_array); $x++){
                            if ($region_array[$x] == $region_assign->full_name){
                                $region_counter = $region_counter + 1;
                            }
                        }
                            if ($region_counter == 0){

                                $region_area_training = MluManualAssessment::find()
                                                        ->where(['training_id' => $training_id])
                                                        ->andWhere(['region' => $region_assign->full_name])
                                                        ->select(['area'])
                                                        ->distinct()
                                                        ->orderBy(['area' => SORT_ASC])
                                                        ->all();
?>
                                    <p><?= $region_assign->full_name?></p>
<?php
                                foreach($region_area_training as $region_area_training_result):
                                    $area = ucwords($region_area_training_result['area']);
?>
                                    <li data-theme="" class="">
                                        <div class=""></div>
                                        <span><?php echo "<i class='material-icons'>layers</i>" .Html::a("<span>$area</span>", ['/mlu-manual-assessment/areareport', 'id' => $training_id, 'rname' => $region_assign->full_name, 'aname' => $region_area_training_result['area']], ['target' => '_blank'])?></span>
                                    </li>
<?php
                                endforeach;
?>

<?php
                            }
                    $region_array[] = $region_assign->full_name;
                  endforeach;
                }
              endforeach;
          }

        /* here for the user */
    }
}

?>
                    </div>
                </ul>
                </div>
            </div>
        </aside>
        <!-- ***************************** right sidebar ******************************** -->


    </section>