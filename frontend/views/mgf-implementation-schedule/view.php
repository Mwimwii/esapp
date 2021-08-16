<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfImplementationSchedule */

$this->title = "View Implementation Schedule";//$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mgf Implementation Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-implementation-schedule-view">

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
           // 'id',
           'activity_id',
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
          //  'yr1qtr1',
           // 'yr1qtr2',
           // 'yr1qtr3',
           // 'yr1qtr4',
           // 'yr2qtr1',
           // 'yr2qtr2',
           // 'yr2qtr3',
           // 'yr2qtr4',
           // 'yr3qtr1',
           // 'yr3qtr2',
           // 'yr3qtr3',
           // 'yr3qtr4',
           // 'yr4qtr1',
           // 'yr4qtr2',
            //'yr4qtr3',
            //'yr4qtr4',
           // 'proposal_id',
            //'date_created',
           // 'date_update',
           // 'created_by',
           // 'updated_by',
                ]
       ]
    ]); ?>

</div>
