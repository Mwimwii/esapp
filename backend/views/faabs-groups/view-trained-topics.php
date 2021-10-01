<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\touchspin\TouchSpin;
use kartik\grid\GridView;

$_dataProvider = new \yii\data\ActiveDataProvider([
    'query' => backend\models\MeFaabsTrainingAttendanceSheet::find()
            ->where(['faabs_group_id' => $faabs])
            ->andWhere(['farmer_id' => $id]),
        ]);

echo GridView::widget([
    'dataProvider' => $_dataProvider,
    'condensed' => true,
    'responsive' => true,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        // 'id',
        [
            'enableSorting' => false,
            'contentOptions' => ['class' => 'text-left'],
            'attribute' => 'planned_activity_id',
            'label' => 'Topic',
            //'readonly' => false,
            ///  'options' => ['style' => 'width:200px;'],
            "value" => function ($model) {
                $_model = backend\models\MeFaabsTrainingTopics::findOne($model->topic);
                return !empty($_model) ? $_model->category . "-" . $_model->topic : "";
            }
        ],
        [
            'enableSorting' => false,
            'contentOptions' => ['class' => 'text-left'],
            'attribute' => 'training_type',
            'label' => 'Training type',
        ],
    ],
]);

