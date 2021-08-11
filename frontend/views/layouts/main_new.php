<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use backend\models\User;
use frontend\models\MgfApplicant;

AppAsset::register($this);
$session = Yii::$app->session;
//$userid=Yii::$app->user->identity->id;
//$applicant=MgfApplicant::findOne(['user_id'=>$userid]);
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
            <nav class="main-header navbar navbar-expand navbar-green navbar-light" >
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars text-white"></i></a>
                    </li>
                    <li class="nav-item">
                        <a  href="https://www.agriculture.gov.zm/" target="blank" class="nav-link text-white">Ministry of Agriculture Home</a>
                    </li>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu" >

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
                                    <?= Html::a('<i class="fas fa-user-circle"></i> My Profile', ['/mgf-applicant/applicant', 'id' => $applicant->id], ['class' => "float-left btn btn-outline-success btn-recreate btn-sm"]); ?>
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
                    Html::img('@web/img/coa.png', ["class" => "brand-image",
                        'style' => 'opacity: .9']);
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
                             <!-------------------------------MATCHING GRANT FACILITY----------------------->
                             <?php
                            if (User::userIsAllowedTo("View MGF module") || User::userIsAllowedTo("View MGF module") ||
                                    User::userIsAllowedTo("View profile") ||
                                    User::userIsAllowedTo("Manage Roles") || User::userIsAllowedTo("View Roles")) {
                                if (Yii::$app->controller->id == "users" ||
                                        Yii::$app->controller->id == "role") {
                                    echo '<li class="nav-item has-treeview menu-open">'
                                    . ' <a href="#" class="nav-link active">';
                                } else {
                                    echo '<li class="nav-item has-treeview">'
                                    . '<a href="#" class="nav-link">';
                                }
                                ?>
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    MGF
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php
                                    if (User::userIsAllowedTo("View profile")) {
                                        echo '   <li class="nav-item">';
                                        if (Yii::$app->controller->id == "users" &&
                                                (Yii::$app->controller->action->id == "profile")) {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>My Profile</p>', ['/users/profile', 'id' => Yii::$app->user->identity->id], ["class" => "nav-link active"]);
                                        } else {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>My Profile</p>', ['/users/profile', 'id' => Yii::$app->user->identity->id], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }

                                    if (User::userIsAllowedTo("Manage Roles") || User::userIsAllowedTo("View Roles")) {
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
                                    }
                                    if (User::userIsAllowedTo("Manage Users") || User::userIsAllowedTo("View Users")) {
                                        echo '   <li class="nav-item">';
                                        if (Yii::$app->controller->id == "users" &&
                                                (Yii::$app->controller->action->id == "index" ||
                                                Yii::$app->controller->action->id == "view" ||
                                                Yii::$app->controller->action->id == "create" ||
                                                Yii::$app->controller->action->id == "update")) {
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
                                    if (User::userIsAllowedTo("View MGF Applicants")) {
                                        echo '   <li class="nav-item">';
                                        if (Yii::$app->controller->id == "mgf-applicant" &&
                                        (Yii::$app->controller->action->id == "index" ||
                                        Yii::$app->controller->action->id == "update" ||
                                        Yii::$app->controller->action->id == "view")) {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Applicants</p>', ['/mgf-applicant/index'], ["class" => "nav-link active"]);
                                        } else {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Applicants</p>', ['/mgf-applicant/index'], ["class" => "nav-link active"]);
                                            //echo Html::a('<i class="far fa-circle nav-icon"></i> <p>My Profile</p>', ['/users/profile', 'id' => Yii::$app->user->identity->id], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }


                                    if (User::userIsAllowedTo("View MGF Organisations")) {
                                        echo '   <li class="nav-item">';
                                        if (Yii::$app->controller->id == "mgf-organisation" &&
                                                (Yii::$app->controller->action->id == "index" ||
                                                Yii::$app->controller->action->id == "view" ||
                                                Yii::$app->controller->action->id == "open" ||
                                                Yii::$app->controller->action->id == "manage" ||
                                                Yii::$app->controller->action->id == "veryfy" ||
                                                Yii::$app->controller->action->id == "update" ||
                                                Yii::$app->controller->action->id == "applications")) {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Organisations</p>', ['mgf-organisation/index'], ["class" => "nav-link active"]);
                                        } else {
                                            echo Html::a('<i class="far fa-circle nav-icon"></i> <p>Organisations</p>', ['mgf-organisation/index'], ["class" => "nav-link"]);
                                        }
                                        echo '</li>';
                                    }

                                    if (User::userIsAllowedTo("Manage Users") || User::userIsAllowedTo("View Users")) {
                                        echo '   <li class="nav-item">';
                                        if (Yii::$app->controller->id == "users" &&
                                                (Yii::$app->controller->action->id == "index" ||
                                                Yii::$app->controller->action->id == "view" ||
                                                Yii::$app->controller->action->id == "create" ||
                                                Yii::$app->controller->action->id == "update")) {
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
                                        'homeLink' => ['label' => 'Home',
                                            'url' => Yii::$app->getHomeUrl() . 'home/home'],
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
                    </div><!--/. container-fluid -->
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
                            <?= Html::beginForm(['/site/logout'], 'post')
                                . Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'btn btn-success'])
                                . Html::endForm()
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
                    placement: {from: 'top', align: 'right'}
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
                    placement: {from: 'top', align: 'right'}
                });
            }
        </script>
    </body>
</html>
<?php $this->endPage() ?>
