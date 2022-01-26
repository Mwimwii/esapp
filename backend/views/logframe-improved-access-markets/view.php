<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\models\LogframeDeveObjectivesHouseholdProfitableprojectSupport */

$this->title = "View record";
$this->params['breadcrumbs'][] = ['label' => 'Logframe / Improved Access to Markets/Storage Facilities records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
if ($model->category == "Category A") {
    $desc = "Category A Percentage";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Category A Improved access - Percentage", 'indicator' => "2.2.6 (Number) Percentage of persons/households reporting improved physical access to markets, processing and storage facilities"]);
}
if ($model->category == "Category B") {
    $desc = "Category B Percentage";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Category B Improved access - Percentage", 'indicator' => "2.2.6 (Number) Percentage of persons/households reporting improved physical access to markets, processing and storage facilities"]);
}
if ($model->category == "Category C") {
    $desc = "Category C Percentage";
    $programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Category C Improved access - Percentage", 'indicator' => "2.2.6 (Number) Percentage of persons/households reporting improved physical access to markets, processing and storage facilities"]);
}
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>
        <ol>
            <li><label>Indicator:</label>  2.2.6 (Number) Percentage of persons/households reporting improved physical access to markets, processing and storage facilities</li>
            <li>
                Log framework Programme target - <?= $desc ?>
                <ul>
                    <?php
                    echo '<strong>Baseline: </strong>' . $programme_targets_model->baseline . '%, <strong>Mid-term: </strong>' . $programme_targets_model->mid_term . "%, <strong>End target: </strong>" . $programme_targets_model->end_target . "%";
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
