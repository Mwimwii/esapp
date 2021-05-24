
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
<br/><br/><br/>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= Url::to('@web/img/coa.png') ?>">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | ESAPPMIS </title>
        <?php $this->head() ?>

    </head>
    <body class="hold-transition login-page">
        <?php $this->beginBody() ?>

        <div class="row login-logo" style="width:600px;padding-top: 45px;">
            <div class="col-lg-12">&nbsp;&nbsp;&nbsp;</div>
            <div class="col-lg-3 logo-image text-left">
                <?=
                Html::img('@web/img/coa.png', ["class" => "brand-image",
                    'style' => 'width:120px; display: block; margin-left: auto; margin-right: auto;height: 120px']);
                ?>
            </div>
            <div class="col-lg-6" style="padding-top: 40px;">
                <div class="breadcrumb-item active" style="text-align: center;">
                    <h5>Republic of Zambia</h5>
                    <h6>Ministry of Agriculture</h6>
                    <h6>ESAPP MIS</h6>
                </div>
            </div>
            <div class="col-lg-3 logo-image text-right">
                <?=
                Html::img('@web/img/ifad.png', ["class" => "brand-image",
                    'style' => 'width:150px; display: block; margin-left: auto; margin-right: auto;height: 120px']);
                ?>
            </div>
            <div class="col-lg-12 text-center">
                <hr class="dotted short">
            </div>
        </div>

        <div class="login-box" style="width: inherit;">
            <?= $content ?>
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
