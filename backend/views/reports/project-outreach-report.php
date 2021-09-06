<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project outreach performance';
$this->params['breadcrumbs'][] = "Reports";
$this->params['breadcrumbs'][] = $this->title;
$province_id = "";
$district_id = "";
$year = date("Y");
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h4>Instructions</h4>

        <ol>
            <li>Apply a filter below to view 'Project outreach' reports for previous years</li>
            <?php
            if (empty(Yii::$app->user->identity->district_id)) {
                echo '<li>You can filter by Province, District and year</li>';
            }

            echo '<li>Click the "<span class="badge badge-success"><span class="fas fa-file-excel"></span> Download report</span>" button to download the report</li>';
            ?>
        </ol>
        <?php
        if (!empty(Yii::$app->user->identity->district_id)) {
            echo $this->render('_search_project_outreach', ['model' => $searchModel]);
        } else {
            echo $this->render('_search_project_outreach_1', ['model' => $searchModel]);
        }
        ?>
        <hr class="dotted short">
        <p class="float-right">
            <?php
            if (isset($_GET['ProjectOutreachSearch'])) {
                $province_id = !empty($_GET['ProjectOutreachSearch']['province_id']) ? $_GET['ProjectOutreachSearch']['province_id'] : "";
                $district_id = !empty($_GET['ProjectOutreachSearch']['district_id']) ? $_GET['ProjectOutreachSearch']['district_id'] : "";
                $year = !empty($_GET['ProjectOutreachSearch']['year']) ? $_GET['ProjectOutreachSearch']['year'] : "";
            }

            echo Html::a('<span class="fas fa-file-excel"></span> Download report',
                    ['reports/download-project-outreach'], [
                'data-method' => 'POST',
                'data-params' => [
                    'province_id' => $province_id,
                    'district_id' => $district_id,
                    'year' => $year,
                    'sub_component_21' => json_encode($sub_component_21),
                    'sub_component_22' => json_encode($sub_component_22),
                    'sub_component_23' => json_encode($sub_component_23),
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
                <th colspan="1">Outreach Indicator</th> 
                <th style="background:yellow" colspan="1" class="text-center">Q1</th>
                <th style="background:yellow" colspan="1" class="text-center">Q2</th> 
                <th style="background:yellow" colspan="1" class="text-center">Q3</th> 
                <th style="background:yellow" colspan="1" class="text-center">Q4</th> 
                <th style="background:lightgreen" colspan="1">Outreach- Cumulative (Since 2017)</th> 
            </tr>
            <tr>
                <th colspan="6">Component 2: Sustainable Agribusiness Partnerships</th> 
            </tr>
            <tr>
                <th colspan="6">Sub-component 2.1: Strategic Linkages of Graduating Subsistence Farmers</th> 
            </tr>
            <tr>
                <th colspan="6">1 Persons receiving services promoted or supported by the project</th> 
            </tr>
            <tr>
                <td>Females - Number</td>
                <td style="background:yellow"><?= $sub_component_21['q1']['female'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q2']['female'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q3']['female'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q4']['female'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_21['cumulative_since_2017_number_females'] ?></td>
            </tr>
            <tr>
                <td>Males - Number</td>
                <td style="background:yellow"><?= $sub_component_21['q1']['male'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q2']['male'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q3']['male'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q4']['male'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_21['cumulative_since_2017_number_males'] ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Total</td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_21['q1']['Total_female_male'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_21['q2']['Total_female_male'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_21['q3']['Total_female_male'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_21['q4']['Total_female_male'] ?></td>
                <td style="font-weight: bold;background:lightgreen"><?= $sub_component_21['cumulative_since_2017_number_females'] + $sub_component_21['cumulative_since_2017_number_males'] ?></td>
            </tr>
            <tr>
                <td>Young - Number</td>
                <td style="background:yellow"><?= $sub_component_21['q1']['young'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q2']['young'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q3']['young'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q4']['young'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_21['cumulative_since_2017_number_young'] ?></td>
            </tr>
            <tr>
                <td>Not Young - Number</td>
                <td style="background:yellow"><?= $sub_component_21['q1']['not_young'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q2']['not_young'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q3']['not_young'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q4']['not_young'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_21['cumulative_since_2017_number_not_young'] ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Total</td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_21['q1']['total_young_not_young'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_21['q2']['total_young_not_young'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_21['q3']['total_young_not_young'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_21['q4']['total_young_not_young'] ?></td>
                <td style="font-weight: bold;background:lightgreen"><?= $sub_component_21['cumulative_since_2017_number_young'] + $sub_component_21['cumulative_since_2017_number_not_young'] ?></td>
            </tr>
            <tr>
                <th colspan="6">1.a Corresponding number of households reached  </th> 
            </tr>
            <tr>
                <td>Women-headed households - Number</td>
                <td style="background:yellow"><?= $sub_component_21['q1']['women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q2']['women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q3']['women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q4']['women_headed_household'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_21['cumulative_since_2017_number_women_headed_households'] ?></td>
            </tr>
            <tr>
                <td><strong>Non-women</strong>-headed households - Number</td>
                <td style="background:yellow"><?= $sub_component_21['q1']['non_women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q2']['non_women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q3']['non_women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q4']['non_women_headed_household'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_21['cumulative_since_2017_number_non_women_headed_households'] ?></td>
            </tr>
            <tr>
                <th colspan="6">1.b Estimated corresponding total number of households’ members</th> 
            </tr>
            <tr>
                <td>Household members - Number of people</td>
                <td style="background:yellow"><?= $sub_component_21['q1']['number_household_members'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q2']['number_household_members'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q3']['number_household_members'] ?></td>
                <td style="background:yellow"><?= $sub_component_21['q4']['number_household_members'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_21['cumulative_since_2017_number_household_members'] ?></td>
            </tr>
            
            <tr>
                <th colspan="6">&nbsp;</th> 
            </tr>
            <tr>
                <th colspan="6">Sub-component 2.2: Enhancing Agro-Micro, Small & Medium Enterprises</th> 
            </tr>
            <tr>
                <th colspan="6">1 Persons receiving services promoted or supported by the project</th> 
            </tr>
            <tr>
                <td>Females - Number</td>
                <td style="background:yellow"><?= $sub_component_22['q1']['female'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q2']['female'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q3']['female'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q4']['female'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_22['cumulative_since_2017_number_females'] ?></td>
            </tr>
            <tr>
                <td>Males - Number</td>
                <td style="background:yellow"><?= $sub_component_22['q1']['male'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q2']['male'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q3']['male'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q4']['male'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_22['cumulative_since_2017_number_males'] ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Total</td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_22['q1']['Total_female_male'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_22['q2']['Total_female_male'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_22['q3']['Total_female_male'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_22['q4']['Total_female_male'] ?></td>
                <td style="font-weight: bold;background:lightgreen"><?= $sub_component_22['cumulative_since_2017_number_females'] + $sub_component_22['cumulative_since_2017_number_males'] ?></td>
            </tr>
            <tr>
                <td>Young - Number</td>
                <td style="background:yellow"><?= $sub_component_22['q1']['young'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q2']['young'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q3']['young'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q4']['young'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_22['cumulative_since_2017_number_young'] ?></td>
            </tr>
            <tr>
                <td>Not Young - Number</td>
                <td style="background:yellow"><?= $sub_component_22['q1']['not_young'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q2']['not_young'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q3']['not_young'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q4']['not_young'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_22['cumulative_since_2017_number_not_young'] ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Total</td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_22['q1']['total_young_not_young'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_22['q2']['total_young_not_young'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_22['q3']['total_young_not_young'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_22['q4']['total_young_not_young'] ?></td>
                <td style="font-weight: bold;background:lightgreen"><?= $sub_component_22['cumulative_since_2017_number_young'] + $sub_component_22['cumulative_since_2017_number_not_young'] ?></td>
            </tr>
            <tr>
                <th colspan="6">1.a Corresponding number of households reached  </th> 
            </tr>
            <tr>
                <td>Women-headed households - Number</td>
                <td style="background:yellow"><?= $sub_component_22['q1']['women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q2']['women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q3']['women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q4']['women_headed_household'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_22['cumulative_since_2017_number_women_headed_households'] ?></td>
            </tr>
            <tr>
                <td><strong>Non-women</strong>-headed households - Number</td>
                <td style="background:yellow"><?= $sub_component_22['q1']['non_women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q2']['non_women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q3']['non_women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q4']['non_women_headed_household'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_22['cumulative_since_2017_number_non_women_headed_households'] ?></td>
            </tr>
            <tr>
                <th colspan="6">1.b Estimated corresponding total number of households’ members</th> 
            </tr>
            <tr>
                <td>Household members - Number of people</td>
                <td style="background:yellow"><?= $sub_component_22['q1']['number_household_members'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q2']['number_household_members'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q3']['number_household_members'] ?></td>
                <td style="background:yellow"><?= $sub_component_22['q4']['number_household_members'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_22['cumulative_since_2017_number_household_members'] ?></td>
            </tr>
            
            <tr>
                <th colspan="6">&nbsp;</th> 
            </tr>
            <tr>
                <th colspan="6">Sub-component 2.3: Facilitating Pro-Smallholder Market-Pull Agribusiness Partnerships</th> 
            </tr>
            <tr>
                <th colspan="6">1 Persons receiving services promoted or supported by the project</th> 
            </tr>
            <tr>
                <td>Females - Number</td>
                <td style="background:yellow"><?= $sub_component_23['q1']['female'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q2']['female'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q3']['female'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q4']['female'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_23['cumulative_since_2017_number_females'] ?></td>
            </tr>
            <tr>
                <td>Males - Number</td>
                <td style="background:yellow"><?= $sub_component_23['q1']['male'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q2']['male'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q3']['male'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q4']['male'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_23['cumulative_since_2017_number_males'] ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Total</td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_23['q1']['Total_female_male'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_23['q2']['Total_female_male'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_23['q3']['Total_female_male'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_23['q4']['Total_female_male'] ?></td>
                <td style="font-weight: bold;background:lightgreen"><?= $sub_component_23['cumulative_since_2017_number_females'] + $sub_component_23['cumulative_since_2017_number_males'] ?></td>
            </tr>
            <tr>
                <td>Young - Number</td>
                <td style="background:yellow"><?= $sub_component_23['q1']['young'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q2']['young'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q3']['young'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q4']['young'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_23['cumulative_since_2017_number_young'] ?></td>
            </tr>
            <tr>
                <td>Not Young - Number</td>
                <td style="background:yellow"><?= $sub_component_23['q1']['not_young'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q2']['not_young'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q3']['not_young'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q4']['not_young'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_23['cumulative_since_2017_number_not_young'] ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Total</td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_23['q1']['total_young_not_young'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_23['q2']['total_young_not_young'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_23['q3']['total_young_not_young'] ?></td>
                <td style="font-weight: bold;background:yellow"><?= $sub_component_23['q4']['total_young_not_young'] ?></td>
                <td style="font-weight: bold;background:lightgreen"><?= $sub_component_23['cumulative_since_2017_number_young'] + $sub_component_23['cumulative_since_2017_number_not_young'] ?></td>
            </tr>
            <tr>
                <th colspan="6">1.a Corresponding number of households reached  </th> 
            </tr>
            <tr>
                <td>Women-headed households - Number</td>
                <td style="background:yellow"><?= $sub_component_23['q1']['women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q2']['women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q3']['women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q4']['women_headed_household'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_23['cumulative_since_2017_number_women_headed_households'] ?></td>
            </tr>
            <tr>
                <td><strong>Non-women</strong>-headed households - Number</td>
                <td style="background:yellow"><?= $sub_component_23['q1']['non_women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q2']['non_women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q3']['non_women_headed_household'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q4']['non_women_headed_household'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_23['cumulative_since_2017_number_non_women_headed_households'] ?></td>
            </tr>
            <tr>
                <th colspan="6">1.b Estimated corresponding total number of households’ members</th> 
            </tr>
            <tr>
                <td>Household members - Number of people</td>
                <td style="background:yellow"><?= $sub_component_23['q1']['number_household_members'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q2']['number_household_members'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q3']['number_household_members'] ?></td>
                <td style="background:yellow"><?= $sub_component_23['q4']['number_household_members'] ?></td>
                <td style="background:lightgreen"><?= $sub_component_23['cumulative_since_2017_number_household_members'] ?></td>
            </tr>
        </table>
    </div>
</div>
