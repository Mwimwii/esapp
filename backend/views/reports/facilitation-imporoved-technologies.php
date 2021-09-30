<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Facilitation of Improved Technologies/Best Practices';
$this->params['breadcrumbs'][] = "Reports";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h4>Instructions</h4>
        <ol>
            <li>Apply a filter below to view 'Facilitation of Improved Technologies/Best Practices' reports</li>
            <?php
            if (empty(Yii::$app->user->identity->district_id)) {
                echo '<li>Province, District and Camp are required before you can filter</li>';
            }
            if (isset($_GET['MeFaabsTrainingAttendanceSheetSearch'])) {
                echo '<li>Click the "<span class="badge badge-success"><span class="fas fa-file-excel"></span> Download report</span>" button to download the report</li>';
            }
            ?>
        </ol>
        <?php
        if (!empty(Yii::$app->user->identity->district_id)) {
            echo $this->render('_search_facilitation_improved_technologies_1', ['model' => $searchModel]);
        } else {
            echo $this->render('_search_facilitation_improved_technologies', ['model' => $searchModel]);
        }
        ?>

        <hr class="dotted short">
        <?php
        if (isset($_GET['MeFaabsTrainingAttendanceSheetSearch'])) {
            $province_id = !empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['province_id']) ? $_GET['MeFaabsTrainingAttendanceSheetSearch']['province_id'] : "";
            $district_id = !empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['district_id']) ? $_GET['MeFaabsTrainingAttendanceSheetSearch']['district_id'] : "";
            $camp_id = !empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['camp_id']) ? $_GET['MeFaabsTrainingAttendanceSheetSearch']['camp_id'] : "";
            $year = !empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['year']) ? $_GET['MeFaabsTrainingAttendanceSheetSearch']['year'] : "";
            $quarter = !empty($_GET['MeFaabsTrainingAttendanceSheetSearch']['quarter']) ? $_GET['MeFaabsTrainingAttendanceSheetSearch']['quarter'] : "";
            ?>
<<<<<<< HEAD
              <p class="float-right">
