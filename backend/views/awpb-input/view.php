<?php

use yii\helpers\Html;

use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\money\MaskMoney;
use yii\widgets\MaskedInput;
use kartik\detail\DetailView;
use backend\models\User;


/* @var $this yii\web\View */
/* @var $model backend\models\AwpbBudget */

//$this->title = $model->id;
$this->title = 'AWPB Input : '. $model->name;
$this->params['breadcrumbs'][] = ['label' => 'AWPB Inputy Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

 $user = User::findOne(['id' => Yii::$app->user->id]);
$tem="";
$template= \backend\models\AWPBTemplate::findOne(['id' => $model->awpb_template_id]);
	
if (!empty($template)) {
    $tem=  $template->fiscal_year;
    }

    

$act="";
$out_id="";
$activity = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id]);
    
if (!empty($activity)) {
    $act=  $activity->name;
    $out_id=$activity->output_id;

    }
    
        $out="";
$output= \backend\models\AwpbOutput::findOne(['id' => $out_id]);
	
if (!empty($output)) {
    $out=  $output->name;
    }

$ind="";
$indicator = \backend\models\AwpbIndicator::findOne(['id' => $model->indicator_id]);
    
if (!empty($indicator)) {
    $ind=  $indicator->name;
  
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
    
    $cam = "";
$camp = \backend\models\Camps::findOne(['id' => $model->camp_id]);

if (!empty($camp)) {
    $cam = $camp->name;
}
     $unit="";
    $unit_of_me = \backend\models\AwpbUnitOfMeasure::findOne(['id' => $model->unit_of_measure_id]);
        
    if (!empty($unit_of_me)) {
        $unit=  $unit_of_me->name;
        }
$model_budget =new  \backend\models\AwpbBudget();
         $_model =  $model_budget::findOne(['id'=>$model->budget_id]);
?>

<div class="card card-success card-outline">
    <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    
            <?php
       if (User::userIsAllowedTo('Approve AWPB - Provincial') || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {

      
echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['awpb-budget/viewp', 'id' => $model->budget_id,'status'=>$_model->status], [
    'title' => 'back',
    'data-toggle' => 'tooltip',
    'data-placement' => 'top',
]);
       }
       else
       {
           echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['awpb-budget/view', 'id' => $model->budget_id,'status'=>$_model->status], [
    'title' => 'back',
    'data-toggle' => 'tooltip',
    'data-placement' => 'top',
]);
           
       }

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
if ($status ==0 && \backend\models\User::userIsAllowedTo('Manage AWPB')) {

        echo Html::a(
                '<span class="fa fa-edit"></span>', ['update', 'id' => $model->id], [
            'title' => 'Update input',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data-pjax' => '0',
            'style' => "padding:20px;",
            'class' => 'bt btn-lg'
                ]
        );

        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

        echo Html::a(
                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
            'title' => 'Delete input ',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data' => [
                'confirm' => 'Are you sure you want to delete this input?',
                'method' => 'post',
            ],
            'style' => "padding:5px;",
            'class' => 'bt btn-lg'
                ]
        );
    }

            
            

            


$attributes = [
     [
         'group'=>true,
         'label'=> 'Input Budget Summary',
         'rowOptions'=>['class'=>'table-success']
     ],
    [
        'columns' => [
                        [
                            'attribute' => 'province_id',
                            'label' => 'Province Name',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:15%'],
                            'value' => $pro,
                        ],
                        [
                            'attribute' => 'district_id',
                            'label' => 'District Name',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:15%'],
                            'value' => $dist,
                        ],
                           [
                            'attribute' => 'camp_id',
                            'label' => 'Camp Name',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:20%'],
                            'value' => $cam,
                        ],
                        [
                            'label' => 'Fiscal Year',
                            'format' => 'raw',
                            'value' => $tem,
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                    ],
    ],
//      [
//        'columns' => [
//            [
//                'attribute'=>'output_id',
//                'value'=>$out,
//                'labelColOptions'=>['style'=>'width:15%'],
//                'valueColOptions'=>['style'=>'width:85%'],
//            ],
//         
//        ],
//    ],

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
                'attribute'=>'indicator_id',
                'value'=>$ind,
                 'label'=>'Indicator',
                'labelColOptions'=>['style'=>'width:15%'],
                'valueColOptions'=>['style'=>'width:85%'],
            ],
         
        ],
    ],
	
    [
            
        'columns' => [
            [
                'attribute'=>'name',
                'label'=>'Input Description',
                'labelColOptions'=>['style'=>'width:15%'],
                'valueColOptions'=>['style'=>'width:85%'],
            ],
         
        ],
    ],
	    [
        'columns' => [
                 [
                'attribute'=>'unit_of_measure_id',
                 'label'=>'Unit of Measure',
                'displayOnly'=>true,
                'format' => 'raw',
                'labelColOptions'=>['style'=>'width:10%'],
                'valueColOptions'=>['style'=>'width:20%'],
                'value' => $unit
               ],
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
        'labelColOptions'=>['style'=>'width:10%'],
        'valueColOptions'=>['style'=>'width:15%'],
    ],
	   [
        'attribute'=>'total_amount',
        'label'=>'Total Budget',
        'displayOnly'=>true,
        'format'=>['decimal', 2],
        'labelColOptions'=>['style'=>'width:10%'],
                'valueColOptions'=>['style'=>'width:25%'],
    ],
  	
			
        ],
    ],

   


