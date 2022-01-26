<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeHouseholdHeadType */

$this->title = 'View record';
$this->params['breadcrumbs'][] = ['label' => 'Logframe / Outreach Household Head type', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$Baseline_females = 0;
$Baseline_males = 0;
$mid_target_males = 0;
$mid_target_females = 0;
$end_target_males = 0;
$end_target_females = 0;
$females_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Women-headed households - Number", 'indicator' => "1.a Corresponding number of households reached  "]);
$males_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Non-women-headed households - Number", 'indicator' => "1.a Corresponding number of households reached  "]);
if (!empty($females_programme_targets_model)) {
    $Baseline_females = $females_programme_targets_model->baseline;
    $mid_target_males = $females_programme_targets_model->mid_term;
    $end_target_males = $females_programme_targets_model->end_target;
}
if (!empty($males_programme_targets_model)) {
    $Baseline_males = $males_programme_targets_model->baseline;
    $mid_target_females = $males_programme_targets_model->mid_term;
    $end_target_females = $males_programme_targets_model->end_target;
}
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>
        <ol>
            <li><label>Indicator:</label>  1.a Corresponding number of households reached</li>
            <li>
                Log framework Programme target - Women-headed households - Number
                <ul>
                    <?php
                    echo '<strong>Baseline: </strong>' . $Baseline_females . ', <strong>Mid-term: </strong>' . $mid_target_females . ", <strong>End target: </strong>" . $end_target_females;
                    ?>
                </ul>
            </li>
            <li>
                Log framework Programme target - Non-women-headed households - Number
                <ul>
                    <?php
                    echo '<strong>Baseline: </strong>' . $Baseline_males . ', <strong>Mid-term: </strong>' . $mid_target_males . ", <strong>End target: </strong>" . $end_target_males;
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
                //'id',
                'year',
                'indicator:ntext',
                'yr_target',
                'yr_results',
                'headed_type',
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