=======
            <p class="float-right">
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
            <p>
                <?php
                echo Html::a('<span class="fas fa-file-excel"></span> Download report',
                        ['reports/download-fit-report'], [
                    'data-method' => 'POST',
                    'data-params' => [
                        'province_id' => $province_id,
                        'district_id' => $district_id,
                        'camp_id' => $camp_id,
                        'year' => $year,
                        'quarter' => $quarter,
                        'indicator_1' => json_encode($indicator_1),
                        'indicator_2' => json_encode($indicator_2),
                        'indicator_3' => json_encode($indicator_3),
                        'indicator_4' => json_encode($indicator_4),
                        'indicator_5' => json_encode($indicator_5),
                        'indicator_6' => json_encode($indicator_6),
                        'indicator_7' => json_encode($indicator_7),
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
                    <th colspan="1"></th> 
                    <th colspan="5" class="text-center">Sub-component 2.1</th>
                    <th colspan="5">Sub-component 2.2</th> 
                </tr>
                <tr>
                    <td style="font-weight: bold;">Output level indicator</td>
                    <td># Female</td>
                    <td># Male</td>
                    <td>Total(Female+Male)</td>
                    <td>Women heads</td>
                    <td>Youth</td>
                    <td># Female</td>
                    <td># Male</td>
                    <td>Total(Female+Male)</td>
                    <td>Women heads</td>
                    <td>Youth</td>
                </tr>
                <tr>
                    <td style="width:30%;">Number of smallholders trained in the use of improved production technologies & best practices to enhance productivity that allow production to comply with market requirements (at least 3 improved production technologies facilitated)</td>
                    <td><?= $indicator_1['subcomp_21']['female'] ?></td>
                    <td><?= $indicator_1['subcomp_21']['male'] ?></td>
                    <td><?= $indicator_1['subcomp_21']['Total_female_male'] ?></td>
                    <td><?= $indicator_1['subcomp_21']['women_heads'] ?></td>
                    <td><?= $indicator_1['subcomp_21']['Youth'] ?></td>
                    <td><?= $indicator_1['subcomp_22']['female'] ?></td>
                    <td><?= $indicator_1['subcomp_22']['male'] ?></td>
                    <td><?= $indicator_1['subcomp_22']['Total_female_male'] ?></td>
                    <td><?= $indicator_1['subcomp_22']['women_heads'] ?></td>
                    <td><?= $indicator_1['subcomp_22']['Youth'] ?></td>
                </tr>
                <tr>
                    <td>Number of smallholders trained in improved Post-harvest technologies (at least 2 improved post-harvest technologies)</td>
                    <td><?= $indicator_2['subcomp_21']['female'] ?></td>
                    <td><?= $indicator_2['subcomp_21']['male'] ?></td>
                    <td><?= $indicator_2['subcomp_21']['Total_female_male'] ?></td>
                    <td><?= $indicator_2['subcomp_21']['women_heads'] ?></td>
                    <td><?= $indicator_2['subcomp_21']['Youth'] ?></td>
                    <td><?= $indicator_2['subcomp_22']['female'] ?></td>
                    <td><?= $indicator_2['subcomp_22']['male'] ?></td>
                    <td><?= $indicator_2['subcomp_22']['Total_female_male'] ?></td>
                    <td><?= $indicator_2['subcomp_22']['women_heads'] ?></td>
                    <td><?= $indicator_2['subcomp_22']['Youth'] ?></td>
                </tr>
                <tr>
                    <td>Number of smallholders who have been trained in improved pre- and Post-harvest technologies (at least 2 improved post-harvest technologies) to minimize losses and increase market value of their produce</td>
                    <td><?= $indicator_3['subcomp_21']['female'] ?></td>
                    <td><?= $indicator_3['subcomp_21']['male'] ?></td>
                    <td><?= $indicator_3['subcomp_21']['Total_female_male'] ?></td>
                    <td><?= $indicator_3['subcomp_21']['women_heads'] ?></td>
                    <td><?= $indicator_3['subcomp_21']['Youth'] ?></td>
                    <td><?= $indicator_3['subcomp_22']['female'] ?></td>
                    <td><?= $indicator_3['subcomp_22']['male'] ?></td>
                    <td><?= $indicator_3['subcomp_22']['Total_female_male'] ?></td>
                    <td><?= $indicator_3['subcomp_22']['women_heads'] ?></td>
                    <td><?= $indicator_3['subcomp_22']['Youth'] ?></td>
                </tr>
                <tr>
                    <td>Number of producer organizations/cooperatives/marketing groups established or strengthened [Strengthening of coordination & business models]</td>
                    <td><?= $indicator_4['subcomp_21']['female'] ?></td>
                    <td><?= $indicator_4['subcomp_21']['male'] ?></td>
                    <td><?= $indicator_4['subcomp_21']['Total_female_male'] ?></td>
                    <td><?= $indicator_4['subcomp_21']['women_heads'] ?></td>
                    <td><?= $indicator_4['subcomp_21']['Youth'] ?></td>
                    <td><?= $indicator_4['subcomp_22']['female'] ?></td>
                    <td><?= $indicator_4['subcomp_22']['male'] ?></td>
                    <td><?= $indicator_4['subcomp_22']['Total_female_male'] ?></td>
                    <td><?= $indicator_4['subcomp_22']['women_heads'] ?></td>
                    <td><?= $indicator_4['subcomp_22']['Youth'] ?></td>
                </tr>
                <tr>
                    <td>Number of smallholder producers (desegregated by gender) in organizations/cooperatives/marketing groups trained in crucial aspects for inclusion in VC i.e. identification of partnership opportunities, negotiation, market linkages, business management, governance etc [Strengthening of coordination & business models] </td>
                    <td><?= $indicator_5['subcomp_21']['female'] ?></td>
                    <td><?= $indicator_5['subcomp_21']['male'] ?></td>
                    <td><?= $indicator_5['subcomp_21']['Total_female_male'] ?></td>
                    <td><?= $indicator_5['subcomp_21']['women_heads'] ?></td>
                    <td><?= $indicator_5['subcomp_21']['Youth'] ?></td>
                    <td><?= $indicator_5['subcomp_22']['female'] ?></td>
                    <td><?= $indicator_5['subcomp_22']['male'] ?></td>
                    <td><?= $indicator_5['subcomp_22']['Total_female_male'] ?></td>
                    <td><?= $indicator_5['subcomp_22']['women_heads'] ?></td>
                    <td><?= $indicator_5['subcomp_22']['Youth'] ?></td>
                </tr>
                <tr>
                    <td>Number of local service providers (farm & non-farm) strengthened and/or trained to provide services that allow production to meet market requirements [Strengthening of coordination & business models]</td>
                    <td><?= $indicator_6['subcomp_21']['female'] ?></td>
                    <td><?= $indicator_6['subcomp_21']['male'] ?></td>
                    <td><?= $indicator_6['subcomp_21']['Total_female_male'] ?></td>
                    <td><?= $indicator_6['subcomp_21']['women_heads'] ?></td>
                    <td><?= $indicator_6['subcomp_21']['Youth'] ?></td>
                    <td><?= $indicator_6['subcomp_22']['female'] ?></td>
                    <td><?= $indicator_6['subcomp_22']['male'] ?></td>
                    <td><?= $indicator_6['subcomp_22']['Total_female_male'] ?></td>
                    <td><?= $indicator_6['subcomp_22']['women_heads'] ?></td>
                    <td><?= $indicator_6['subcomp_22']['Youth'] ?></td>
                </tr>
                <tr>
                    <td>C..1.8 Number of Households reached with targeted support to improve their nutrition</td>
                    <td><?= $indicator_7['subcomp_21']['female'] ?></td>
                    <td><?= $indicator_7['subcomp_21']['male'] ?></td>
                    <td><?= $indicator_7['subcomp_21']['Total_female_male'] ?></td>
                    <td><?= $indicator_7['subcomp_21']['women_heads'] ?></td>
                    <td><?= $indicator_7['subcomp_21']['Youth'] ?></td>
                    <td><?= $indicator_7['subcomp_22']['female'] ?></td>
                    <td><?= $indicator_7['subcomp_22']['male'] ?></td>
                    <td><?= $indicator_7['subcomp_22']['Total_female_male'] ?></td>
                    <td><?= $indicator_7['subcomp_22']['women_heads'] ?></td>
                    <td><?= $indicator_7['subcomp_22']['Youth'] ?></td>
                </tr>
            </table>
            <?php
        }
        ?>

    </div>
</div>
