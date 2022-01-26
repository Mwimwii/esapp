<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeHouseholdMembers */

$this->title = "View Record";
$this->params['breadcrumbs'][] = ['label' => 'Logframe / Output Investments through Pro-Smallholder MGF records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$Baseline = 0;
$mid_target = 0;
$end_target = 0;

$programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne([
    'record_type' => "investments - Money (USD)", 
    'indicator' => "Total value of investments supported through Pro-Smallholder Market Pull Agribusiness Partnership matching grants (US$)"]);
if (!empty($programme_targets_model)) {
    $Baseline = $programme_targets_model->baseline;
    $mid_target = $programme_targets_model->mid_term;
    $end_target = $programme_targets_model->end_target;
}
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>
         <ol>
            <li><label>Indicator:</label>Total value of investments supported through Pro-Smallholder Market Pull Agribusiness Partnership matching grants (US$)</li>
            <li>
                Log framework Programme target - Investments - Money (USD)
                <ul>
                    <?php
                    echo '<strong>Baseline: </strong>$' . $Baseline . ', <strong>Mid-term: </strong>$' . $mid_target . ", <strong>End target: </strong>$" . $end_target;
                    ?>
                </ul>
            </li>
        </ol>
        <hr class="dotted"/>
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
                [
                    'attribute' => 'yr_target',
                    'value' => function ($model) {
                       return "$".$model->yr_target;
                    }
                ],
                [
                    'attribute' => 'yr_results',
                    'value' => function ($model) {
                       return "$".$model->yr_results;
                    }
                ],
                [
                    'attribute' => 'cumulative',
                    'value' => function ($model) {
                       return "$".$model->cumulative;
                    }
                ],
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
