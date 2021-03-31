<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= Url::to('@web/img/coa.png') ?>">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

    </head>
    <body class="hold-transition layout-top-nav">
        <?php $this->beginBody() ?>
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-green ">
                <div class="container">

                    <a class="navbar-brand" href="#" target="blank">
                        <?=
                        Html::img('@web/img/coa.png', ["class" => "brand-image",
                            'style' => 'opacity: .9']);
                        ?>
                        <span class="brand-text text-white font-weight-light">E-SAPP MIS</span>
                    </a>
                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Right navbar links -->
                    <ul class="navbar-nav order-1 order-md-3 navbar-no-expand ml-auto">
                        <li class="nav-item">
                            <a  href="https://www.agriculture.gov.zm/" target="blank" class="nav-link text-white">Ministry of Agriculture Home</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container">

                    </div><!-- /.container-fluid -->
                </div>
                <!-- Main content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                            <div class="col-lg-3">

                            </div>
                            <?= $content ?>
                            <div class="col-lg-3">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.navbar -->
            <!-- Main Footer -->


            <!-- Main Footer -->
            <footer class="main-footer navbar-light navbar-green brand-text text-white text-md font-weight-light">
                <div class="row">
                    <div class="col-lg-12 text-center text-sm">
                        Copyright &copy; <?= date("Y") ?> - E-SAPP
                        <a class="text-white" href="https://www.agriculture.gov.zm/" target="blank">(Ministry of Agriculture)</a>. All rights reserved.
                    </div>
                </div>

            </footer>
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
