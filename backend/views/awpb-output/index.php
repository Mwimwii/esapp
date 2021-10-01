<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwpbOutputSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB Outputs';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card card-success card-outline">
    <div class="card-body">


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create an AWPB Output', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'code',
           [
                    'attribute' => 'component_id',
                    'label' => 'Component',
                    'vAlign' => 'middle',
                    'width' => '7%',
                    'value' => function ($model, $key, $index, $widget) {
                        $component = \backend\models\AwpbComponent::findOne(['id' => $model->component_id]);

                       return !empty($component) ? $component->code : "";
                        //return !empty($component) ? Html::a($component->code .' '.$component->name, ['pwca', 'id' => $model->component_id ], ['class' => 'mpcd']) : "";
                 
                    },
//                    'filterType' => GridView::FILTER_SELECT2,
//                    'filter' => ArrayHelper::map(backend\models\AwpbComponent::find()->orderBy('code')->asArray()->all(), 'id', 'code'),
//                    'filterWidgetOptions' => [
//                        'pluginOptions' => ['allowClear' => true],
//                        'options' => ['multiple' => true]
//                    ],
//                    'filterInputOptions' => ['placeholder' => 'Filter by component'],
//                    'format' => 'raw'
                ],
            //'outcome_id',
            'name',
            //'description',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div></div>
