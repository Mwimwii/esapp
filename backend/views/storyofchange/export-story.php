<?php

use yii\helpers\Html;
?>

<div class="container ">
    <div class="row">
        <div class="text-left">
            <?= Html::img('@web/img/coa.png', ['style' => 'width:100px; height: 100px']); ?>
        </div>
        <div style="margin-top: -100px;" class="text-right">
            <?= Html::img('@web/img/ifad.png', ['style' => 'width:100px; height: 100px']); ?>
        </div>
    </div>
    <div class="text-center" style="margin-top: 20px;margin-bottom: 100px;margin-top: -100px;font-weight: bold;">
        <p>
            Ministry of Agriculture<br>
            Enhanced Smallholder Agribusiness Promotion Programme<br>
            Case Study/Success Story
        </p>
    </div>
    <p style="font-weight: bold;font-size: 16px;">Title:<?= $model->title ?></p>
    <p style="font-weight: bold;margin-bottom: 3px;">Introduction</p>
  
        <?php
        echo  str_replace("<p>", "<p class='text-justify'>", $model->introduction);
        ?>
    </p>
    <p>&nbsp;</p>
    <p style="font-weight: bold;margin-bottom: 3px;">Challenges</p>
        <?php
        echo  str_replace("<p>", "<p class='text-justify'>", $model->challenge);
        ?>
    </p>
    <p>&nbsp;</p>
    <p style="font-weight: bold;margin-bottom: 3px;">Actions</p>
       <?php
        echo  str_replace("<p>", "<p class='text-justify'>",  $model->actions);
        ?>
    </p>
    <p>&nbsp;</p>
    <p style="font-weight: bold;margin-bottom: 3px;">Results</p>
       <?php
        echo  str_replace("<p>", "<p class='text-justify'>",  $model->results );
        ?>
    </p>
    <p>&nbsp;</p>
    <p style="font-weight: bold;margin-bottom: 3px;">Conclusions</p>
     <?php
        echo  str_replace("<p>", "<p class='text-justify'>",  $model->conclusions );
        ?>
    </p>
    <p>&nbsp;</p>
    <p style="font-weight: bold;margin-bottom: 3px;">Sequel</p>
     <?php
        echo  str_replace("<p>", "<p class='text-justify'>",  $model->sequel );
        ?>
    </p>
</div>


