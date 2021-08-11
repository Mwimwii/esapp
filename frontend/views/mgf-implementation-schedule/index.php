<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfImplementationScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Implementation Schedules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-implementation-schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Implementation Schedule', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\CheckboxColumn'],

            //'id',
            //'activity_id',
            [
                'label' => 'ActID',
                'attribute' => 'activity_id',
                 // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y1Q1',
                'attribute' => 'yr1qtr1',
                'value'=> function($model)
                   {
                     return $model->yr1qtr1==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y1Q2',
                'attribute' => 'yr1qtr2',
                'value'=> function($model)
                   {
                     return $model->yr1qtr2==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y1Q3',
                'attribute' => 'yr1qtr3',
                'value'=> function($model)
                   {
                     return $model->yr1qtr3==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y1Q4',
                'attribute' => 'yr1qtr4',
                'value'=> function($model)
                   {
                     return $model->yr1qtr4==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y2Q1',
                'attribute' => 'yr2qtr1',
                'value'=> function($model)
                   {
                     return $model->yr2qtr1==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y2Q2',
                'attribute' => 'yr2qtr2',
                'value'=> function($model)
                   {
                     return $model->yr2qtr2==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y2Q3',
                'attribute' => 'yr2qtr3',
                'value'=> function($model)
                   {
                     return $model->yr2qtr3==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y2Q4',
                'attribute' => 'yr2qtr4',
                'value'=> function($model)
                   {
                     return $model->yr2qtr4==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y3Q1',
                'attribute' => 'yr3qtr1',
                'value'=> function($model)
                   {
                     return $model->yr3qtr1==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y3Q2',
                'attribute' => 'yr3qtr2',
                'value'=> function($model)
                   {
                     return $model->yr3qtr2==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y3Q3',
                'attribute' => 'yr3qtr3',
                'value'=> function($model)
                   {
                     return $model->yr3qtr3==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y3Q4',
                'attribute' => 'yr3qtr4',
                'value'=> function($model)
                   {
                     return $model->yr3qtr4==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y4Q1',
                'attribute' => 'yr4qtr1',
                'value'=> function($model)
                   {
                     return $model->yr4qtr1==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y4Q2',
                'attribute' => 'yr4qtr2',
                'value'=> function($model)
                   {
                     return $model->yr4qtr2==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y4Q3',
                'attribute' => 'yr4qtr3',
                'value'=> function($model)
                   {
                     return $model->yr4qtr3==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            [
                'label' => 'Y4Q4',
                'attribute' => 'yr4qtr4',
                'value'=> function($model)
                   {
                     return $model->yr4qtr4==0?'no':'yes';
                   },
               // 'filter' => ['0' => 'no', '1' => 'yes'],
               // 'filterInputOptions' => ['prompt' => 'All educations', 'class' => 'form-control', 'id' => null]
            ],
            //'yr2qtr1',
            //'yr2qtr2',
            //'yr2qtr3',
            //'yr2qtr4',
            //'yr3qtr1',
            //'yr3qtr2',
            //'yr3qtr3',
            //'yr3qtr4',
            //'yr4qtr1',
            //'yr4qtr2',
            //'yr4qtr3',
            //'yr4qtr4',
            //'proposal_id',
            //'date_created',
            //'date_update',
            //'created_by',
            //'updated_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => [],
                'header'=>'Actions',
                'template' => '{view} {update} {delete}',
                'visibleButtons'=>[
                ],
            ],
        ],
    ]); ?>


</div>
