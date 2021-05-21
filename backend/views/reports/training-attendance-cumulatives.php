<?php

use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\editable\Editable;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Training attendance cumulatives';
$this->params['breadcrumbs'][] = "Reports";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h4>Instructions</h4>
        <ol>
            <li>Apply a filter below to view 'Training attendance cumulatives' reports</li>
            <?php
            if (empty(Yii::$app->user->identity->district_id)) {
                echo '<li>Province and Training type are mandatory before you can filter</li>';
            }
            if (isset($_GET['MeFaabsTrainingAttendanceSheetSearch'])) {
                echo '<li>Click the "<span class="badge badge-success"><span class="fas fa-file-excel"></span> Download report</span>" button to download the report</li>';
            }
            ?>
        </ol>
        <?php
        if (!empty(Yii::$app->user->identity->district_id)) {
            echo $this->render('_search_training_attendance_cumulative_1', ['model' => $searchModel]);
        } else {
            echo $this->render('_search_training_attendance_cumulative', ['model' => $searchModel]);
        }
        ?>

        <hr class="dotted short">
        <?php
        if (isset($_GET['MeFaabsTrainingAttendanceSheetSearch']) && !empty($data)) {
            $province_id = !empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['province_id']) ? $_GET['MeFaabsTrainingAttendanceSheetSearch']['province_id'] : "";
            $district_id = !empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['district_id']) ? $_GET['MeFaabsTrainingAttendanceSheetSearch']['district_id'] : "";
            $camp_id = !empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['camp_id']) ? $_GET['MeFaabsTrainingAttendanceSheetSearch']['camp_id'] : "";
            $training_type = !empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['training_type']) ? $_GET['MeFaabsTrainingAttendanceSheetSearch']['training_type'] : "";
            ?>
            <h3 class="card-title">
                <?php
                echo $training_type
                ?>
            </h3>
            <p class="float-right">
                <?php
                echo Html::a('<span class="fas fa-file-excel"></span> Download report',
                        ['reports/download-tac-report'], [
                    'data-method' => 'POST',
                    'data-params' => [
                        'province_id' => $province_id,
                        'district_id' => $district_id,
                        'camp_id' => $camp_id,
                        'training_type' => $training_type,
                        'data' => json_encode($data)
                    ],
                    'title' => 'Download report in excel',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'class' => 'btn btn-success btn-xs'
                ]);
                ?>
            </p>

            <table class="table table-bordered table table-sm">
                <tr>
                    <th colspan="2" class="text-center">FaaBS Location Details</th> 
                    <th colspan="1" class="text-center"></th>
                    <th colspan="2" class="text-center">2019</th> 
                    <th colspan="2" class="text-center">2020</th> 
                    <th colspan="2" class="text-center">2021</th> 
                    <th colspan="2" class="text-center">2022</th> 
                    <th colspan="2" class="text-center">2023</th> 
                </tr>
                <tr>
                    <td>FaaBS name</td>
                    <td>Camp</td>
                    <td>Total # enrolled in FaaBS</td>
                    <td># Trained [Jan-Jun]</td>
                    <td># Trained [Jul-Dec]</td>
                    <td># Trained [Jan-Jun]</td>
                    <td># Trained [Jul-Dec]</td>
                    <td># Trained [Jan-Jun]</td>
                    <td># Trained [Jul-Dec]</td>
                    <td># Trained [Jan-Jun]</td>
                    <td># Trained [Jul-Dec]</td>
                    <td># Trained [Jan-Jun]</td>
                    <td># Trained [Jul-Dec]</td>
                </tr>

                <?php
                $sum_2019_jan_jun = 0;
                $sum_2019_jul_dec = 0;
                $sum_2020_jan_jun = 0;
                $sum_2020_jul_dec = 0;
                $sum_2021_jan_jun = 0;
                $sum_2021_jul_dec = 0;
                $sum_2022_jan_jun = 0;
                $sum_2022_jul_dec = 0;
                $sum_2023_jan_jun = 0;
                $sum_2023_jul_dec = 0;
                $sum_total_enrolled = 0;
                foreach ($data as $_data) {
                    foreach ($_data as $key => $value) {
                        $sum_2019_jan_jun += $value[0]['2019']['jan_jun'];
                        $sum_2019_jul_dec += $value[0]['2019']['jul_dec'];
                        $sum_2020_jan_jun += $value[1]['2020']['jan_jun'];
                        $sum_2020_jul_dec += $value[1]['2020']['jul_dec'];
                        $sum_2021_jan_jun += $value[2]['2021']['jan_jun'];
                        $sum_2021_jul_dec += $value[2]['2021']['jul_dec'];
                        $sum_2022_jan_jun += $value[3]['2022']['jan_jun'];
                        $sum_2022_jul_dec += $value[3]['2022']['jul_dec'];
                        $sum_2023_jan_jun += $value[4]['2023']['jan_jun'];
                        $sum_2023_jul_dec += $value[4]['2023']['jul_dec'];
                        $sum_total_enrolled += $value['total_faabs_enrolled'];
                        ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td><?= $value['camp'] ?></td>
                            <td class="text-center"><?= $value['total_faabs_enrolled'] ?></td>
                            <td class="text-center"><?= $value[0]['2019']['jan_jun'] ?></td>
                            <td class="text-center"><?= $value[0]['2019']['jul_dec'] ?></td>
                            <td class="text-center"><?= $value[1]['2020']['jan_jun'] ?></td>
                            <td class="text-center"><?= $value[1]['2020']['jul_dec'] ?></td>
                            <td class="text-center"><?= $value[2]['2021']['jan_jun'] ?></td>
                            <td class="text-center"><?= $value[2]['2021']['jul_dec'] ?></td>
                            <td class="text-center"><?= $value[3]['2022']['jan_jun'] ?></td>
                            <td class="text-center"><?= $value[3]['2022']['jul_dec'] ?></td>
                            <td class="text-center"><?= $value[4]['2023']['jan_jun'] ?></td>
                            <td class="text-center"><?= $value[4]['2023']['jul_dec'] ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr>
                    <td class="text-right text-bold">Total</td>
                    <td></td>
                    <td class="text-center text-bold"><?= $sum_total_enrolled ?></td>
                    <td class="text-center text-bold"><?= $sum_2019_jan_jun ?></td>
                    <td class="text-center text-bold"><?= $sum_2019_jul_dec ?></td>
                    <td class="text-center text-bold"><?= $sum_2020_jan_jun ?></td>
                    <td class="text-center text-bold"><?= $sum_2020_jul_dec ?></td>
                    <td class="text-center text-bold"><?= $sum_2021_jan_jun ?></td>
                    <td class="text-center text-bold"><?= $sum_2021_jul_dec ?></td>
                    <td class="text-center text-bold"><?= $sum_2022_jan_jun ?></td>
                    <td class="text-center text-bold"><?= $sum_2022_jul_dec ?></td>
                    <td class="text-center text-bold"><?= $sum_2023_jan_jun ?></td>
                    <td class="text-center text-bold"><?= $sum_2023_jul_dec ?></td> 
                </tr>
            </table>
            <?php
        } else {
            if (isset($_GET['MeFaabsTrainingAttendanceSheetSearch'])) {
                echo "<p class='alert alert-warning'>No data was found for your search filter!</p>";
            }
        }
        ?>

    </div>
</div>
