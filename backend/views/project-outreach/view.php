<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectOutreach */

$this->title = "View record";
$this->params['breadcrumbs'][] = ['label' => 'Project outreach records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>
            <?php
            if (User::userIsAllowedTo('Submit project outreach records')) {
                echo Html::a(
                        '<span class="fa fa-edit"></span>', ['update', 'id' => $model->id], [
                    'title' => 'Edit record',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'data-pjax' => '0',
                    'style' => "padding:10px;",
                    'class' => 'bt btn-lg'
                        ]
                );
            }
            if (User::userIsAllowedTo('Remove project outreach records')) {
                echo Html::a(
                        '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                    'title' => 'Remove record',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'data' => [
                        'confirm' => 'Are you sure you want to remove this record?',
                        'method' => 'post',
                    ],
                    'style' => "padding:10px;",
                    'class' => 'bt btn-lg'
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
                'component:ntext',
                'sub_component:ntext',
                // 'province_id',
                //'district_id',
                'year',
                'quarter',
                'number_females',
                'number_males',
                'number_young',
                'number_not_young',
                'number_women_headed_households',
                'number_households',
                'number_household_members',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            ],
        ])
        ?>

    </div>
</div>
