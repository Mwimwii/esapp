<?php

use yii\helpers\Html;
//use kartik\grid\GridView;;
//use kartik\editable\Editable;
use backend\models\User;
use backend\models\AwpbUnitOfMeasure;
use kartik\export\ExportMenu;

use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwpbTemplateActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
 $template_model = \backend\models\AwpbTemplate::findOne(['id'=>$id]);
 
$this->title = $template_model->fiscal_year.' Activity Funding Profile';
$this->params['breadcrumbs'][] = $this->title;

//if (isset(Yii::$app->session['fiscal_year']))
// {
//        $fiscal_year = Yii::$app->session['fiscal_year'];
//	    $awpb_template_id = Yii::$app->session['awpb_template_id'];
//    } 
//	else 
//	{
//        $fiscal_year = null;
//    }
   
$time = new \DateTime('now');
$today = $time->format('Y-m-d');




?>

<div class="card card-success card-outline">
    <div class="card-body">
<h3><?= Html::encode($this->title) ?></h3>

        <p>
            
          
         <?php
          
//                        $fiscal_year = !empty($awpb_template->fiscal_year) ? $awpb_template->fiscal_year : "";
//            if (\backend\models\User::userIsAllowedTo('Setup AWPB')) {
//           //    echo Html::a('<i class="fa fa-plus"></i> Add AWPB Activity', ['create'], ['class' => 'btn btn-success btn-sm']);
//          
//                        echo Html::a(
//                                '<div  class="icheck-primary d-inline ml-2">
//                            <i class="fa fa-file-excel fa-2x"></i>
//                        </div>
//                        <!-- todo text -->
//                        <span class="text"> Export ' .  $fiscal_year . ' Budget (Sage File)</span>
//                        <div class="tools">
//                            <i class="fas fa-download fa-2x"></i>
//                        </div>',
//                                ['reports/download-budget', 'id' => (!empty($awpb_template->id) ? $awpb_template->id : ""),
//                                ], [
//                            'title' => 'Export '.$fiscal_year .' Budget',
//                            'target' => '_blank',
//                            'data-toggle' => 'tooltip',
//                            'data-placement' => 'top',
//                            'data-pjax' => '0',
//                            'style' => "padding:5px;",
//                                ]
//            );}
//           
          echo Html::a(
                '<span class="fa fa-arrow-left"></span>', ['awpb-template/check-list','id'=>$id ], [
            'title' => 'Checklist',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data-pjax' => '0',
            'style' => "padding:20px;",
            'class' => 'bt btn-lg'
                ]
        );
                              
           $gridColumns =[
                ['class' => 'yii\grid\SerialColumn'],


 [
    'class' => 'kartik\grid\EditableColumn',
    'attribute' => 'component_id',
     
   // 'pageSummary' => 'Total',
    'vAlign' => 'middle',
    'width' => '50px',
     'readonly' => true,
     'value' => function ($model) {
         return !empty($model->component_id) && $model->component_id > 0 ? backend\models\AwpbComponent::findOne($model->component_id)->code : "";
                        
      },

],    
          
            [
                'attribute' => 'name', 
                'vAlign' => 'middle',
          //      'width' => '220px',
                'value' => function ($model, $key, $index, $widget) { 
                return      Html::a($model->activity_code ." ".$model->name, ['awpb-activity/view', 'id' => $model->id], ['class' => 'awbp-activity']);
               
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(backend\models\AwpbActivity::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'options' => ['multiple' => true]
                ],
                'filterInputOptions' => ['placeholder' => 'Filter by name'],
                'format' => 'raw'
            ],
                         [
                   'class' => EditableColumn::className(),
                    'enableSorting' => true,
                             'readonly'=>true,
                              'vAlign' => 'right',
                    'attribute' => 'ifad',
         'width' => '7%',
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => kartik\popover\PopoverX::SIZE_MEDIUM,
                    ],
//                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
//                    'filterWidgetOptions' => [
//                        'pluginOptions' => ['allowClear' => true],
//                    ],
//                    'filter' => \backend\models\Provinces::getProvinceNames(),
//                    'filterInputOptions' => ['prompt' => 'Filter by name', 'class' => 'form-control',],
//                    'format' => 'raw',
//                    'refreshGrid' => true,
                ],
 
     [
                    'class' => EditableColumn::className(),
                    'enableSorting' => true,
          'readonly'=>true,
                    'attribute' => 'ifad_grant',
         'width' => '7%',
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => kartik\popover\PopoverX::SIZE_MEDIUM,
                    ],
//                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
//                    'filterWidgetOptions' => [
//                        'pluginOptions' => ['allowClear' => true],
//                    ],
//                    'filter' => \backend\models\Provinces::getProvinceNames(),
//                    'filterInputOptions' => ['prompt' => 'Filter by name', 'class' => 'form-control',],
//                    'format' => 'raw',
//                    'refreshGrid' => true,
                ],
                         [
                    'class' => EditableColumn::className(),
                              'readonly'=>true,
                    'enableSorting' => true,
                             'width' => '7%',
                    'attribute' => 'grz',
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => kartik\popover\PopoverX::SIZE_MEDIUM,
                    ],
