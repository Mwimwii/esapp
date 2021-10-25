<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwpbFundsRequisitionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quarterly Operations Funds Requisition';
$this->params['breadcrumbs'][] = $this->title;
$template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();

$mo1 = "";
$mo2 = "";
$mo3 = "";
if ($template_model->quarter == 1) {
    $mo1 = "Jan";
    $mo2 = "Feb";
    $mo3 = "Mar";
}
if ($template_model->quarter == 2) {
    $mo1 = "Apr";
    $mo2 = "May";
    $mo3 = "Jun";
}
if ($template_model->quarter == 3) {
    $mo1 = "Jul";
    $mo2 = "Aug";
    $mo3 = "Sep";
}
if ($template_model->quarter == 2) {
    $mo1 = "Oct";
    $mo2 = "Nov";
    $mo3 = "Dec";
}
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>
<?php
echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['qofrd','id'=>0,'id2'=>0,'status'=>1], [
                    'title' => 'back',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                ]);


       

?>
</div>
<div class="card card-success card-outline">
    <div class="card-body">

        <ol> 
            <?php
            $time = new \DateTime('now');
            $today = $time->format('Y-m-d');
            if ($id3 == 1) {

                $dist = "";
                $district = \backend\models\Districts::findOne(['id' => $id]);

                if (!empty($district)) {
                    $dist = $district->name;
                }
                $pro = "";
                $province = \backend\models\Provinces::findOne(['id' => $district->province_id]);

                if (!empty($province)) {
                    $pro = $province->name;
                }
                echo '<li><b>E-SAPP PCO/Unit/Ministry Department/Service Provider</b>: ……………………………………………………………………………………</li>
            <li><b>Province (s): </b>' . $pro . '……………………………………………………. <b>District (s): </b>' . $dist . ' ……………………………………………………</li>
            <li><b>Reference Period: (e.g. Quarter 1……): </b> Quarter ' . $template_model->quarter . '  <b>Date: </b>' . $today . '…………………………….</li>';
            } else if ($id3 == 2) {
                $cost_centre = "";
                $cc = \backend\models\AwpbCostCentre::findOne(['id' => $id]);

                if (!empty($cc)) {
                    $cost_centre = $cc->name;
                }
                echo '<li><b>E-SAPP PCO/Unit/Ministry Department/Service Provider: </b>' . $cost_centre . '……………………………………………………………………………………</li>
            <li><b>Province (s) </b>: ……………………………………………………. <b>District (s)</b>: ……………………………………………………</li>
             <li><b>Reference Period: (e.g. Quarter 1……): </b> Quarter ' . $template_model->quarter . '  <b>Date: </b>' . $today . '…………………………….</li>';
            }
            ?>
        </ol>

        <hr class="dotted short">
        <table class="table table-bordered table-sm" style="overflow-x: auto;white-space: block;overflow: scroll;">

            <tbody>

<?php
$components = \backend\models\AwpbComponent::find()->where(['type' => 1])
        ->orderBy(['code' => SORT_ASC])
        ->all();