[
         'group'=>true,
         'label'=>'Detailed Input Quantities',
         'rowOptions'=>['class'=>'table-success']

    
     ],
    [
                    'columns' => [
                      
                        [
                            'attribute' => 'mo_1',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_2',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'mo_3',
                            'displayOnly' => true,
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:5%'],
                            'valueColOptions' => ['style' => 'width:10%'],
                        ],
                        [
                            'attribute' => 'quarter_one_quantity',
                            'label' => 'Q1 Total Qty',
                            'format' => ['decimal', 2],
                            'labelColOptions' => ['style' => 'width:8%'],
                            'valueColOptions' => ['style' => 'width:15%'],
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
        'label'=>'Q2 Total Qty',
        'format'=>['decimal', 2],
          'labelColOptions'=>['style'=>'width:8%'],
                'valueColOptions'=>['style'=>'width:15%'],
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
        'label'=>'Q3 Total Qty',
        'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:8%'],
                'valueColOptions'=>['style'=>'width:15%'],
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
        'label'=>'Q4 Total Qty',
        'displayOnly'=>true,
        'format'=>['decimal', 2],
        'labelColOptions'=>['style'=>'width:8%'],
                'valueColOptions'=>['style'=>'width:15%'],
    ],
	
   
        ],
    ],
     [
         'group'=>true,
         'label'=>'Detailed Input Costings',
         'rowOptions'=>['class'=>'table-success']
//'groupOptions'=>['class'=>'text-center']
    
     ],
    
[
        'columns' => [
		// [
        //         'label'=>'Quarter One', 
        //         'format'=>'raw',            
        //         'displayOnly'=>true,
        //         'inputContainer' => ['class'=>'col-sm-2'],
        //    ],
            [
                'attribute'=>'mo_1_amount', 
             
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
                 'rowOptions'=>['class'=>'table', 'style'=>'border-top: 5px double #dedede'],
            ],
			   [
                'attribute'=>'mo_2_amount', 
               
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_3_amount', 
               
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			  
	
			 [
        'attribute'=>'quarter_one_amount',
        'label'=>'Q1 Total Budget',
        'format'=>['decimal', 2],
        'labelColOptions'=>['style'=>'width:8%'],
                'valueColOptions'=>['style'=>'width:15%'],
    ],
 
	
        ]
    ],



[
        'columns' => [
		// [
        //         'label'=>'Q2', 
        //         'format'=>'raw', 
        //         'value'=>'',        
        //         'displayOnly'=>true,
        //         'inputContainer' => ['class'=>'col-sm-2'],
            
              
        //     ],
            [
                'attribute'=>'mo_4_amount', 
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_5_amount', 
               
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_6_amount', 
               
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
		
			 [
        'attribute'=>'quarter_two_amount',
        'label'=>'Q2 Total Budget',
        'format'=>['decimal', 2],
          'labelColOptions'=>['style'=>'width:8%'],
                'valueColOptions'=>['style'=>'width:15%'],
    ],

        ],
    ],

[
        'columns' => [
	
            [
                'attribute'=>'mo_7_amount', 
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_8_amount', 
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_9_amount', 
    
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
	
			 [
        'attribute'=>'quarter_three_amount',
        'label'=>'Q3 Total Budget',
        'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:8%'],
                'valueColOptions'=>['style'=>'width:15%'],
    ],
	
    
        ],
    ],
	
[
        'columns' => [

            [
                'attribute'=>'mo_10_amount', 
               
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_11_amount', 
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
			   [
                'attribute'=>'mo_12_amount', 
                'displayOnly'=>true,
                'format'=>['decimal', 2],
                'labelColOptions'=>['style'=>'width:5%'],
                'valueColOptions'=>['style'=>'width:10%'],
            ],
	
			 
	
    [
        'attribute'=>'quarter_four_amount',
        'label'=>'Q4 Total Budget',
        'displayOnly'=>true,
        'format'=>['decimal', 2],
        'labelColOptions'=>['style'=>'width:8%'],
                'valueColOptions'=>['style'=>'width:15%'],
    ],
        ],
    ],
    
];



// View file rendering the widget
echo DetailView::widget([
    'model' => $model,
    'attributes' => $attributes,
    'mode' => DetailView::MODE_VIEW ,
 //  'bootstrap' => true,
 //  'bordered' => true,
 //   'striped' => true,
   // 'condensed' => $condensed,
   // 'responsive' => true,
    //'hover' => true,
    'hAlign'=>DetailView::ALIGN_LEFT,
    'vAlign'=>DetailView::ALIGN_MIDDLE,
//    'panel'=>[
//        'heading'=>'Input ' . $model->name,
//  
//    ],
   // 'fadeDelay'=>$fadeDelay,
    // 'panel' => [
    //     'type' => DetailView::TYPE_DEFAULT, 
    //     //'heading' => $panelHeading,
    //     'footer' => '<div class="text-center text-muted">This is a sample footer message for the detail view.</div>'
    // ],
//    'deleteOptions'=>[ // your ajax delete parameters
//        'params' => ['id' => 1000, 'kvdelete'=>true],
//    ],
  //  'container' => ['id'=>'kv-demo'],
   // 'formOptions' => ['action' => Url::current(['#' => 'kv-demo'])] // your action to delete
]);

?>


</div>