//                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
//                    'filterWidgetOptions' => [
//                        'pluginOptions' => ['allowClear' => true],
//                    ],
//                    'filter' => \backend\models\Provinces::getProvinceNames(),
//                    'filterInputOptions' => ['prompt' => 'Filter by name', 'class' => 'form-control',],
//                    'format' => 'raw',
//                    'refreshGrid' => true,
                ],
            [
                    'class' => EditableColumn::className(),
                 'readonly'=>true,
                    'enableSorting' => true,
                             'width' => '7%',
                    'attribute' => 'beneficiaries',
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => kartik\popover\PopoverX::SIZE_MEDIUM,
                    ],
//                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
//                    'filterWidgetOptions' => [
//                        'pluginOptions' => ['allowClear' => true],
//                    ],
//                    'filter' => \backend\models\Provinces::getProvinceNames(),
//                    'filterInputOptions' => ['prompt' => 'Filter by name', 'class' => 'form-control',],
//                    'format' => 'raw',
//                    'refreshGrid' => true,
                ],
            [
                    'class' => EditableColumn::className(),
                 'readonly'=>true,
                    'enableSorting' => true,
                             'width' => '7%',
                    'attribute' => 'private_sector',
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => kartik\popover\PopoverX::SIZE_MEDIUM,
                    ],
//                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
//                    'filterWidgetOptions' => [
//                        'pluginOptions' => ['allowClear' => true],
//                    ],
//                    'filter' => \backend\models\Provinces::getProvinceNames(),
//                    'filterInputOptions' => ['prompt' => 'Filter by name', 'class' => 'form-control',],
//                    'format' => 'raw',
//                    'refreshGrid' => true,
                ],
           
       [
                    'class' => EditableColumn::className(),
            'readonly'=>true,
                    'enableSorting' => true,
                             'width' => '7%',
                    'attribute' => 'iapri',
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => kartik\popover\PopoverX::SIZE_MEDIUM,
                    ],
//                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
//                    'filterWidgetOptions' => [
//                        'pluginOptions' => ['allowClear' => true],
//                    ],
//                    'filter' => \backend\models\Provinces::getProvinceNames(),
//                    'filterInputOptions' => ['prompt' => 'Filter by name', 'class' => 'form-control',],
//                    'format' => 'raw',
//                    'refreshGrid' => true,
                ],
            [
                    'class' => EditableColumn::className(),
                 'readonly'=>true,
                    'enableSorting' => true,
                             'width' => '7%',
                    'attribute' => 'parm',
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => kartik\popover\PopoverX::SIZE_MEDIUM,
                    ],
//                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
//                    'filterWidgetOptions' => [
//                        'pluginOptions' => ['allowClear' => true],
//                    ],
//                    'filter' => \backend\models\Provinces::getProvinceNames(),
//                    'filterInputOptions' => ['prompt' => 'Filter by name', 'class' => 'form-control',],
//                    'format' => 'raw',
//                    'refreshGrid' => true,
                ],
