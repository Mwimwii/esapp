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
            . '<span style="font-size: 11px;">&nbsp;&nbsp;' . $faabs_group->name . '&nbsp;&nbsp;</span></span>';
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
        //We get farmers that belong to the FaaBS
        $farmers = \backend\models\MeFaabsCategoryAFarmers::find()
                ->where(['faabs_group_id' => $faabs_group->id])
                ->asArray()
                ->all();


        $count = 1;
        //If FaaBS has farmers, we check if there are some that have graduated
        //and pick only those that are still being trained
        if (!empty($farmers)) {
            foreach ($farmers as $farmer) {
                //Get how many topics farmer has been trained on
                $trained = backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->where(['faabs_group_id' => $faabs_group->id])
                        ->andWhere(['farmer_id' => $farmer['id']])
                        ->count();

                //Get total topics for a FaaBS
                $total = \backend\models\MeFaabsTrainingTopicEnrolment::find()
                        ->where(['faabs_id' => $faabs_group->id])
                        ->count();

                //If farmer has graduated, we skip that farmer, it means they were trained on all topics
                if ($total > $trained) {
                    $farmer_names = $farmer['first_name'] . " " . $farmer['other_names'] . " " . $farmer['last_name'];
                    echo
                    '<tr>
                            <td style="font-weight: bold;padding:8px;" class="text-center">' . $count . '</td>
                            <td style="font-weight: bold;" class="text-left">' . $farmer_names . '</td>
                            <td style="font-weight: bold;" class="text-center"></td>
                            <td style="font-weight: bold;" class="text-center">&nbsp;</td>
                            <td style="font-weight: bold;" class="text-center">&nbsp;</td>
                            <td style="font-weight: bold;" class="text-center">&nbsp;</td>
                            <td style="font-weight: bold;" class="text-center">&nbsp;</td>
                         </tr>';
                    $count++;
                }
            }

            //We add extra rows at the end of the sheet if the number of farmers is less than 29
            if (count($farmers) < 29) {
                for ($i = 1; $i < (29 - count($farmers)); $i++) {
                    echo
                    '<tr>
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
            }
        } else {
            for ($i = 1; $i < 29; $i++) {
                echo
                '<tr>
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
        }
        ?>
    </table>
</div>