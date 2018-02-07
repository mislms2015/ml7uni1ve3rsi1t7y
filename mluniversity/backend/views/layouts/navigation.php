<?php
use backend\models\MluRegion;
use backend\models\MluRole;

use backend\assets\FontawesomeAsset;
FontawesomeAsset::register($this);
?>

<div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <?php // echo $this->render('//site/index'); // add this to use as background ?>
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
</div>

<nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="/mluniversity/dashboard/">ML University</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <!-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> -->
                    <!-- #END# Call Search -->
                    <!-- Notifications -->

        <!-- *********************************************************************************************-->

                    <!-- RBAC -->
<?php
if (Yii::$app->user->can('administrator')) {
?>
                    <li class="dropdown" title="RBAC">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <!-- <i class="material-icons">account_circle</i> -->
                            <i class="fa fa-database" style="font-size:20px;"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">RBAC</li>
                            <li class="body">
                                <ul class="menu">
                                    <li title="Route">
                                        <a href="/mluniversity/dashboard/admin/route">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Route</h4>
                                            </div>
                                        </a>
                                    </li>
                                    <li title="Role">
                                        <a href="/mluniversity/dashboard/admin/role">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">vpn_key</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Role</h4>
                                            </div>
                                        </a>
                                    </li>
                                    <li title="Assignment">
                                        <a href="/mluniversity/dashboard/admin/assignment">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">recent_actors</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Assignment</h4>
                                            </div>
                                        </a>
                                    </li>
                                    <li></li>
                                </ul>
                            </li>
                            <li class="footer" title="RBAC">
                                <a href="/mluniversity/dashboard/admin/role">View All Roles</a>
                            </li>
                        </ul>
                    </li>
<?php } ?>
                    <!-- #END# RBAC -->

<?php
if (Yii::$app->user->can('administrator') || Yii::$app->user->can('system admin')) {
?>
                    <!-- ACCOUNT -->
                    <li class="dropdown" title="Account">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">account_circle</i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">USER ACCOUNT</li>
                            <li class="body">
                                <ul class="menu">
                                    <li title="User list">
                                        <a href="/mluniversity/dashboard/user">
                                            <div class="icon-circle bg-green">
                                                <i class="material-icons">account_box</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>User List</h4>
                                            </div>
                                        </a>
                                    </li>
                                    <li title="Add user">
                                        <a href="/mluniversity/dashboard/user/signme">
                                            <div class="icon-circle bg-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Add User</h4>
                                            </div>
                                        </a>
                                    </li>
                                    <li></li>
                                </ul>
                            </li>
                            <li class="footer" title="View all user">
                                <a href="/mluniversity/dashboard/user">View All Users</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# ACCOUNT -->

                    <!-- ROLE -->
                    <li class="dropdown" title="Role">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">transfer_within_a_station</i>
                            <!-- <span class="label-count">9</span> -->
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">ROLE</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <?php
$role_list = MluRole::find()->all();
foreach($role_list as $role_list_result):
?>
                                    <li title='<?=ucwords($role_list_result->full_name)?>'>
                                        <a href="/mluniversity/dashboard/mlu-role/view?id=<?=$role_list_result->id?>">
                                            <div class="icon-circle bg-red">
                                                <!-- <i class="material-icons">person_add</i> -->
                                                <h5> <?=$role_list_result->short_name?> </h5>
                                            </div>
                                            <div class="menu-info">
                                                <h4><?=$role_list_result->full_name?></h4>
                                                <!-- <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p> -->
                                            </div>
                                        </a>
                                    </li>
<?php
endforeach;
?>
                                  <li></li>
                                </ul>
                            </li>
                            <li class="footer" title="View all role">
                                <a href="/mluniversity/dashboard/mlu-role">View All Roles</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# ROLE -->

                    <!-- REGIONS -->
                    <li class="dropdown" title="Region">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">widgets</i>
                            <!-- <span class="label-count">7</span> -->
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">REGIONS</li>
                            <li class="body">
                                <ul class="menu">
<?php
$region_list = MluRegion::find()->all();
foreach($region_list as $region_list_result):
?>
                                    <li title='<?=ucwords($region_list_result->full_name). " Region"?>'>
                                        <a href="/mluniversity/dashboard/mlu-region/view?id=<?=$region_list_result->id?>">
                                            <div class="icon-circle bg-cyan">
                                                <!-- <i class="material-icons">person_add</i> -->
                                                <h5> <?=$region_list_result->short_name?> </h5>
                                            </div>
                                            <div class="menu-info">
                                                <h4><?=$region_list_result->full_name?></h4>
                                                <!-- <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p> -->
                                            </div>
                                        </a>
                                    </li>
<?php
endforeach;
?>
                                    <li></li>
                                </ul>
                            </li>
                            <li class="footer" title="View all region">
                                <a href="/mluniversity/dashboard/mlu-region">View All Regions</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# REGIONS -->

<?php } ?>
        <!-- ********************************************************************************************* -->

<?php
if(basename($_SERVER['REQUEST_URI'], '?'.$_SERVER['QUERY_STRING']) == 'manualenrollee') {
  //Hide
  echo '<li class="pull-right" title="Report"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>';  
} /*
else{
    //echo basename(__FILE__); 
    echo basename($_SERVER['PHP_SELF']);
}*/
?>
                    <!-- <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li> -->

                </ul>
                
            </div>
        </div>
</nav>
