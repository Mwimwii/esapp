<?php

use yii\helpers\Html;

use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\money\MaskMoney;
use yii\widgets\MaskedInput;
use kartik\detail\DetailView;


/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivityLine */

//$this->title = $model->id;
$this->title = 'AWPB Indicator : '. $model->name;
$this->params['breadcrumbs'][] = ['label' => 'AWPB Indicator', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


$act="";
$fis="";
$activity = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id]);
    
if (!empty($activity)) {
    $act=  $activity->name;
    $fis=$activity->awpb_template_id;

    }

$tem="";
$template= \backend\models\AWPBTemplate::findOne(['id' => $model->awpb_template_id]);
	
if (!empty($template)) {
    $tem=  $template->fiscal_year;
    }

$dist="";
$district = \backend\models\Districts::findOne(['id' => $model->district_id]);
	
if (!empty($district))
{
    $dist=  $district->name;
    }
    $pro="";
    $province = \backend\models\Provinces::findOne(['id' => $model->province_id]);
	
if (!empty($province)) {
    $pro=  $province->name;
    }

?>

<div class="card card-success card-outline">
    <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    
            <?php
             echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['index', 'id' => $model->id], [
                'title' => 'back',
                'data-toggle' => 'tooltip',
                'data-placement' => 'top',
            ]);
            if (\backend\models\User::userIsAllowedTo('Manage AWPB activity lines')) {

                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo Html::a('<span class="fas fa-edit fa-2x"></span>', ['update', 'id' => $model->id], [
                  //  'title' => 'Update compon',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                ]);
               
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                
                    echo Html::a(
                        '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                    'title' => 'delete',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this budget line?',
                        'method' => 'post',
                    ],
                    'style' => "padding:5px;",
                    'class' => 'bt btn-lg'
                        ]
        );
                
            }
            