// [
//                    'class' => EditableColumn::className(),
//                 'readonly'=>true,
//                    'enableSorting' => true,
//                             'width' => '7%',
//                    'attribute' => 'budget_amount',
//                    'editableOptions' => [
//                        'asPopover' => true,
//                        'type' => 'success',
//                        'size' => kartik\popover\PopoverX::SIZE_MEDIUM,
//                    ],
////                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
////                    'filterWidgetOptions' => [
////                        'pluginOptions' => ['allowClear' => true],
////                    ],
////                    'filter' => \backend\models\Provinces::getProvinceNames(),
////                    'filterInputOptions' => ['prompt' => 'Filter by name', 'class' => 'form-control',],
////                    'format' => 'raw',
////                    'refreshGrid' => true,
//                ],
           ['class' => 'yii\grid\ActionColumn',
             'options' => ['style' => 'width:8%;'],
            'header' => 'Action',
'template' => '{update}{update1}',
'buttons' => [
//    'view' => function ($url, $model) {
//        if (User::userIsAllowedTo('View AWPB activities') ) {
//            return Html::a(
//                            '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
//                        'title' => 'View component',
//                        'data-toggle' => 'tooltip',
//                        'data-placement' => 'top',
//                        'data-pjax' => '0',
//                        'style' => "padding:5px;",
//                        'class' => 'bt btn-lg'
//                            ]
//            );
//        }
//    },
    'update' => function ($url, $model) use ($template_model,$today){
        if (User::userIsAllowedTo('Setup AWPB') && ($template_model->status== \backend\models\AwpbTemplate::STATUS_PUBLISHED||$template_model->status== \backend\models\AwpbTemplate::STATUS_DRAFT)) 
        
        {
            return Html::a(
                            '<span class="fas fa-edit"></span>',['update', 'id' => $model->id], [ 
                        'title' => 'Update funding profile',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        // 'target' => '_blank',
                        'data-pjax' => '0',
                        'style' => "padding:5px;",
                        'class' => 'bt btn-lg'
                            ]
            );
        }
    },
//               'lock' => function ($url, $model) {
//        if (User::userIsAllowedTo('Setup AWPB') ) {
//            return Html::a(
//                            '<span class="fas fa-lock"></span>',['lock', 'id' => $model->id], [ 
//                        'title' => 'Lock editing funding profile',
//                        'data-toggle' => 'tooltip',
//                        'data-placement' => 'top',
//                        // 'target' => '_blank',
//                        'data-pjax' => '0',
//                        'style' => "padding:5px;",
//                        'class' => 'bt btn-lg'
//                            ]
//            );
//        }
//    },
//    'update1' => function ($url, $model) {
//        if (User::userIsAllowedTo('Setup AWPB') ) {
//            return Html::a(
//                            '<span class="fas fa-lock"></span>', ['update1', 'id' => $model->id], [
//                        'title' => 'Lock editing funding profile',
//                        'data-toggle' => 'tooltip',
//                        'data-placement' => 'top',
//                        'data' => [
//                            'confirm' => 'Are you sure you want to lock funding profile for this ?',
//                            'method' => 'post',
//                        ],
//                        'style' => "padding:5px;",
//                        'class' => 'bt btn-lg'
//                            ]
//            );
//        }
//    },
]
]
];
    
  echo ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Export All',
                    'class' => 'btn btn-default'
                ],
                'filename' => 'AWPB' . date("YmdHis")
            ]);
                 //   echo '<p>';
                //  if (User::userIsAllowedTo('Submit District AWPB')&& $user->district_id>0 ||$user->district_id!='') {
                //     //   echo Html::a('&nbsp;');
                //      // btn btn-outline-primary btn-space
                //            echo Html::a('Submit District AWPB', ['approve'], ['class' => 'btn btn-success btn-sm btn-space']);         
                //    }
                //    if (User::userIsAllowedTo('Submit Provincial AWPB')&& $user->province_id>0 ||$user->province_id!=''&& $user->district_id<0 ||$user->district_id=='') {
                //     //   echo Html::a('&nbsp;');
                //      // btn btn-outline-primary btn-space
                //            echo Html::a('Submit Provincial AWPB', ['approve'], ['class' => 'btn btn-success btn-sm btn-space']);         
                //    }
        //}
        ?>
      

    <?=  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
      
        'pjax' => true,
        //'bordered' => true,
       // 'striped' => false,
      // 'condensed' => false,
       'responsive' => true,
      //  'hover' => true,
       // 'floatHeader' => true,
       // 'floatHeaderOptions' => ['top' => $scrollingTop],
        'showPageSummary' => true,
        // 'panel' => [
        //     'type' => GridView::TYPE_PRIMARY
        // ],




]);
       
    
       
    ?>











</div>
<?php
$this->registerCss('.popover-x {display:none}');
?>