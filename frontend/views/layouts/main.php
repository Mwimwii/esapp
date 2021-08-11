
<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AppAsset;
use backend\models\MgfApplicant;
use common\models\User;
use yii\helpers\Url;
$isGuest = Yii::$app->user->isGuest;
if($isGuest){
    echo '<script>location.href="index.php?r=site/login"</script>';
}else{
    $userid=Yii::$app->user->identity->id;
    $user=User::findOne($userid);
    $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
}
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="20x20" href="<?= Url::to('@web/img/coa.png') ?>">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | ESAPPMIS </title>
        <?php $this->head() ?>
    </head>
    
    
    <body class="hold-transition">
        <?php $this->beginBody() ?>

        <div class="login-box" style="width: 95%;">
        <nav class="main-header navbar navbar-expand navbar-green navbar-light">
                <ul class="navbar-nav">

                <li class="nav-item ">
                        <a class="nav-link" data-widget="pushmenu" href="#" autoCollapseSize="true"><i class="fas fa-bars text-white"></i></a>
                    </li>
                   
                    <li class="nav-item">
                        <a  href="https://www.agriculture.gov.zm/" target="blank" class="nav-link text-white">Ministry of Agriculture Home</a>
                    </li>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu" >
                        <?php if(!$isGuest){?>
                        <a href="#" class="dropdown-toggle text-white" data-toggle="dropdown">
                            <img src="<?= Url::to('@web/img/icon.png') ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"> <?= $user['username'] ?> </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" style="background-color: #28a745;">
                            <!-- User image -->
                            <li class="user-header text-white">
                                <img src="<?= Url::to('@web/img/icon.png') ?>" class="img-circle" alt="User Image">
                                <p>
                                    <small> <?= $user['username'] ?> - <?= $user['role'] ?> </small>
                                    <small>Member since <?= date('M Y', $user['created_at']) ?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div>
                                    <?php if($applicant->district_id>0){?>
                                        <?= Html::a('<i class="fas fa-user-circle"></i> My Profile', ['/mgf-applicant/applicant', 'id' => $applicant->id], ['class' => "float-left btn btn-outline-success btn-recreate btn-sm"]); ?>
                                    <?php } ?>
                                    <a class="float-right btn btn-outline-success btn-recreate btn-sm" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                </div>

                            </li>

                        </ul>
                        <?php } ?>
                    </li>

                </ul>
            </nav>
            <!-- /.navbar -->

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
                                . Html::submitButton('Logout',
                                    ['class' => 'btn btn-success'])
                                . Html::endForm()
                            ?>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>


    

        <div class="card card-success card-outline">
            
            <div class="card-body">
                <hr class="dotted short"> 
                <?= $content ?>
            </div>
        </div>
            <div class="col-lg-12 text-center">
                <!--<span class=" text-sm breadcrumb-item active">Terms of use. Privacy Policy</span>-->
                <hr class="dotted short">
            </div>

        </div>

            
        <div class="row text-center text-sm breadcrumb-item active">
            Copyright &copy; <?= date("Y") ?> - Ministry of Agriculture | ESAPP. All rights reserved.
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
                    offset: 100,
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
                    offset: 100,
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
