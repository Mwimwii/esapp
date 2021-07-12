<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbFundsRequisition */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Awpb Funds Requisitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="awpb-funds-requisition-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'component_id',
            'output_id',
            'activity_id',
            'awpb_template_id',
            'indicator_id',
            'name',
            'unit_cost',
            'mo_1',
            'mo_2',
            'mo_3',
            'mo_4',
            'mo_5',
            'mo_6',
            'mo_7',
            'mo_8',
            'mo_9',
            'mo_10',
            'mo_11',
            'mo_12',
            'quarter_one_quantity',
            'quarter_two_quantity',
            'quarter_three_quantity',
            'quarter_four_quantity',
            'total_quantity',
            'mo_1_amount',
            'mo_2_amount',
            'mo_3_amount',
            'mo_4_amount',
            'mo_5_amount',
            'mo_6_amount',
            'mo_7_amount',
            'mo_8_amount',
            'mo_9_amount',
            'mo_10_amount',
            'mo_11_amount',
            'mo_12_amount',
            'quarter_one_amount',
            'quarter_two_amount',
            'quarter_three_amount',
            'quarter_four_amount',
            'total_amount',
            'mo_1_actual',
            'mo_2_actual',
            'mo_3_actual',
            'mo_4_actual',
            'mo_5_actual',
            'mo_6_actual',
            'mo_7_actual',
            'mo_8_actual',
            'mo_9_actual',
            'mo_10_actual',
            'mo_11_actual',
            'mo_12_actual',
            'quarter_one_actual',
            'quarter_two_actual',
            'quarter_three_actual',
            'quarter_four_actual',
            'status',
            'number_of_females',
            'number_of_males',
            'number_of_young_people',
            'number_of_not_young_people',
            'number_of_women_headed_households',
            'number_of_non_women_headed_households',
            'number_of_household_members',
            'number_of_females_actual',
            'number_of_males_actual',
            'number_of_young_people_actual',
            'number_of_not_young_people_actual',
            'number_of_women_headed_households_actual',
            'number_of_non_women_headed_households_actual',
            'number_of_household_members_actual',
            'cost_centre_id',
            'camp_id',
            'district_id',
            'province_id',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
