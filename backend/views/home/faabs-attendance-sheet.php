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
    <div class="text-center" style="margin-top: 20px;margin-bottom: 60px;margin-top: -100px;font-weight: bold;">
        <p>
            Ministry of Agriculture<br>
            Enhanced Smallholder Agribusiness Promotion Programme<br>
            Attendance Sheet: Farming as Business School(FaaBS)
        </p>
    </div>
    <?php
    if (!empty($topic)) {
        echo '<p style="font-size: 11px;">
                 Training Course(Topic):<span style="font-size:1em;text-decoration:underline;">&nbsp;&nbsp;' . $topic . '&nbsp;&nbsp;</span>
              </p>';
    } else {
        echo '<p style="font-size: 11px;">Training Course(Topic):______________________________________________________________________________________</p>';
    }
    ?>


    <p style="font-size: 11px;">Names of Facilitors,Organisation & Signature:_____________________________________________________________________</p>
    <p style="font-size: 11px;">Partner Organisation(s):______________________________________________________________________________________</p>
    <p style="">

        <?php
        if (!empty($faabs_group)) {
            echo '<span style="font-size: 11px;"> Session duration:_____________hrs___________minutes.&nbsp;Name of FaaBS:  </span>';
            echo '<span style="font-size:1em;text-decoration:underline;">'
            . '<span style="font-size: 11px;">&nbsp;&nbsp;' . $faabs_group . '&nbsp;&nbsp;</span></span>';
        } else {
            echo '<span style="font-size: 11px;"> Session duration:_____________hrs___________minutes.&nbsp;Name of FaaBS:____________________________________________</span>';
        }
        ?>

    </p>
    <?php
    ?>
    <p style="">
        <span style="font-size: 11px;"> Province: </span>
        <span style="font-size:1em;text-decoration:underline;">
            <span style="font-size: 11px;">
                &nbsp;&nbsp;            
                <?= $province ?>
                &nbsp;&nbsp;
            </span>
        </span>
        &nbsp;&nbsp;
        <span style="font-size: 11px;">District:</span>
        <span style="font-size:1em;text-decoration:underline;">
            <span style="font-size: 11px;">
                &nbsp;&nbsp;
                <?= $district ?>
                &nbsp;&nbsp;
            </span>
        </span>
        &nbsp;&nbsp;
        <span style="font-size: 11px;">Camp:</span>
        <span style="font-size:1em;text-decoration:underline;">
            <span style="font-size: 11px;">
                &nbsp;&nbsp;               
                <?= $camp ?>
                &nbsp;&nbsp;
            </span>
        </span>
    </p>
    <p></p>
    <table style="margin-bottom: 20px;" class="table table-bordered fixed">
        <tr>
            <td style="font-weight: normal;" class="text-center">SL</td>
            <td style="font-weight: normal;width:250px;" class="text-center">Full names</td>
            <td style="font-weight: normal;width:30px;" class="text-center">Sex(M/F)</td>
            <td style="font-weight: normal;width:150px;" class="text-center">Youth/Non Youth</td>
            <td style="font-weight: normal;width:150px;" class="text-center">Marital<br> Status</td>
            <td style="font-weight: normal;width:150px;" class="text-center">Household<br>head type</td>
            <td style="font-weight: normal;width:100px;" class="text-center">Signature</td>
        </tr>
        <?php
        $count = 1;
        for ($i = 1; $i < 29; $i++) {
            echo ' <tr>
            <td style="font-weight: bold;padding:8px;" class="text-center">' . $count . '</td>
            <td style="font-weight: bold;" class="text-center"></td>
            <td style="font-weight: bold;" class="text-center"></td>
            <td style="font-weight: bold;" class="text-center">&nbsp;</td>
            <td style="font-weight: bold;" class="text-center">&nbsp;</td>
            <td style="font-weight: bold;" class="text-center">&nbsp;</td>
            <td style="font-weight: bold;" class="text-center">&nbsp;</td>
        </tr>';
            $count++;
        }
        ?>
    </table>
</div>


