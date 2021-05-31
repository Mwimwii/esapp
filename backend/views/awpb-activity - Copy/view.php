<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use \backend\models\User;

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\base\InvalidCallException;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivity */

$this->title = $model->activity_code.' AWPB Activities';
$this->params['breadcrumbs'][] = ['label' => 'AWPB Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


$activity_description="";
$activity = \backend\models\AWPBActivity::findOne(['id' => $model->parent_activity_id]);
	
if (!empty($activity)) {
		$activity_description =  $activity->description;
	}

$component_description="";
$component = \backend\models\AwpbComponent::findOne(['id' => $model->component_id]);
	
if (!empty($component)) {
		$component_description =  $component->component_description;
	}
$unit_of_measure_description="";
	$unitofmeasure = \backend\models\AWPBUnitOfMeasure::findOne(['id' => $model->unit_of_measure_id]);
	
if (!empty($unitofmeasure)) {
		$unit_of_measure_description =  $unitofmeasure->description;
	}

$expense_category_name="";
	$expensecategory = \backend\models\AWPBExpenseCategory::findOne(['id' => $model->expense_category_id]);
	
if (!empty($expensecategory)) {
		$expense_category_name =  $expensecategory->expense_category_name;
	}
	
	$activities =  ArrayHelper::map(\backend\models\AwpbActivity::find()->orderBy('description')->asArray()->all(), 'id', 'description');
       $array_activity = \yii\helpers\ArrayHelper::removeValue($activities, $model->description);            
// setup your attributes
$attributes=[
    
[
        'group'=>true,
        'label'=>'AWPB Activity Details',
        'rowOptions'=>['class'=>'table-info'],
        'groupOptions'=>['class'=>'text-center']
    ],
   [
        'columns' => [
      /*       [
        'attribute'=>'fiscal_year', 
        'format'=>'raw', 
        'value'=>'<kbd>'.$model->fiscal_year.'</kbd>', 
		 'valueColOptions'=>['style'=>'width:30%'], 
        'displayOnly'=>true
		
		
		 
    ],*/
	 /*[
		'label'=>'Activity code',
        'attribute'=>'activity_code',
        'format'=>'raw',
        'value'=>'<span class="text-justify"><em>' . $model->activity_code . '</em></span>',
        'type'=>DetailView::INPUT_TEXTAREA, 
        'options'=>['rows'=>3]
    ],
	*/
	
	
	 [
                'attribute'=>'component_id',
                'format'=>'raw',
                'value'=>Html::a('John Steinbeck', '#', ['class'=>'kv-author-link']),
                'type'=>DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(\backend\models\AwpbComponent::find()->orderBy('component_description')->asArray()->all(), 'id', 'component_description'),
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],
	//ArrayHelper::map(\backend\models\AwpbActivity::find()->orderBy('description')->asArray()->all(), 'id', 'description')
		 [
                'attribute'=>'parent_activity_id',
                'format'=>'raw',
                'value'=>Html::a($activity_description, '#', ['class'=>'kv-author-link']),
                'type'=>DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                    'data'=> $array_activity,
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],
	[
                'attribute'=>'expense_category_id',
                'format'=>'raw',
                'value'=>Html::a($expense_category_name, '#', ['class'=>'kv-author-link']),
                'type'=>DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(\backend\models\AwpbExpenseCategory::find()->orderBy('expense_category_name')->asArray()->all(), 'id', 'expense_category_name'),
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],
	
	  
	 [
	
        'attribute'=>'description',
        'format'=>'raw',
        'value'=>'<span class="text-justify"><em>' .  $model->description . '</em></span>',
        'type'=>DetailView::INPUT_TEXTAREA, 
        'options'=>['rows'=>3]
    ],
 
	[
                'attribute'=>'unit_of_measure_id',
                'format'=>'raw',
                'value'=>Html::a($unit_of_measure_description, '#', ['class'=>'text-justify']),
                'type'=>DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(\backend\models\AwpbUnitOfMeasure::find()->orderBy('description')->asArray()->all(), 'id', 'description'),
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],
	
            
        ]
    ],
    
       
   
		
];



echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>$model->activity_code.' AWPB Activities',
        'type'=>DetailView::TYPE_SUCCESS,
    ],
	'buttons1' => User::userIsAllowedTo('Manage AWPB activities') ? '{update} {delete}' : '',
	'formOptions' => ['options' => ['enctype' => 'multipart/form-data']],
    'attributes'=>[
        //'fiscal_year',
	/*
		 [
	
        'attribute'=>'activity_code',
        'format'=>'raw',
        'value'=>'<span class="text-justify"><em>' . $model->activity_code . '</em></span>',
        'type'=>DetailView::INPUT_TEXTAREA, 
        'options'=>['rows'=>2]
    ],*/
	 [
                'attribute'=>'component_id',
                'format'=>'raw',
                'value'=>$component_description,
                'type'=>DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(\backend\models\AwpbComponent::find()->orderBy('component_description')->asArray()->all(), 'id', 'component_description'),
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],
	
	 [
                'attribute'=>'parent_activity_id',
                'format'=>'raw',
                'value'=>$activity_description, 
                'type'=>DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                    'data'=>$activities,
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],
	//ArrayHelper::map(\backend\models\AwpbActivity::find()->orderBy('description')->asArray()->all(), 'id', 'description')
[
                'attribute'=>'expense_category_id',
                'format'=>'raw',
                'value'=>$expense_category_name,
                'type'=>DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(\backend\models\AwpbExpenseCategory::find()->orderBy('expense_category_name')->asArray()->all(), 'id', 'expense_category_name'),
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],
		[
        'attribute'=>'description',
        'format'=>'raw',
        'value'=>'<span class="text-justify">' . $model->description . '</span>',
        'type'=>DetailView::INPUT_TEXTAREA, 
        'options'=>['rows'=>4]
    ],		[
                'attribute'=>'unit_of_measure_id',
                'format'=>'raw',
                'value'=>$unit_of_measure_description, 
                'type'=>DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(\backend\models\AwpbUnitOfMeasure::find()->orderBy('description')->asArray()->all(), 'id', 'description'),
                    'options' => ['placeholder' => 'Select ...'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
                'valueColOptions'=>['style'=>'width:30%']
            ],
	
	

		
        
     //   ['attribute'=>'publish_date', 'type'=>DetailView::INPUT_DATE],
    ], 
]);
?>




