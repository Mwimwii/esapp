<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use backend\models\User;
use backend\models\AwpbTemplate;

AppAsset::register($this);
$session = Yii::$app->session;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= Url::to('@web/img/logo.png') ?>">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed  sidebar-collapse text-sm">
        <?php $this->beginBody() ?>
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-green navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars text-white"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.agriculture.gov.zm/" target="blank" class="nav-link text-white">Ministry of Agriculture Home</a>
                    </li>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">

                        <a href="#" class="dropdown-toggle text-white" data-toggle="dropdown">
                            <img src="<?= Url::to('@web/img/icon.png') ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"> <?= $session['user'] ?> </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" style="background-color: #28a745;">
                            <!-- User image -->
                            <li class="user-header text-white">
                                <img src="<?= Url::to('@web/img/icon.png') ?>" class="img-circle" alt="User Image">
                                <p>
                                    <small> <?= $session['user'] ?> - <?= $session['role'] ?> </small>
                                    <small>Member since <?= date('M Y', $session['created_at']) ?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div>
                                    <?= Html::a('<i class="fas fa-user-circle"></i> My Profile', ['users/profile', 'id' => Yii::$app->user->identity->id], ['class' => "float-left btn btn-outline-success btn-recreate btn-sm"]); ?>

                                    <a class="float-right btn btn-outline-success btn-recreate btn-sm" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                </div>

                            </li>

                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-light-green elevation-3">
                <!-- Brand Logo -->
                <a style="background-color: #28a745" class="brand-link" href="https://www.agriculture.gov.zm/" target="blank">
                    <?=
                    Html::img('@web/img/coa.png', [
                        "class" => "brand-image",
                        'style' => 'opacity: .9'
                    ]);
                    ?>
                    <span class="brand-text text-white font-weight-light">E-SAPP MIS</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info text-black-50">
                            NAVIGATION
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                     with font-awesome or any other icon font library -->
                            <?php
                            echo ' <li class="nav-item">';
                            if (Yii::$app->controller->id == "home") {
                                echo Html::a(' <i class="fas fa-home nav-icon"></i> 
                                    <p>Dashboard</p>', ['/home/home'], ["class" => "nav-link active"]);
                            } else {
                                echo Html::a(' <i class="nav-icon fas fa-home"></i> '
                                        . '<p>Dashboard</p>', ['/home/home'], ["class" => "nav-link"]);
                            }
                            echo '</li>';
                            ?>

                            <!-------------------------------USER MANAGEMENT STARTS----------------------->
                            <?php
                            if (
                                    User::userIsAllowedTo("Manage Users") || User::userIsAllowedTo("View Users") ||
                                    User::userIsAllowedTo("View profile") ||
                                    User::userIsAllowedTo("Manage Roles") || User::userIsAllowedTo("View Roles")
                            ) {
                                if (
                                        Yii::$app->controller->id == "users" ||
                                        Yii::$app->controller->id == "role"
                                ) {
                                    echo '<li class="nav-item has-treeview menu-open">'
                                    . ' <a href="#" class="nav-link active">';
                                } else {
                                    echo '<li class="nav-item has-treeview">'
                                    . '<a href="#" class="nav-link">';
                                }
                                ?>
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    User management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php
                                    if (User::userIsAllowedTo("View profile")) {
                                        echo '   <li class="nav-item">';
                                        if (
                                                Yii::$app->controller->id == "users" &&
                                                (Yii::$app->controller->action->id == "profile")
                                        ) {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>My Profile</p>', ['/users/profile', 'id' => Yii::$app->user->identity->id], ["class" => "nav-link active"]);
                                        } else {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>My Profile</p>', ['/users/profile', 'id' => Yii::$app->user->identity->id], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }

                                    if (User::userIsAllowedTo("Manage Roles") || User::userIsAllowedTo("View Roles")) {
                                        echo '   <li class="nav-item">';
                                        if (
                                                Yii::$app->controller->id == "role" &&
                                                (Yii::$app->controller->action->id == "index" ||
                                                Yii::$app->controller->action->id == "view" ||
                                                Yii::$app->controller->action->id == "create" ||
                                                Yii::$app->controller->action->id == "update")
                                        ) {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Roles</p>', ['/role/index'], ["class" => "nav-link active"]);
                                        } else {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Roles</p>', ['/role/index'], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }
                                    if (User::userIsAllowedTo("Manage Users") || User::userIsAllowedTo("View Users")) {
                                        echo '   <li class="nav-item">';
                                        if (
                                                Yii::$app->controller->id == "users" &&
                                                (Yii::$app->controller->action->id == "index" ||
                                                Yii::$app->controller->action->id == "view" ||
                                                Yii::$app->controller->action->id == "create" ||
                                                Yii::$app->controller->action->id == "update")
                                        ) {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Users</p>', ['users/index'], ["class" => "nav-link active"]);
                                        } else {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Users</p>', ['users/index'], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }
                                    ?>

                                </ul>
                                </li>
                            <?php } ?>
                            <!-------------------------------USER MANAGEMENT ENDS------------------------->


                            <!-------------------------------AWPB MANAGEMENT STARTS----------------------->
                            <?php
                            $user = User::findOne(['id' => Yii::$app->user->id]);

                            if (
                                    User::userIsAllowedTo("Manage components") ||
                                    User::userIsAllowedTo("View components") ||
                                    User::userIsAllowedTo("Manage AWPB templates") ||
                                    User::userIsAllowedTo("View AWPB templates") ||
                                    User::userIsAllowedTo("Manage programmes") ||
                                    User::userIsAllowedTo("View programmes") ||
                                    User::userIsAllowedTo("Manage AWPB activities") ||
                                    User::userIsAllowedTo("View AWPB activities") ||
                                    User::userIsAllowedTo("Setup AWPB") ||
                                    User::userIsAllowedTo("View AWPB") ||
                                    User::userIsAllowedTo("Manage PW AWPB") ||
                                    User::userIsAllowedTo('Manage AWPB')
                            // User::userIsAllowedTo("View Budget")
                            ) {

                                if (
                                        Yii::$app->controller->id == "awpb-component" ||
                                        Yii::$app->controller->id == "awpb-template" ||
                                        Yii::$app->controller->id == "awpb-programme" ||
                                        Yii::$app->controller->id == "awpb-activity" ||
                                        Yii::$app->controller->id == "awpb-budget" ||
                                        Yii::$app->controller->id == "awpb-input" ||
                                        Yii::$app->controller->id == "awpb-funder" ||
                                        Yii::$app->controller->id == "awpb-expense-category" ||
                                        Yii::$app->controller->id == "awpb-unit-of-measure"
                                ) {
                                    echo '<li class="nav-item has-treeview menu-open">'
                                    . ' <a href="#" class="nav-link active">';
                                } else {
                                    echo '<li class="nav-item has-treeview">'
                                    . '<a href="#" class="nav-link">';
                                }
                                ?>



                                <i class="nav-icon fas fa-money-check"></i>
                                <p>
                                    AWPB Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <?php
                                    if (User::userIsAllowedTo("Setup AWPB") || User::userIsAllowedTo("View AWPB")) {
                                        echo '   <li class="nav-item">';
                                        if (
                                                Yii::$app->controller->id == "awpb-template" &&
                                                (Yii::$app->controller->action->id == "index" ||
                                                Yii::$app->controller->action->id == "view" ||
                                                Yii::$app->controller->action->id == "create" ||
                                                Yii::$app->controller->action->id == "update")
                                        ) {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>AWPB Templates</p>', ['awpb-template/index'], ["class" => "nav-link active"]);
                                        } else {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>AWPB Templates</p>', ['awpb-template/index'], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }


                                    if (User::userIsAllowedTo("Manage AWPB") || User::userIsAllowedTo("Approve AWPB")) {
                                        echo '   <li class="nav-item">';
                                        $role = \common\models\Role::findOne(['id' => $user->role])->role;
                                        $page = "";
                                        $status = "";
                                        $id2 = "0";

                                        if (User::userIsAllowedTo("Manage AWPB") && ($user->district_id > 0 || $user->district_id != '')) {
                                            $page = "index";
                                            $status = \backend\models\AwpbBudget::STATUS_DRAFT;
                                            $id2 = $user->province_id;
                                        }
                                        if (User::userIsAllowedTo("Manage AWPB") && ($user->province_id > 0 || $user->province_id != '') && ($user->district_id == 0 || $user->district_id == '')) {
                                            $page = "mpc";
                                            $status = \backend\models\AwpbBudget::STATUS_SUBMITTED;
                                            $id2 = $user->province_id;
                                        }
                                        if (User::userIsAllowedTo("Manage AWPB") && ($user->province_id == 0 || $user->province_id == '')) {
                                            $page = "mp";
                                            $status = \backend\models\AwpbBudget::STATUS_REVIEWED;
                                        }
                                        if (User::userIsAllowedTo("Approve AWPB") && ($user->province_id == 0 || $user->province_id == '')) {
                                            $page = "mp";
                                            $status = \backend\models\AwpbBudget::STATUS_APPROVED;
                                        }


                                        if (
                                                Yii::$app->controller->id == "awpb-budget" &&
                                                (
                                                Yii::$app->controller->action->id == "index" ||
                                                Yii::$app->controller->action->id == "view" ||
                                                Yii::$app->controller->action->id == "create" ||
                                                Yii::$app->controller->action->id == "update" ||
                                                Yii::$app->controller->action->id == "mp" ||
                                                Yii::$app->controller->action->id == "mpc"
                                                )
                                        ) {

                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Commodity Specific</p>', ['awpb-budget/' . $page, 'id' => $session['awpb_template_id'], 'id2' => $id2, 'status' => $status], ["class" => "nav-link active"]);
                                        } else {

                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Commodity Specific</p>', ['awpb-budget/' . $page, 'id' => $session['awpb_template_id'], 'id2' => $id2, 'status' => $status], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }

                                    if (User::userIsAllowedTo("Manage PW AWPB") || User::userIsAllowedTo("Approve AWPB")) {
                                        echo '   <li class="nav-item">';
                                        $role = \common\models\Role::findOne(['id' => $user->role])->role;
                                        $page = "";
                                        $status = "";
                                        $id2 = "0";

                                        if (User::userIsAllowedTo("Manage PW AWPB") && ($user->province_id == 0 || $user->province_id == '')) {
                                            $page = "pwc";
                                            $status = \backend\models\AwpbBudget::STATUS_SUBMITTED;
                                        }
                                        if (User::userIsAllowedTo("Approve AWPB") && ($user->province_id == 0 || $user->province_id == '')) {
                                            $page = "pwc";
                                            $status = \backend\models\AwpbBudget::STATUS_APPROVED;
                                        }


                                        if (
                                                Yii::$app->controller->id == "awpb-budget" &&
                                                (

                                                Yii::$app->controller->action->id == "pwc"

                                                )
                                        ) {

                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Programme-wide</p>', ['awpb-budget/' . $page, 'id' => $session['awpb_template_id'], 'id2' => $id2, 'status' => $status], ["class" => "nav-link active"]);
                                        } else {

                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Programme-wide</p>', ['awpb-budget/' . $page, 'id' => $session['awpb_template_id'], 'id2' => $id2, 'status' => $status], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }


  if (User::userIsAllowedTo("View PW AWPB") ) {
                                        echo '   <li class="nav-item">';
                                        

                                        if (
                                                Yii::$app->controller->id == "awpb-budget" &&
                                                (

                                                Yii::$app->controller->action->id == "awpb"

                                                )
                                        ) {

                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>View AWPB Activities</p>', ['awpb-budget/awpb'], ["class" => "nav-link active"]);
                                        } else {

                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>View AWPB Activities</p>', ['awpb-budget/awpb'], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }


                                    if (User::userIsAllowedTo("Request Funds") || User::userIsAllowedTo("Approve Funds Requisition")) {

                                        echo '   <li class="nav-item">';

                                        $page = "";
                                        $status = "";
                                        $id2 = "0";

                                        if (User::userIsAllowedTo("Request Funds") && ( $user->district_id > 0 || $user->district_id != '')) {
                                            $page = "index_2";
                                            $status = \backend\models\AwpbBudget::STATUS_DRAFT;
                                            $id2 = $user->district_id;
                                        }
                                        if (User::userIsAllowedTo("Request Funds") && ($user->province_id == 0 || $user->province_id == '')) {
                                            $page = "index_2pw";
                                            $status = \backend\models\AwpbBudget::STATUS_DRAFT;
                                            $id2 = $user->district_id;
                                        }

                                        if (User::userIsAllowedTo("Approve Funds Requisition") && ($user->province_id != 0 || $user->province_id != '')) {
                                            $page = "index_1";
                                            $status = \backend\models\AwpbBudget::STATUS_SUBMITTED;
                                        }


                                        if (
                                                Yii::$app->controller->id == "awpb-budget" &&
                                                (Yii::$app->controller->action->id == "index_2" ||
                                                Yii::$app->controller->action->id == "index_1"
                                                )
                                        ) {

                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Input Variation</p>', ['awpb-budget/' . $page, 'id' => $session['awpb_template_id'], 'id2' => $id2, 'status' => $status], ["class" => "nav-link active"]);
                                        } else {

                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Input Variation</p>', ['awpb-budget/' . $page, 'id' => $session['awpb_template_id'], 'id2' => $id2, 'status' => $status], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }

                                    if ((User::userIsAllowedTo("Request Funds")) || (User::userIsAllowedTo("Review Funds Request") && ( $user->province_id != 0 || $user->province_id != '')) || (User::userIsAllowedTo('Approve Funds Requisition') && ( $user->province_id == 0 || $user->province_id == '')) || (User::userIsAllowedTo('Disburse Funds') && ($user->province_id == 0 || $user->province_id == ''))) {

                                        echo '   <li class="nav-item">';

                                        $page = "";
                                        $status = "";
                                        $id2 = "0";

                                        if (User::userIsAllowedTo("Request Funds") && ( $user->district_id > 0 || $user->district_id != '')) {
                                            $page = "qofr";
                                            $status = \backend\models\AwpbBudget::STATUS_DRAFT;
                                            $id2 = $user->district_id;
                                        }
                                        if (User::userIsAllowedTo("Request Funds") && ($user->province_id == 0 || $user->province_id == '')) {
                                            $page = "qofrpw";
                                            $status = \backend\models\AwpbBudget::STATUS_DRAFT;
                                            $id2 = 24;
                                            $user->id;
                                        }

                                        if (
                                                (User::userIsAllowedTo("Approve Funds Requisition") && ($user->province_id == 0 || $user->province_id == '')) ||
                                                (User::userIsAllowedTo("Disburse Funds") && ($user->province_id == 0 || $user->province_id == ''))
                                        ) {
                                            $page = "qofrd";
                                            $status = \backend\models\AwpbBudget::STATUS_SUBMITTED;
                                            $id2 = "0";
                                        }



                                        if (
                                                Yii::$app->controller->id == "awpb-funds-requisition" &&
                                                (Yii::$app->controller->action->id == "qofr" ||
                                                Yii::$app->controller->action->id == "qofrpw" ||
                                                Yii::$app->controller->action->id == "qofrd"
                                                )
                                        ) {

                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Funds Requisition</p>', ['awpb-funds-requisition/' . $page, 'id' => $session['awpb_template_id'], 'id2' => $id2, 'status' => $status], ["class" => "nav-link active"]);
                                        } else {

                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Funds Requisition</p>', ['awpb-funds-requisition/' . $page, 'id' => $session['awpb_template_id'], 'id2' => $id2, 'status' => $status], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }


                                    if ((User::userIsAllowedTo("View Funds Utilisation") && ( $user->district_id > 0 || $user->district_id != '')) || (User::userIsAllowedTo("View Funds Utilisation") && ( $user->province_id != 0 || $user->province_id != '')) || (User::userIsAllowedTo("View Funds Utilisation") && ( $user->province_id == 0 || $user->province_id == '')) || (User::userIsAllowedTo("View Funds Utilisation") && ($user->province_id == 0 || $user->province_id == ''))) {

                                        echo '   <li class="nav-item">';

                                        $page = "";
                                        $status = "";
                                        $id2 = "0";

                                        if (User::userIsAllowedTo("View Funds Utilisation") && ( $user->district_id > 0 || $user->district_id != '')) {
                                            $page = "qofu";
                                            $status = \backend\models\AwpbBudget::STATUS_DRAFT;
                                            $id2 = $user->district_id;
                                        }
                                        if (User::userIsAllowedTo("View Funds Utilisation") && ( $user->district_id > 0 || $user->district_id != '')) {
                                            $page = "qofu";
                                            $status = \backend\models\AwpbBudget::STATUS_DRAFT;
                                            $id2 = $user->district_id;
                                        }
                                        if ((User::userIsAllowedTo("View Funds Utilisation") && ($user->province_id != 0 || $user->province_id != '')) ||
                                                (User::userIsAllowedTo("View Funds Utilisation") && ($user->province_id == 0 || $user->province_id == ''))
                                        ) {
                                            $page = "qofud";
                                            $status = \backend\models\AwpbBudget::STATUS_SUBMITTED;
                                            $id2 = "0";
                                        }



                                        if (
                                                Yii::$app->controller->id == "awpb-funds-requisition" &&
                                                (
                                                        Yii::$app->controller->action->id == "qofu" ||
                                                Yii::$app->controller->action->id == "qofud"
                                                )
                                        ) {

                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Funds Utilisation</p>', ['awpb-funds-requisition/' . $page, 'id' => $session['awpb_template_id'], 'id2' => $id2, 'status' => $status], ["class" => "nav-link active"]);
                                        } else {

                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Funds Utilisation</p>', ['awpb-funds-requisition/' . $page, 'id' => $session['awpb_template_id'], 'id2' => $id2, 'status' => $status], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }
                                       if (User::userIsAllowedTo("Setup AWPB")) {
                                            echo '   <li class="nav-item">';
                                            if (
                                                    Yii::$app->controller->id == "awpb-template" &&
                                                    (
                                                    Yii::$app->controller->action->id == "cq"
                                                    )
                                            ) {
                                                echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Change Quarter</p>', ['/awpb-template/cq'], ["class" => "nav-link active"]);
                                            } else {
                                                echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Change Quarter</p>', ['/awpb-template/cq'], ["class" => "nav-link"]);
                                            }
                                            echo '</li>';
                                        }

                                        if (User::userIsAllowedTo("Setup AWPB")) {
                                            echo '   <li class="nav-item">';
                                            if (
                                                    Yii::$app->controller->id == "awpb-template" &&
                                                    (Yii::$app->controller->action->id == "rollover"
                                                    )
                                            ) {
                                                echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Year End</p>', ['/awpb-template/rollover'], ["class" => "nav-link active"]);
                                            } else {
                                                echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Year End</p>', ['/awpb-template/rollover'], ["class" => "nav-link"]);
                                            }
                                            echo '</li>';
                                        }
                                    
                                    ?>

                                </ul>
                                </li>
                                <?php } ?>
                            <!-------------------------------AWPB MANAGEMENT ENDS------------------------->

                            <!-------------------------------MATCHING GRANT FACILITY----------------------->
                                <?php
                                if (User::userIsAllowedTo("View MGF module")) {
                                    if (Yii::$app->controller->id == "mgf-applicant" ||
                                            Yii::$app->controller->id == "mgf-applicant") {
                                        echo '<li class="nav-item has-treeview menu-open">'
                                        . ' <a href="#" class="nav-link active">';
                                    } else {
                                        echo '<li class="nav-item has-treeview">'
                                        . '<a href="#" class="nav-link">';
                                    }
                                    ?>
                                <i class="nav-icon fas fa-money-check-alt"></i>
                                <p>
                                    Matching Grant Facility<i class="fas fa-angle-left right"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                <?php
                                if (User::userIsAllowedTo("DACO Screen Eligibility")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "mgf-application" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "applications" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "manage")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>District Eligibility Screening</p>', ['mgf-organisation/applications', 'status' => 0], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>District Eligibility Screening</p>', ['mgf-organisation/applications', 'status' => 0], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }


                                if (User::userIsAllowedTo("DACO Screen Eligibility")) {
                                    echo '<li class="nav-item">';
                                    if (Yii::$app->controller->id == "mgf-application" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "applications" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "manage")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Rejected Applications</p>', ['mgf-organisation/sentback', 'status' => 0], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Rejected Applications</p>', ['mgf-organisation/sentback', 'status' => 0], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }


                                if (User::userIsAllowedTo("PACO Screen Eligibility")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "mgf-application" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "applications" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "manage")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Compliant Eligibility</p>', ['mgf-organisation/applications2', 'status' => 0], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Compliant Eligibility</p>', ['mgf-organisation/applications2', 'status' => 0], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }


                                if (User::userIsAllowedTo("PACO Screen Eligibility")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "mgf-application" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "applications" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "manage")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Non-Compliant Eligibility</p>', ['mgf-organisation/applications_2', 'status' => 0], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Non-Compliant Eligibility</p>', ['mgf-organisation/applications_2', 'status' => 0], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }


                                if (User::userIsAllowedTo("PCO Screen Eligibility")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "mgf-application" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "applications" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "manage")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Certified Eligibility</p>', ['mgf-organisation/applications3', 'status' => 0], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Certified Eligibility</p>', ['mgf-organisation/applications3', 'status' => 0], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }


                                if (User::userIsAllowedTo("PCO Screen Eligibility")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "mgf-application" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "applications" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "manage")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Non-Certified Eligibility</p>', ['mgf-organisation/applications_3', 'status' => 0], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Non-Certified Eligibility</p>', ['mgf-organisation/applications_3', 'status' => 0], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }


                                if (User::userIsAllowedTo("Screen Concept Note")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "mgf-concept-note" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Concept Note Screening</p>', ['mgf-proposal/submitted-concept-notes'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Concept Note Screening</p>', ['mgf-proposal/submitted-concept-notes'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }


                                if (User::userIsAllowedTo("Screen Concept Note")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "mgf-concept-note" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Rejected Concept Notes</p>', ['mgf-proposal/rejected-concepts'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Rejected Concept Notes</p>', ['mgf-proposal/rejected-concepts'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }



                                if (User::userIsAllowedTo("Allocate Projects")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "mgf-approval" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "review" ||
                                            Yii::$app->controller->action->id == "accept" ||
                                            Yii::$app->controller->action->id == "certify" ||
                                            Yii::$app->controller->action->id == "approve")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>MGF Project Allocation</p>', ['mgf-proposal/proposals'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>MGF Project Allocation</p>', ['mgf-proposal/proposals'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }


                                if (User::userIsAllowedTo("Screen Project Proposals")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "mgf-approval" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "review" ||
                                            Yii::$app->controller->action->id == "accept" ||
                                            Yii::$app->controller->action->id == "certify" ||
                                            Yii::$app->controller->action->id == "approve")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Project Proposal Screening</p>', ['mgf-project-evaluation/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Project Proposal Screening</p>', ['mgf-project-evaluation/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }




                                if (User::userIsAllowedTo("View MGF Evaluations")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "mgf-final-evaluation" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "evaluations")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Evaluations</p>', ['mgf-final-evaluation/index', 'status' => 0], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Evaluations</p>', ['mgf-final-evaluation/index', 'status' => 0], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }


                                if (User::userIsAllowedTo("View MGF Reviewers")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "mgf-reviewer" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "update" ||
                                            Yii::$app->controller->action->id == "reate")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Reviewers</p>', ['mgf-reviewer/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Reviewers</p>', ['mgf-reviewer/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                ?>                           
                                </ul>
                                </li>
                                <?php } ?>
                            <!-------------------------------MATCHING GRANT FACILITY ENDS------------------------->



                            <!-------------------------------LKM DATA STARTS------------------------------>
                                <?php
                                if (
                                        User::userIsAllowedTo("Manage interview guide template questions") ||
                                        User::userIsAllowedTo("View interview guide template") ||
                                        User::userIsAllowedTo("Submit story of change") ||
                                        User::userIsAllowedTo("Review Story of change") ||
                                        User::userIsAllowedTo("Attach case study articles") ||
                                        User::userIsAllowedTo("View Story of change")
                                ) {
                                    if (
                                            Yii::$app->controller->id == "interview-guide-template" ||
                                            Yii::$app->controller->id == "storyofchange-category" ||
                                            Yii::$app->controller->id == "storyofchange"
                                    ) {
                                        echo '<li class="nav-item has-treeview menu-open">'
                                        . ' <a href="#" class="nav-link active">';
                                    } else {
                                        echo '<li class="nav-item has-treeview">'
                                        . '<a href="#" class="nav-link">';
                                    }
                                    ?>
                                <i class="nav-icon fas fa-book-open"></i>
                                <p>
                                    L&K Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                <?php
                                if (
                                        User::userIsAllowedTo("Manage interview guide template questions") ||
                                        User::userIsAllowedTo("View interview guide template")
                                ) {
                                    echo '   <li class="nav-item">';
                                    if (
                                            Yii::$app->controller->id == "interview-guide-template" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update")
                                    ) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Interview guide</p>', ['/interview-guide-template/index', 'id' => Yii::$app->user->identity->id], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Interview guide</p>', ['/interview-guide-template/index', 'id' => Yii::$app->user->identity->id], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Manage story of change categories")) {
                                    echo '   <li class="nav-item">';
                                    if (
                                            Yii::$app->controller->id == "storyofchange-category" &&
                                            (Yii::$app->controller->action->id == "index")
                                    ) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Story of change categories</p>', ['storyofchange-category/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Story of change categories</p>', ['storyofchange-category/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Submit story of change")) {
                                    echo '<li class="nav-item">';
                                    if (
                                            Yii::$app->controller->id == "storyofchange" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "sequel" ||
                                            Yii::$app->controller->action->id == "conclusions" ||
                                            Yii::$app->controller->action->id == "results" ||
                                            Yii::$app->controller->action->id == "actions" ||
                                            Yii::$app->controller->action->id == "challenges" ||
                                            Yii::$app->controller->action->id == "introduction" ||
                                            Yii::$app->controller->action->id == "check-list" ||
                                            Yii::$app->controller->action->id == "update")
                                    ) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>My Stories of change</p>', ['/storyofchange/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>My Stories of change</p>', ['/storyofchange/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (
                                        User::userIsAllowedTo("Review Story of change") ||
                                        User::userIsAllowedTo("View Story of change")
                                ) {
                                    echo '<li class="nav-item">';
                                    if (
                                            Yii::$app->controller->id == "storyofchange" &&
                                            (Yii::$app->controller->action->id == "stories") ||
                                            (Yii::$app->controller->action->id == "attach-article") ||
                                            (Yii::$app->controller->action->id == "update-article") ||
                                            (Yii::$app->controller->action->id == "story-view")
                                    ) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Stories of change</p>', ['/storyofchange/stories'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Stories of change</p>', ['/storyofchange/stories'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                ?>

                                </ul>
                                </li>
                                <?php } ?>

                            <!-------------------------------LKM ENDS------------------------------------->
                            <!-------------------------------M&E DATA STARTS------------------------------>
                                <?php
                                if (User::userIsAllowedTo("Manage faabs groups") ||
                                        User::userIsAllowedTo("View faabs groups") ||
                                        User::userIsAllowedTo("Manage category A farmers") ||
                                        User::userIsAllowedTo("View category A farmers") ||
                                        User::userIsAllowedTo("Submit FaaBS training records") ||
                                        User::userIsAllowedTo("View FaaBS training records") ||
                                        User::userIsAllowedTo("Submit back to office report") ||
                                        User::userIsAllowedTo("View back to office report") ||
                                        User::userIsAllowedTo("Review back to office report") ||
                                        User::userIsAllowedTo("Plan quarterly work schedules") ||
                                        User::userIsAllowedTo("View quarterly work schedules") ||
                                        User::userIsAllowedTo("Manage FaaBS training topics") ||
                                        User::userIsAllowedTo("View FaaBS training topics") ||
                                        User::userIsAllowedTo("Plan camp monthly activities") ||
                                        //User::userIsAllowedTo("Add training topics to FaaBS") ||
                                        //User::userIsAllowedTo("Approve quarterly work schedules - provincial") ||
                                        User::userIsAllowedTo("Remove planned camp monthly activities") ||
                                        User::userIsAllowedTo("View planned camp monthly activities")
                                ) {
                                    if (Yii::$app->controller->id == "faabs-category-a-farmers" ||
                                            Yii::$app->controller->id == "faabs-training-attendance" ||
                                            Yii::$app->controller->id == "faabs-groups" ||
                                            Yii::$app->controller->id == "time-sheets" ||
                                            //Yii::$app->controller->id == "quarterly-work-plan" ||
                                            Yii::$app->controller->id == "back-to-office-report" ||
                                            Yii::$app->controller->id == "camp-monthly-schedule" ||
                                            Yii::$app->controller->id == "faabs-training-topics"
                                    ) {
                                        echo '<li class="nav-item has-treeview menu-open">'
                                        . ' <a href="#" class="nav-link active">';
                                    } else {
                                        echo '<li class="nav-item has-treeview">'
                                        . '<a href="#" class="nav-link">';
                                    }
                                    ?>
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Monitoring and Evaluation
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                <?php
                                if (User::userIsAllowedTo("Submit timesheets")) {
                                    echo '<li class="nav-item">';
                                    if (Yii::$app->controller->id == "time-sheets" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "media" ||
                                            Yii::$app->controller->action->id == "update-media" ||
                                            Yii::$app->controller->action->id == "update" ||
                                            Yii::$app->controller->action->id == "view")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>My Activity Time sheets</p>', ['/time-sheets/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>My Activity Time sheets</p>', ['/time-sheets/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Review timesheets") ||
                                        User::userIsAllowedTo("View time sheets")) {
                                    echo '<li class="nav-item">';
                                    if (Yii::$app->controller->id == "time-sheets" &&
                                            (Yii::$app->controller->action->id == "time-sheets" ||
                                            Yii::$app->controller->action->id == "time-sheet-view")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>District time sheets</p>', ['/time-sheets/time-sheets'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>District time sheets</p>', ['/time-sheets/time-sheets'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Submit back to office report") && Yii::$app->user->getIdentity()->district_id > 0) {
                                    echo '<li class="nav-item">';
                                    if (Yii::$app->controller->id == "back-to-office-report" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>FaaBS Groups</p>', ['/faabs-groups/index', 'id' => Yii::$app->user->identity->id], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>FaaBS Groups</p>', ['/faabs-groups/index', 'id' => Yii::$app->user->identity->id], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }

                                if (User::userIsAllowedTo("Manage category A farmers") || User::userIsAllowedTo("View category A farmers")) {
                                    echo '<li class="nav-item">';
                                    if (Yii::$app->controller->id == "faabs-category-a-farmers" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Category A farmers</p>', ['/faabs-category-a-farmers/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Category A farmers</p>', ['/faabs-category-a-farmers/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Manage FaaBS training topics") || User::userIsAllowedTo("View FaaBS training topics")) {
                                    echo '<li class="nav-item">';
                                    if (Yii::$app->controller->id == "faabs-training-topics" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>FaaBS Training topics</p>', ['/faabs-training-topics/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>FaaBS Training topics</p>', ['/faabs-training-topics/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Submit FaaBS training records") ||
                                        User::userIsAllowedTo("View FaaBS training records")) {
                                    echo '<li class="nav-item">';
                                    if (Yii::$app->controller->id == "faabs-training-attendance" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update" ||
                                            Yii::$app->controller->action->id == "view")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>FaaBS Training Attendance</p>', ['/faabs-training-attendance/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>FaaBS Training Attendance</p>', ['/faabs-training-attendance/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Submit back to office report")) {
                                    echo '<li class="nav-item">';
                                    if (Yii::$app->controller->id == "back-to-office-report" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update" ||
                                            Yii::$app->controller->action->id == "view")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>My Back to office reports</p>', ['/back-to-office-report/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>My Back to office reports</p>', ['/back-to-office-report/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Review back to office report") ||
                                        User::userIsAllowedTo("View back to office report")) {
                                    echo '<li class="nav-item">';
                                    if (Yii::$app->controller->id == "back-to-office-report" &&
                                            (Yii::$app->controller->action->id == "btor-reports" ||
                                            Yii::$app->controller->action->id == "btor-report-view")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Back to office reports</p>', ['/back-to-office-report/btor-reports'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Back to office reports</p>', ['/back-to-office-report/btor-reports'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                /* if (User::userIsAllowedTo("Set camp/project site objectives for awpb") ||
                                  User::userIsAllowedTo("View camp/project site objectives for awpb")) {
                                  echo '<li class="nav-item">';
                                  if (Yii::$app->controller->id == "camp-subproject-records-awpb-objectives" &&
                                  (
                                  Yii::$app->controller->action->id == "index" ||
                                  Yii::$app->controller->action->id == "view" ||
                                  Yii::$app->controller->action->id == "create" ||
                                  Yii::$app->controller->action->id == "update")) {
                                  echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Camp/Project awpb objectives</p>', ['/camp-subproject-records-awpb-objectives/index'], ["class" => "nav-link active"]);
                                  } else {
                                  echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Camp/Project awpb objectives</p>', ['/camp-subproject-records-awpb-objectives/index'], ["class" => "nav-link"]);
                                  }
                                  echo '</li>';
                                  } */
//                                    if (User::userIsAllowedTo("Plan camp monthly activities") ||
//                                            User::userIsAllowedTo("View planned camp monthly activities")) {
//                                        echo '<li class="nav-item">';
//                                        if (Yii::$app->controller->id == "camp-monthly-schedule" &&
//                                                (
//                                                Yii::$app->controller->action->id == "index" ||
//                                                Yii::$app->controller->action->id == "view" ||
//                                                Yii::$app->controller->action->id == "create" ||
//                                                Yii::$app->controller->action->id == "work-effort" ||
//                                                Yii::$app->controller->action->id == "planned-activities" ||
//                                                Yii::$app->controller->action->id == "update")) {
//                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Camp monthly schedules</p>', ['/camp-monthly-schedule/index'], ["class" => "nav-link active"]);
//                                            /* if (Yii::$app->controller->id == "camp-monthly-planned-work-effort") {
//                                              echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Camp monthly planning</p>', ['/camp-monthly-planned-work-effort/index'], ["class" => "nav-link active"]);
//                                              }
//                                              if (Yii::$app->controller->id == "camp-monthly-planned-activities") {
//                                              echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Camp monthly planning</p>', ['/camp-monthly-planned-activities/index'], ["class" => "nav-link active"]);
//                                              }
//                                              if (Yii::$app->controller->id == "camp-monthly-planned-activities-actual") {
//                                              echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Camp monthly planning</p>', ['/camp-monthly-planned-activities-actual/index'], ["class" => "nav-link active"]);
//                                              } */
//                                        } else {
//                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Camp monthly schedules</p>', ['/camp-monthly-schedule/index'], ["class" => "nav-link"]);
//                                        }
//                                        echo '</li>';
//                                    }
                                /* if (User::userIsAllowedTo("Plan quarterly work schedules") ||
                                  User::userIsAllowedTo("Approve quarterly work schedules - provincial") ||
                                  User::userIsAllowedTo("Approve quarterly work schedules - hq") ||
                                  User::userIsAllowedTo("View quarterly work schedules")) {
                                  echo '<li class="nav-item">';
                                  if (Yii::$app->controller->id == "quarterly-work-plan" &&
                                  (
                                  Yii::$app->controller->action->id == "index" ||
                                  Yii::$app->controller->action->id == "view" ||
                                  Yii::$app->controller->action->id == "create" ||
                                  Yii::$app->controller->action->id == "update")) {
                                  echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Quarterly work schedules</p>', ['/quarterly-work-plan/index'], ["class" => "nav-link active"]);
                                  } else {
                                  echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Quarterly work schedules</p>', ['/quarterly-work-plan/index'], ["class" => "nav-link"]);
                                  }
                                  echo '</li>';
                                  } */
                                ?>

                                </ul>
                                </li>
                                <?php } ?>
                            <!-------------------------------CAPACITY BUILDING ENDS------------------------------------->

                            <!-------------------------------LOGFRAME DATA STARTS------------------------------>
                                <?php
                                if (
                                        User::userIsAllowedTo("Submit logframe data") ||
                                        User::userIsAllowedTo("View logframe data")
                                ) {
                                    if (
                                            Yii::$app->controller->id == "logframe-outreach-gender" ||
                                            Yii::$app->controller->id == "logframe-outreach-young" ||
                                            Yii::$app->controller->id == "storyofchange"
                                    ) {
                                        echo '<li class="nav-item has-treeview menu-open">'
                                        . ' <a href="#" class="nav-link active">';
                                    } else {
                                        echo '<li class="nav-item has-treeview">'
                                        . '<a href="#" class="nav-link">';
                                    }
                                    ?>
                                <i class="nav-icon fas fa-file-archive"></i>
                                <p>
                                    Logframe Data
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">

                                <?php
                                echo '   <li class="nav-item">';
                                if (
                                        Yii::$app->controller->id == "logframe-outreach-gender" &&
                                        (Yii::$app->controller->action->id == "index" ||
                                        Yii::$app->controller->action->id == "view" ||
                                        Yii::$app->controller->action->id == "create" ||
                                        Yii::$app->controller->action->id == "update")
                                ) {
                                    echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Outreach Persons gender</p>', ['/logframe-outreach-gender/index', 'id' => Yii::$app->user->identity->id], ["class" => "nav-link active"]);
                                } else {
                                    echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Outreach Persons gender</p>', ['/logframe-outreach-gender/index', 'id' => Yii::$app->user->identity->id], ["class" => "nav-link"]);
                                }
                                echo '</li>';

                                echo '<li class="nav-item">';
                                if (
                                        Yii::$app->controller->id == "logframe-outreach-young" &&
                                        (Yii::$app->controller->action->id == "index" ||
                                        Yii::$app->controller->action->id == "view" ||
                                        Yii::$app->controller->action->id == "create" ||
                                        Yii::$app->controller->action->id == "update")
                                ) {
                                    echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Outreach Persons young</p>', ['/logframe-outreach-young/index'], ["class" => "nav-link active"]);
                                } else {
                                    echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Outreach Persons young</p>', ['/logframe-outreach-young/index'], ["class" => "nav-link"]);
                                }
                                echo '</li>';
                                ?>

                                </ul>
                                </li>
                                <?php } ?>
                            <!-------------------------------LOGFRAME ENDS------------------------------------->

                            <!-------------------------------MARKET DATA STARTS--------------------------->
                                <?php
                                if (User::userIsAllowedTo("Collect commodity prices") ||
                                        User::userIsAllowedTo("View commodity prices") //||
                                ) {
                                    if (Yii::$app->controller->id == "commodity-price-collection" //||
                                    // Yii::$app->controller->id == "role"
                                    ) {
                                        echo '<li class="nav-item has-treeview menu-open">'
                                        . ' <a href="#" class="nav-link active">';
                                    } else {
                                        echo '<li class="nav-item has-treeview">'
                                        . '<a href="#" class="nav-link">';
                                    }
                                    ?>
                                <i class="nav-icon fas fa-shopping-basket"></i>
                                <p>
                                    Market data
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                <?php
                                if (User::userIsAllowedTo("Collect commodity prices") || User::userIsAllowedTo("View commodity prices")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "commodity-price-collection" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Commodity prices</p>', ['/commodity-price-collection/index', 'id' => Yii::$app->user->identity->id], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Commodity prices</p>', ['/commodity-price-collection/index', 'id' => Yii::$app->user->identity->id], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }

                                /* if (User::userIsAllowedTo("Manage Roles") || User::userIsAllowedTo("View Roles")) {
                                  echo '   <li class="nav-item">';
                                  if (Yii::$app->controller->id == "role" &&
                                  (Yii::$app->controller->action->id == "index" ||
                                  Yii::$app->controller->action->id == "view" ||
                                  Yii::$app->controller->action->id == "create" ||
                                  Yii::$app->controller->action->id == "update")) {
                                  echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Roles</p>', ['/role/index'], ["class" => "nav-link active"]);
                                  } else {
                                  echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Roles</p>', ['/role/index'], ["class" => "nav-link"]);
                                  }
                                  echo '</li>';
                                  } */
                                ?>

                                </ul>
                                </li>
                                <?php } ?>
                            <!-------------------------------MARKET DATA ENDS------------------------->

                            <!-------------------------------CONFIGS STARTS--------------------------->
                                <?php
                                if (User::userIsAllowedTo("Manage provinces") ||
                                        User::userIsAllowedTo("Manage districts") ||
                                        User::userIsAllowedTo("Manage markets") ||
                                        User::userIsAllowedTo("Manage commodity configs") ||
                                        User::userIsAllowedTo("View staff hourly rates") ||
                                        User::userIsAllowedTo("Manage logframe programe targets") ||
                                        User::userIsAllowedTo("Manage camps") ||
                                        User::userIsAllowedTo("Setup AWPB")) {
                                    if (Yii::$app->controller->id == "provinces" ||
                                            Yii::$app->controller->id == "districts" ||
                                            Yii::$app->controller->id == "markets" ||
                                            Yii::$app->controller->id == "commodity-categories" ||
                                            Yii::$app->controller->id == "commodity-price-levels" ||
                                            Yii::$app->controller->id == "commodity-types" ||
                                            Yii::$app->controller->id == "camps" ||
                                            Yii::$app->controller->id == "awpb-unit-of-measure" ||
                                            Yii::$app->controller->id == "cq" ||
                                            Yii::$app->controller->id == "rollover"
                                    ) {
                                        echo '<li class="nav-item has-treeview menu-open">'
                                        . ' <a href="#" class="nav-link active">';
                                    } else {
                                        echo '<li class="nav-item has-treeview">'
                                        . '<a href="#" class="nav-link">';
                                    }
                                    ?>
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Configurations
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                <?php
                                if (User::userIsAllowedTo("Manage logframe programe targets")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "logframe-targets" &&
                                            (Yii::$app->controller->action->id == "index")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Logframe targets</p>', ['/logframe-targets/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Logframe targets</p>', ['/logframe-targets/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Manage provinces")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "provinces" &&
                                            (Yii::$app->controller->action->id == "index")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Provinces</p>', ['/provinces/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Provinces</p>', ['/provinces/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }

                                if (User::userIsAllowedTo("Manage districts")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "districts" &&
                                            (Yii::$app->controller->action->id == "index")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Districts</p>', ['/districts/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Districts</p>', ['/districts/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Manage camps")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "camps" &&
                                            (Yii::$app->controller->action->id == "index")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Camps</p>', ['camps/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Camps</p>', ['camps/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Manage markets")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "markets" &&
                                            (Yii::$app->controller->action->id == "index")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Markets</p>', ['markets/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Markets</p>', ['markets/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Manage commodity configs")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "commodity-categories" &&
                                            (Yii::$app->controller->action->id == "index")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Commodity categories</p>', ['commodity-categories/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Commodity categories</p>', ['commodity-categories/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Manage commodity configs")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "commodity-types" &&
                                            (Yii::$app->controller->action->id == "index")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Commodity types</p>', ['commodity-types/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Commodity types</p>', ['commodity-types/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Manage commodity configs")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "commodity-price-levels" &&
                                            (Yii::$app->controller->action->id == "index")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Commodity price levels</p>', ['commodity-price-levels/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Commodity price levels</p>', ['commodity-price-levels/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }



                                if (User::userIsAllowedTo("Setup AWPB") || User::userIsAllowedTo("View AWPB")) {
                                    echo '   <li class="nav-item">';
                                    if (
                                            Yii::$app->controller->id == "awpb-component" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update")
                                    ) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Components</p>', ['/awpb-component/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Components</p>', ['/awpb-component/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }

                                if (User::userIsAllowedTo("Setup AWPB") || User::userIsAllowedTo("View AWPB")) {
                                    echo '   <li class="nav-item">';
                                    if (
                                            Yii::$app->controller->id == "awpb-activity" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update")
                                    ) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Activities</p>', ['awpb-activity/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Activities</p>', ['awpb-activity/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Setup AWPB") || User::userIsAllowedTo("View AWPB")) {
                                    echo '   <li class="nav-item">';
                                    if (
                                            Yii::$app->controller->id == "awpb-output" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update")
                                    ) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Outputs</p>', ['/awpb-output/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Outputs</p>', ['/awpb-output/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }

                                if (User::userIsAllowedTo("Setup AWPB") || User::userIsAllowedTo("View AWPB")) {
                                    echo '   <li class="nav-item">';
                                    if (
                                            Yii::$app->controller->id == "awpb-outcome" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update")
                                    ) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Outcomes</p>', ['/awpb-outcome/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Outcomes</p>', ['/awpb-outcome/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }


                                if (User::userIsAllowedTo("Setup AWPB") || User::userIsAllowedTo("View AWPB")) {
                                    echo '   <li class="nav-item">';
                                    if (
                                            Yii::$app->controller->id == "awpb-indicator" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update")
                                    ) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Indicators</p>', ['awpb-indicator/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Indicators</p>', ['awpb-indicator/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }


                                if (User::userIsAllowedTo("Setup AWPB") || User::userIsAllowedTo("View AWPB")) {
                                    echo '   <li class="nav-item">';
                                    if (
                                            Yii::$app->controller->id == "awpb-unit-of-measure" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update")
                                    ) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Unit of measures</p>', ['/awpb-unit-of-measure/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Unit of measures</p>', ['/awpb-unit-of-measure/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }

                                if (User::userIsAllowedTo("Setup AWPB") || User::userIsAllowedTo("View AWPB")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "awpb-cost-centre" &&
                                            (Yii::$app->controller->action->id == "index")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Cost centres</p>', ['/awpb-cost-centre/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Cost centres</p>', ['/awpb-cost-centre/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }



                                if (
                                        User::userIsAllowedTo("Setup AWPB") || User::userIsAllowedTo("View AWPB")
                                ) {
                                    echo '   <li class="nav-item">';
                                    if (
                                            Yii::$app->controller->id == "awpb-funder" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update")
                                    ) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Funders</p>', ['/awpb-funder/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Funders</p>', ['/awpb-funder/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }



                                if (
                                        User::userIsAllowedTo("Setup AWPB") ||
                                        User::userIsAllowedTo("View AWPB")
                                ) {
                                    echo '   <li class="nav-item">';
                                    if (
                                            Yii::$app->controller->id == "awpb-expense-category" &&
                                            (Yii::$app->controller->action->id == "index" ||
                                            Yii::$app->controller->action->id == "view" ||
                                            Yii::$app->controller->action->id == "create" ||
                                            Yii::$app->controller->action->id == "update")
                                    ) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Expense category</p>', ['/awpb-expense-category/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Expense category</p>', ['/awpb-expense-category/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                if (User::userIsAllowedTo("Setup AWPB")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "awpb-commodity-types" &&
                                            (Yii::$app->controller->action->id == "index")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>AWPB commodity types</p>', ['awpb-commodity-types/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>AWPB commodity types</p>', ['awpb-commodity-types/index'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                ?>



                                </ul>
                                </li>
                                <?php } ?>
                            <!-------------------------------CONFIGS ENDS----------------------------->
                            <!-------------------------------REPORTS STARTS--------------------------->
                                <?php
                                if (User::userIsAllowedTo("View facilitation of improved technologies/best practices report") ||
                                        User::userIsAllowedTo("View physical tracking table report") ||
                                        User::userIsAllowedTo("View project outreach reports") ||
                                        User::userIsAllowedTo("View training attendance cumulative report")
// User::userIsAllowedTo("Manage markets") ||
// User::userIsAllowedTo("Manage commodity configs") 
                                ) {
                                    if (Yii::$app->controller->id == "reports") {
                                        echo '<li class="nav-item has-treeview menu-open">'
                                        . ' <a href="#" class="nav-link active">';
                                    } else {
                                        echo '<li class="nav-item has-treeview">'
                                        . '<a href="#" class="nav-link">';
                                    }
                                    ?>
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Reports
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                <?php
                                if (User::userIsAllowedTo("View facilitation of improved technologies/best practices report")) {
                                    echo '   <li class="nav-item">';
                                    if (Yii::$app->controller->id == "reports" &&
                                            (Yii::$app->controller->action->id == "facilitation-imporoved-technologies")) {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Training imporoved technologies</p>', ['/reports/facilitation-imporoved-technologies'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Training imporoved technologies</p>', ['/reports/facilitation-imporoved-technologies'], ["class" => "nav-link"]);
                                    }
                                    echo '</li>';
                                }
                                ?>
    <?php
    if (User::userIsAllowedTo("View training attendance cumulative report")) {
        echo '   <li class="nav-item">';
        if (Yii::$app->controller->id == "reports" &&
                (Yii::$app->controller->action->id == "training-attendance-cumulatives")) {
            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Training attendance cumulative</p>', ['/reports/training-attendance-cumulatives'], ["class" => "nav-link active"]);
        } else {
            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Training attendance cumulative</p>', ['/reports/training-attendance-cumulatives'], ["class" => "nav-link"]);
        }
        echo '</li>';
    }
    ?>
                                    <?php
                                    if (User::userIsAllowedTo("View physical tracking table report")) {
                                        echo '   <li class="nav-item">';
                                        if (Yii::$app->controller->id == "reports" &&
                                                (Yii::$app->controller->action->id == "physical-tracking-table")) {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Physical tracking table</p>', ['/reports/physical-tracking-table'], ["class" => "nav-link active"]);
                                        } else {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Physical tracking table</p>', ['/reports/physical-tracking-table'], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }
                                    if (User::userIsAllowedTo("View logframe report")) {
                                        echo '   <li class="nav-item">';
                                        if (Yii::$app->controller->id == "reports" &&
                                                (Yii::$app->controller->action->id == "log-framework")) {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Log Framework</p>', ['/reports/log-framework'], ["class" => "nav-link active"]);
                                        } else {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Log Framework</p>', ['/reports/log-framework'], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }
                                    if (User::userIsAllowedTo("View project outreach reports")) {
                                        echo '   <li class="nav-item">';
                                        if (Yii::$app->controller->id == "reports" &&
                                                (Yii::$app->controller->action->id == "project-outreach-report")) {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Project outreach</p>', ['/reports/project-outreach-report'], ["class" => "nav-link active"]);
                                        } else {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Project outreach</p>', ['/reports/project-outreach-report'], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }
                                    ?>

                                </ul>
                                </li>
                                <?php } ?>
                            <!-------------------------------REPORTS ENDS----------------------------->
                            <!-------------------------------AUDIT TRAIL STARTS----------------------->
                            <li class="nav-item">
                                <?php
                                if (User::userIsAllowedTo("View audit trail logs")) {
                                    if (Yii::$app->controller->id == "audit-trail") {
                                        echo Html::a('<i class="fas fa-history nav-icon"></i> '
                                                . '<p>Audit logs</p>', ['audit-trail/index'], ["class" => "nav-link active"]);
                                    } else {
                                        echo Html::a('<i class="fas fa-history nav-icon"></i> '
                                                . '<p>Audit logs</p>', ['audit-trail/index'], ["class" => "nav-link"]);
                                    }
                                }
                                ?>
                            </li>
                            <!-------------------------------AUDIT TRAIL ENDS------------------------->
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">

                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
<?=
Breadcrumbs::widget([
    'homeLink' => [
        'label' => 'Home',
        'url' => Yii::$app->getHomeUrl() . 'home/home'
    ],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
])
?>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                                    <?= $content ?>
                        <!-- /.row -->
                    </div>
                    <!--/. container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <div class="modal fade" id="logoutModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ready to leave?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Select "Logout" below if you are ready to end your current session.</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><span class="text-xs">Cancel</span></button>
<?=
Html::a('<span class="text-xs">Logout</span>', ['site/logout'], [
    'data' => ['method' => 'POST'], 'id' => 'logout',
    'class' => 'btn btn-success btn-xs'
])
?>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>

<?php $this->endBody() ?>
        <script>
            var myArrSuccess = [<?php
                            $flashMessage = Yii::$app->session->getFlash('success');
                            if ($flashMessage) {
                                echo '"' . $flashMessage . '",';
                            }
                            ?>];
            for (var i = 0; i < myArrSuccess.length; i++) {
                $.notify(myArrSuccess[i], {
                    type: 'success',
                    offset: 60,
                    allow_dismiss: true,
                    newest_on_top: true,
                    timer: 5000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });
            }
            var myArrError = [<?php
                            $flashMessage = Yii::$app->session->getFlash('error');
                            if ($flashMessage) {
                                echo '"' . $flashMessage . '",';
                            }
                            ?>];
            for (var j = 0; j < myArrError.length; j++) {
                $.notify(myArrError[j], {
                    type: 'danger',
                    offset: 60,
                    allow_dismiss: true,
                    newest_on_top: true,
                    timer: 5000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });
            }
        </script>
    </body>

</html>
<?php $this->endPage() ?>

