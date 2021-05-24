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
            Category 'A' Farmer Registration Form
        </p>
    </div>
    <p style="font-size: 16px;">Date of registration:........................................................................</p>
    <table style="margin-bottom: 20px;" class="table table-bordered fixed">
        <tr>
            <td colspan="2" style="width: 220px;" class="text-center">Province</td>
            <td colspan="2" class="text-center">District</td>
            <td colspan="2" class="text-center">Chiefdom</td>
            <td colspan="2" class="text-center">Block</td>
            <td class="text-center">Camp</td>
            <td class="text-center" style="width: 130px;">Zone</td>
            <td class="text-center">Commodity</td>
        </tr>
        <tr>
            <td colspan="2" class="text-center">&nbsp;</td>
            <td colspan="2" class="text-center">&nbsp;</td>
            <td colspan="2" class="text-center">&nbsp;</td>
            <td colspan="2" class="text-center">&nbsp;</td>
            <td class="text-center">&nbsp;</td>
            <td class="text-center">&nbsp;</td>
            <td class="text-center">&nbsp;</td>
        </tr>
        <tr>
            <td style="font-weight: bold;" class="text-center">SL</td>
            <td style="font-weight: bold;width:200px;" class="text-center">Full names</td>
            <td style="font-weight: bold;width:100px;" class="text-center">NRC</td>
            <td style="font-weight: bold;width:80px;" class="text-center">Year of <br>Birth</td>
            <td style="font-weight: bold;width:50px;" class="text-center">Sex</td>
            <td style="font-weight: bold;width:100px;" class="text-center">Marital<br> Status</td>
            <td style="font-weight: bold;width:100px;" class="text-center">Relationship to<br> HH Head</td>
            <td style="font-weight: bold;width:100px;" class="text-center">Village</td>
            <td style="font-weight: bold;width:50px;" class="text-center">House<br>hold size</td>
            <td style="font-weight: bold;width:100px;" class="text-center">Farmer organisation</td>
            <td style="font-weight: bold;width:100px;" class="text-center">Contact No.</td>
        </tr>
        <?php
        $count = 1;
        for ($i = 1; $i < 53; $i++) {
            echo ' <tr>
            <td style="font-weight: bold;" class="text-center">' . $count . '</td>
            <td style="font-weight: bold;" class="text-center">&nbsp;</td>
            <td style="font-weight: bold;" class="text-center">&nbsp;&nbsp;&nbsp;</td>
            <td style="font-weight: bold;" class="text-center">&nbsp;</td>
            <td style="font-weight: bold;" class="text-center">&nbsp;</td>
            <td style="font-weight: bold;" class="text-center">&nbsp;</td>
            <td style="font-weight: bold;" class="text-center">&nbsp;</td>
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