if (!empty($components)) {
     $grand_total = 0.0;
    $main_component_total = 0.0;
    $parent_component_id = "";
    foreach ($components as $component) {


        $component_total = 0.0;
        $main_component = "";
        $parent_component = \backend\models\AwpbComponent::findOne(['id' => $component->parent_component_id]);

        if (!empty($parent_component)) {
            $main_component = $parent_component->code;
        }


        echo ' <tr>
                    <td rowspan="2"><strong>Comp #</strong></td>
                    <td rowspan="2"><strong>Sub comp #</strong></td>
                    <td rowspan="2"><strong>Activity Description</strong></td>
                    <td rowspan="2"><strong>Activity/Output Target for Quarter</strong></td>
                    <td rowspan="2"><strong>Unit Cost</strong></td>
                    <td colspan="3"><strong>Activities Cost Input Schedule & Quantities</strong></td>
                    <td colspan="1"><strong>Unit</strong></td>
                    <td colspan="4"><strong>Current Budget Estimate (K’000)</strong></td>
                </tr>
                <tr>';
        ?>
                    <td><strong><?= $mo1 ?></strong></td>
                    <td><strong><?= $mo2 ?></strong></td>
                    <td><strong><?= $mo3 ?></strong></td>

                    <td><strong>K'000</strong></td>
                    <td><strong><?= $mo1 ?></strong></td>
                    <td><strong><?= $mo2 ?></strong></td>
                    <td><strong><?= $mo3 ?></strong></td>
                    <td><strong>Total</strong></td>

                    </tr>


                    <tr>
                        <td><strong><?= $main_component ?></strong></td>

                        <td><strong><?= $component->code ?></strong></td>
                        <td colspan="2"><strong><?= $component->name ?></strong></td>
                        <td><strong></strong></td>
                        <td><strong></strong></td> 
                        <td><strong></strong></td> 
                        <td><strong></strong></td>
                        <td><strong></strong></td> 
                        <td><strong></strong></td>
                        <td><strong></strong></td>
                        <td><strong></strong></td>
                        <td><strong></strong></td>

                    </tr>
                    <tr>
        <?php
        $output = "";
        $output_model = \backend\models\AwpbOutput::findOne(['component_id' => $component->id]);

        if (!empty($output_model)) {
            $output = $output_model->code . ' ' . $output_model->name;
        }
        ?>
                        <td><strong></strong></td>

                        <td><strong></strong></td>
                        <td colspan="2"><strong>Output <?= $output ?></strong></td>
                        <td><strong></strong></td>
                        <td><strong></strong></td> 
                        <td><strong></strong></td> 
                        <td><strong></strong></td>
                        <td><strong></strong></td> 
                        <td><strong></strong></td>
                        <td><strong></strong></td> 
                        <td><strong></strong></td>
                        <td><strong></strong></td>

                    </tr>

        <?php
        if ($id3 == 1) {
            $awpb_budgets = \backend\models\AwpbBudget::find()->where(['component_id' => $component->id])->andWhere(['awpb_template_id' => $template_model->id])->andWhere(['district_id' => $id])->all();
        } else if ($id3 == 2) {
            $awpb_budgets = \backend\models\AwpbBudget::find()->where(['component_id' => $component->id])->andWhere(['awpb_template_id' => $template_model->id])->andWhere(['cost_centre_id' => $id])->all();
        } else {

            $awpb_budgets = \backend\models\AwpbBudget::find()->where(['component_id' => 0])->andWhere(['awpb_template_id' => 0])->andWhere(['cost_centre_id' => 0])->all();
        }
        if (!empty($awpb_budgets)) {

            foreach ($awpb_budgets as $budget) {
                $target=0;
                if ($template_model->quarter == 1) {
    $target = $budget->quarter_one_quantity;
   
}
if ($template_model->quarter == 2) {
   $target = $budget->quarter_two_quantity;
}
if ($template_model->quarter == 3) {
    $target = $budget->quarter_three_quantity;
}
if ($template_model->quarter == 2) {
     $target = $budget->quarter_four_quantity;
}
                
                $activity = "";
                $activity_model = \backend\models\AwpbActivity::findOne(['id' => $budget->activity_id]);
//$status = $model->status;
                if (!empty($activity_model)) {
                    $activity = $activity_model->activity_code . ' ' . $activity_model->name;
                }
                echo ' </tr> <td><strong></strong></td>

                        <td><strong></strong></td>
                        <td colspan="1"><strong>Activity ' . $activity . '</strong></td>
                        <td><strong>'.$target.'</strong></td>
                        <td><strong></strong></td> 
                        <td><strong></strong></td> 
                        <td><strong></strong></td>
                        <td><strong></strong></td> 
                        <td><strong></strong></td>
                        <td><strong></strong></td>
                        <td><strong></strong></td>
                        <td><strong></strong></td>
                        </tr>'
                ;

                //   $awpb_funds_requisition = \backend\models\AwpbFundsRequisition::find()->where(['budget_id' => $budget->id])->andWhere(['quarter_number' => $template_model->quarter])->all();

                if ($id3 == 1) {
                    $awpb_funds_requisition = \backend\models\AwpbFundsRequisition::find()->where(['budget_id' => $budget->id])
                            ->andWhere(['quarter_number' => $template_model->quarter])
                            ->andWhere(['awpb_template_id' => $template_model->id])->andWhere(['district_id' => $id])
                            ->all();
                } else if ($id3 == 2) {
                    $awpb_funds_requisition = \backend\models\AwpbFundsRequisition::find()->where(['budget_id' => $budget->id])
                            ->andWhere(['quarter_number' => $template_model->quarter])
                            ->andWhere(['awpb_template_id' => $template_model->id])->andWhere(['cost_centre_id' => $id])
                            ->all();
                } else {
                    $awpb_funds_requisition = \backend\models\AwpbFundsRequisition::find()->where(['budget_id' => 0])
                            ->andWhere(['quarter_number' => 0])
                            ->andWhere(['awpb_template_id' => 0])->andWhere(['cost_centre_id' => 0])
                            ->all();
                }
                if (!empty($awpb_funds_requisition)) {

                    foreach ($awpb_funds_requisition as $funds_requisition) {

                        $unit = "";
                        $unit_of_me = \backend\models\AwpbUnitOfMeasure::findOne(['id' => $funds_requisition->unit_of_measure_id]);

                        if (!empty($unit_of_me)) {
                            $unit = $unit_of_me->name;
                        }
                        echo ' </tr> <td><strong></strong></td>

                        <td><strong></strong></td>
                        <td colspan="2">Input ' . $funds_requisition->name . '</td>
                        <td>' . $unit . '</strong></td>
                        <td style="text-align:right">' . number_format((float) $funds_requisition->mo_1, 2, '.', '') . '</td> 
                        <td style="text-align:right">' . number_format((float) $funds_requisition->mo_2, 2, '.', '') . '</td> 
                        <td style="text-align:right">' . number_format((float) $funds_requisition->mo_3, 2, '.', '') . '</td>
                        <td style="text-align:right">' . number_format((float) $funds_requisition->unit_cost, 2, '.', '') . '</td> 
                        <td style="text-align:right">' . number_format((float) $funds_requisition->mo_1_amount, 2, '.', '') . '</td>
                        <td style="text-align:right">' . number_format((float) $funds_requisition->mo_2_amount, 2, '.', '') . '</td>
                        <td style="text-align:right">' . number_format((float) $funds_requisition->mo_3_amount, 2, '.', '') . '</td>
                        <td style="text-align:right">' . number_format((float) $funds_requisition->quarter_amount, 2, '.', '') . '</td>
                        </tr>'
                        ;
                        $component_total = $component_total + $funds_requisition->quarter_amount;
                    }
                }
            }
            $main_component_total = $component_total + $main_component_total;
        }
        ?>

                    <tr>
                        <td colspan="11" style="text-align:right"><strong>Sub-comp <?= $component->code ?> Sub-total:</strong> </td>
                        <td colspan="2" style="text-align:right"><strong> <?= number_format((float) $component_total, 2, '.', '') ?> </strong></td>

                    </tr> 
                    <?php
                    if ($parent_component_id == $component->parent_component_id) {
                        echo'  <tr>
                        <td colspan="11" style="text-align:right"><strong>Component ' . $parent_component->code . ' total:</strong> </td>
                        <td colspan="2" style="text-align:right"><strong> ' . number_format((float) $main_component_total, 2, '.', '') . ' </strong></td>

                    </tr> ';
                        $grand_total =   $grand_total + $main_component_total;
                        $main_component_total = 0.0;
                    }
                    $parent_component_id = $component->parent_component_id;
                    
                }
            }
            ?>
  <tr>
                         <td colspan="11" style="text-align:right"><strong>Grand Total:</strong> </td>
                        <td colspan="2" style="text-align:right"><strong> <?= number_format((float) $grand_total, 2, '.', '') ?> </strong></td>

                    </tr> 
            </tbody>
        </table>
    </div>
</div>