$attributes = [
    // [
    //     'group'=>true,
    //     'label'=>'Activity Line Basic Information',
    //     'rowOptions'=>['class'=>'table-info']
    // ],
    [
        'columns' => [
            [
                'attribute'=>'province_id', 
                'label'=>'Province Name',
       
                'displayOnly'=>true,
                'labelColOptions'=>['style'=>'width:15%'],
                'valueColOptions'=>['style'=>'width:20%'],

                'value' => $pro,
            ],
			    [
                'attribute'=>'district_id', 
                'label'=>'District Name',
                'displayOnly'=>true,
                'labelColOptions'=>['style'=>'width:15%'],
                'valueColOptions'=>['style'=>'width:30%'],

                'value' => $dist,
            ],
            [
                'label'=>'Fiscal Year', 
                'format'=>'raw', 
                'value'=>$tem,
                'labelColOptions'=>['style'=>'width:10%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
        ],
    ],
    [
        'columns' => [
            [
                'attribute'=>'activity_id',
                'value'=>$act,
                'labelColOptions'=>['style'=>'width:15%'],
                'valueColOptions'=>['style'=>'width:85%'],
            ],
         
        ],
    ],
	    [
            
        'columns' => [
            [
                'attribute'=>'name',
                'labelColOptions'=>['style'=>'width:15%'],
                'valueColOptions'=>['style'=>'width:85%'],
            ],
         
        ],
    ],
	    [
        'columns' => [
            [
                'attribute'=>'unit_cost', 
                'label'=>'Unit Cost',
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:10%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
	
    [
        'attribute'=>'total_quantity',
        'label'=>'Total Quantity',
        'displayOnly'=>true,
        'format'=>['decimal', 2],
        'labelColOptions'=>['style'=>'width:15%'],
        'valueColOptions'=>['style'=>'width:20%'],
    ],
	   [
        'attribute'=>'total_amount',
        'label'=>'Total Budget',
        'displayOnly'=>true,
        'format'=>['decimal', 2],
        'labelColOptions'=>['style'=>'width:15%'],
                'valueColOptions'=>['style'=>'width:30%'],
    ],
  	
			
        ],
    ],
    // [
    //     'group'=>true,
    //     'label'=>'Activity Line Quarterly Details',
    //     'rowOptions'=>['class'=>'table-info']
    // ],

[
        'columns' => [
		// [
        //         'label'=>'Quarter One', 
        //         'format'=>'raw',            
        //         'displayOnly'=>true,
        //         'inputContainer' => ['class'=>'col-sm-2'],
        //    ],
            [
                'attribute'=>'mo_1', 
             
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_2', 
               
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_3', 
               
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			  
			 [
        'attribute'=>'quarter_one_quantity',
        'label'=>'Qtr 1 Qty',
        'format'=>['decimal', 2],
        'labelColOptions'=>['style'=>'width:8%'],
                'valueColOptions'=>['style'=>'width:15%'],
    ],
	
    [
        'label'=>'Qtr 1 Budget($)',
        'value'=>$model->unit_cost *$model->quarter_one_quantity,
        'format'=>['decimal', 2],
        'labelColOptions'=>['style'=>'width:12%'],
                'valueColOptions'=>['style'=>'width:20%'],
        // hide this in edit mode by adding `kv-edit-hidden` CSS class
        'rowOptions'=>['class'=>'warning kv-edit-hidden', 'style'=>'border-top: 5px double #dedede'],
    ],
	
        ]
    ],



[
        'columns' => [
		// [
        //         'label'=>'Quarter Two', 
        //         'format'=>'raw', 
        //         'value'=>'',        
        //         'displayOnly'=>true,
        //         'inputContainer' => ['class'=>'col-sm-2'],
            
              
        //     ],
            [
                'attribute'=>'mo_4', 
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_5', 
               
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_6', 
               
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
		
			 [
        'attribute'=>'quarter_two_quantity',
        'label'=>'Qtr 2 Qty',
        'format'=>['decimal', 2],
          'labelColOptions'=>['style'=>'width:8%'],
                'valueColOptions'=>['style'=>'width:15%'],
    ],
	
    [
        'label'=>'Qtr 2 Budget($)',
        'value'=>$model->unit_cost * $model->quarter_two_quantity,
        'format'=>['decimal', 2],
        'labelColOptions'=>['style'=>'width:12%'],
                'valueColOptions'=>['style'=>'width:20%'],
        // hide this in edit mode by adding `kv-edit-hidden` CSS class
        'rowOptions'=>['class'=>'warning kv-edit-hidden', 'style'=>'border-top: 5px double #dedede'],
    ],
	
        ],
    ],

[
        'columns' => [
	
            [
                'attribute'=>'mo_7', 
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_8', 
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_9', 
    
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
	
			 [
        'attribute'=>'quarter_three_quantity',
        'label'=>'Qtr 3 Qty',
        'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:8%'],
                'valueColOptions'=>['style'=>'width:15%'],
    ],
	
    [
        'label'=>'Qtr 3 Budget($)',
        'value'=>$model->unit_cost * $model->quarter_three_quantity,
        'format'=>['decimal', 2],
        'labelColOptions'=>['style'=>'width:12%'],
                'valueColOptions'=>['style'=>'width:20%'],
        // hide this in edit mode by adding `kv-edit-hidden` CSS class
        'rowOptions'=>['class'=>'warning kv-edit-hidden', 'style'=>'border-top: 5px double #dedede'],
    ],
	
        ],
    ],
	
[
        'columns' => [

            [
                'attribute'=>'mo_10', 
               
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_11', 
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_12', 
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
	
			 [
        'attribute'=>'quarter_four_quantity',
        'label'=>'Qtr 4 Qty',
        'displayOnly'=>true,
        'format'=>['decimal', 2],
        'labelColOptions'=>['style'=>'width:8%'],
                'valueColOptions'=>['style'=>'width:15%'],
    ],
	
    [
        'label'=>'Qtr 4 Budget($)',
        'value'=>$model->unit_cost * $model->quarter_four_quantity,
        'format'=>['decimal', 2],
        'labelColOptions'=>['style'=>'width:12%'],
        'valueColOptions'=>['style'=>'width:20%'],
        // hide this in edit mode by adding `kv-edit-hidden` CSS class
        'rowOptions'=>['class'=>'warning kv-edit-hidden', 'style'=>'border-top: 5px double #dedede'],
    ],
	
        ],
    ],


];

// View file rendering the widget
echo DetailView::widget([
    'model' => $model,
    'attributes' => $attributes,
    'mode' => DetailView::MODE_VIEW ,
   // 'bordered' => true,
    'striped' => true,
   // 'condensed' => $condensed,
    'responsive' => true,
    'hover' => true,
    'hAlign'=>DetailView::ALIGN_LEFT,
    'vAlign'=>DetailView::ALIGN_MIDDLE,
   // 'fadeDelay'=>$fadeDelay,
    // 'panel' => [
    //     'type' => DetailView::TYPE_DEFAULT, 
    //     //'heading' => $panelHeading,
    //     'footer' => '<div class="text-center text-muted">This is a sample footer message for the detail view.</div>'
    // ],
    'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => 1000, 'kvdelete'=>true],
    ],
    'container' => ['id'=>'kv-demo'],
    'formOptions' => ['action' => Url::current(['#' => 'kv-demo'])] // your action to delete
]);

?>


</div>
