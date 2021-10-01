<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeOutreachPersonsYoung */

$this->title = "View record";
$this->params['breadcrumbs'][] = ['label' => 'Logframe / Outreach persons young/not young records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$Baseline_young = 0;
$Baseline_not_young = 0;
$mid_target_not_young = 0;
$mid_target_young = 0;
$end_target_not_young = 0;
$end_target_young = 0;
$young_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Young - Number", 'indicator' => "Persons receiving services promoted or supported by the project"]);
$not_young_programme_targets_model = \backend\models\LogframeProgrammeTargets::findOne(['record_type' => "Not Young - Number", 'indicator' => "Persons receiving services promoted or supported by the project"]);
if (!empty($young_programme_targets_model)) {
    $Baseline_young = $young_programme_targets_model->baseline;
    $mid_target_young = $young_programme_targets_model->mid_term;
    $end_target_young = $young_programme_targets_model->end_target;
}
if (!empty($not_young_programme_targets_model)) {
    $Baseline_not_young = $not_young_programme_targets_model->baseline;
    $mid_target_not_young = $not_young_programme_targets_model->mid_term;
    $end_target_not_young = $not_young_programme_targets_model->end_target;
}
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <ol>
            <li><label>Indicator:</label>  Persons receiving services promoted or supported by the project</li>
            <?php if ($model->young_not_young === "Young") { ?>
                <li>
                    Log framework Programme target - Young numbers
                    <ul>
                        <?php
                        echo '<strong>Baseline: </strong>' . $Baseline_young . ', <strong>Mid-term: </strong>' . $mid_target_young . ", <strong>End target: </strong>" . $end_target_young;
                        ?>
                    </ul>
                </li>
                <?php } else{ ?>
                <li>
                    Log framework Programme target - Not Young numbers
                    <ul>
                        <?php
                        echo '<strong>Baseline: </strong>' . $Baseline_not_young . ', <strong>Mid-term: </strong>' . $mid_target_not_young . ", <strong>End target: </strong>" . $end_target_not_young;
                        ?>
                    </ul>
                </li>
                <?php } ?>
            </ol>
            <hr class="dotted"/>

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
            'young_not_young',
            'cumulative',
            'cumulative_percentage',
            [
            'label' => 'Created by',
            'value' => function($model) {
            $user = \backend\models\User::findOne(['id' => $model->created_by]);
            return !empty($user) ? $user->email : "";
            }
            ],
            [
            'label' => 'Updated by',
            'value' => function($model) {
            $user = \backend\models\User::findOne(['id' => $model->updated_by]);
            return !empty($user) ? $user->email : "";
            }
            ],
            [
            'label' => 'Updated at',
            'value' => function($model) {
            return date('d F Y H:i:s', $model->updated_at);
            }
            ],
            [
            'label' => 'Created at',
            'value' => function($model) {
            return date('d F Y H:i:s', $model->created_at);
            }
            ],
            ],
            ])
            ?>

    </div>
</div>
