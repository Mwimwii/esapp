<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeHouseAssets */

$this->title = "View record";
$this->params['breadcrumbs'][] = ['label' => 'Logframe / Project Goals Household Assets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$programme_targets_model = "";
$desc = "";

if ($model->asset == "Bicycle" && $model->category == "Category A") {
    $desc = "Bicycle - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "bicycle - Percentage", 'indicator' => "Increase in household assets (%) - Category A"]);
}
if ($model->asset == "Bicycle" && $model->category == "Category B") {
    $desc = "Bicycle - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "bicycle - Percentage- Cat B", 'indicator' => "Increase in household assets (%) - Category B"]);
}
if ($model->asset == "Bicycle" && $model->category == "Category C") {
    $desc = "Bicycle - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "bicycle - Percentage- Cat C", 'indicator' => "Increase in household assets (%) - Category C"]);
}
if ($model->asset == "Hoe" && $model->category == "Category A") {
    $desc = "Hoe - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "hoe - Percentage", 'indicator' => "Increase in household assets (%) - Category A"]);
}
if ($model->asset == "Hoe" && $model->category == "Category B") {
    $desc = "Hoe - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "hoe - Percentage- Cat B", 'indicator' => "Increase in household assets (%) - Category B"]);
}
if ($model->asset == "Hoe" && $model->category == "Category C") {
    $desc = "Hoe - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "hoe - Percentage- Cat C", 'indicator' => "Increase in household assets (%) - Category C"]);
}
if ($model->asset == "Radio" && $model->category == "Category A") {
    $desc = "Radio - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "radio - Percentage", 'indicator' => "Increase in household assets (%) - Category A"]);
}
if ($model->asset == "Radio" && $model->category == "Category B") {
    $desc = "Radio - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "radio - Percentage- Cat B", 'indicator' => "Increase in household assets (%) - Category B"]);
}
if ($model->asset == "Radio" && $model->category == "Category C") {
    $desc = "Radio - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "radio - Percentage- Cat C", 'indicator' => "Increase in household assets (%) - Category C"]);
}
if ($model->asset == "Plough" && $model->category == "Category A") {
    $desc = "Plough - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "plough - Percentage", 'indicator' => "Increase in household assets (%) - Category A"]);
}
if ($model->asset == "Plough" && $model->category == "Category B") {
    $desc = "Plough - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "plough - Percentage- Cat B", 'indicator' => "Increase in household assets (%) - Category B"]);
}
if ($model->asset == "Plough" && $model->category == "Category C") {
    $desc = "Plough - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "plough - Percentage- Cat C", 'indicator' => "Increase in household assets (%) - Category C"]);
}
if ($model->asset == "Mobile Phone" && $model->category == "Category A") {
    $desc = "Mobile Phone - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "mobile phone - Percentage", 'indicator' => "Increase in household assets (%) - Category A"]);
}
if ($model->asset == "Mobile Phone" && $model->category == "Category B") {
    $desc = "Mobile Phone - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "mobile phone - Percentage- Cat B", 'indicator' => "Increase in household assets (%) - Category B"]);
}
if ($model->asset == "Mobile Phone" && $model->category == "Category C") {
    $desc = "Mobile Phone - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "mobile phone - Percentage- Cat C", 'indicator' => "Increase in household assets (%) - Category C"]);
}
if ($model->asset == "Axe" && $model->category == "Category A") {
    $desc = "Axe - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "axe - Percentage", 'indicator' => "Increase in household assets (%) - Category A"]);
}
if ($model->asset == "Axe" && $model->category == "Category B") {
    $desc = "Axe - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "axe - Percentage- Cat B", 'indicator' => "Increase in household assets (%) - Category B"]);
}
if ($model->asset == "Axe" && $model->category == "Category C") {
    $desc = "Axe - Percentage (%)";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "axe - Percentage - Cat C", 'indicator' => "Increase in household assets (%) - Category C"]);
}
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>
        <ol>
            <li><label>Indicator:</label> Increase in household assets</li>
            <li>
                Log framework Programme target - <?= $desc ?>
                <ul>
                    <?php
                    echo '<strong>Baseline: </strong>' . $programme_targets_model->baseline . '%, <strong>Mid-term: </strong>' . $programme_targets_model->mid_term . "%, <strong>End target: </strong>" . $programme_targets_model->end_target."%";
                    ?>
                </ul>
            </li>
        </ol>

        <hr class="dotted"/>
        </p>
        <p>
            <?php
            if (\backend\models\User::userIsAllowedTo('Submit logframe data')) {
                echo Html::a('<span class="fas fa-edit fa-2x"></span>', ['update', 'id' => $model->id], [
                    'title' => 'Update record',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                ]);

                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

                echo Html::a(
                        '<span class="fas fa-trash fa-2x"></span>', ['delete', 'id' => $model->id], [
                    'title' => 'Remove record',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'data' => [
                        'confirm' => 'Are you sure you want to remove this record?',
                        'method' => 'post',
                    ],
                    'style' => "padding:5px;",
                        //'class' => 'bt btn-lg'
                        ]
                );
            }
            //This is a hack, just to use pjax for the delete confirm button
            $query = \backend\models\User::find()->where(['id' => '-2']);
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
            ]);
            GridView::widget([
                'dataProvider' => $dataProvider,
            ]);
            ?>
        </p>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
               // 'id',
                'year',
                'indicator:ntext',
                'yr_target',
                'yr_results',
                'asset',
                'category',
                'cumulative',
                'cumulative_percentage',
                [
                    'label' => 'Created by',
                    'value' => function ($model) {
                        $user = \backend\models\User::findOne(['id' => $model->created_by]);
                        return !empty($user) ? $user->email : "";
                    }
                ],
                [
                    'label' => 'Updated by',
                    'value' => function ($model) {
                        $user = \backend\models\User::findOne(['id' => $model->updated_by]);
                        return !empty($user) ? $user->email : "";
                    }
                ],
                [
                    'label' => 'Updated at',
                    'value' => function ($model) {
                        return date('d F Y H:i:s', $model->updated_at);
                    }
                ],
                [
                    'label' => 'Created at',
                    'value' => function ($model) {
                        return date('d F Y H:i:s', $model->created_at);
                    }
                ],
            ],
        ])
        ?>

    </div>
</div>
