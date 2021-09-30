<?php

use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use backend\models\User;
use \kartik\popover\PopoverX;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\money\MaskMoney;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use backend\models\AwpbBudget;
use backend\models\AwpbInput;
use backend\models\AwpbInputSearch;

use backend\models\AwpbDistrict;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Quarterly Operations Funds Requisition';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
//$this->params['breadcrumbs'][] = $this->title;

//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;
$status=1;
?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
        <?php
        $user = User::findOne(['id' => Yii::$app->user->id]);
          $template_model =  \backend\models\AwpbTemplate::find()->where(['status' =>\backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
          if (User::userIsAllowedTo('Request Funds') && ($user->district_id > 0 || $user->district_id != ''))
             {
//              $status=0;
//         echo Html::a('<span class="btn btn-success btn-sm">Click here to vary the Activty input/s</span>', ['awpb-budget/view_1', 'id' => $id], [
//                    'title' => 'Submit Provincial AWPB',
//                    'data-toggle' => 'tooltip',
//                    'data-placement' => 'top',
//                    // 'target' => '_blank',
//                    'data-pjax' => '0',
//                    // 'style' => "padding:5px;",
//                    'class' => 'bt btn-lg'
//                        ]
//                );
            //  echo Html::a('<i class="fa fa-plus"></i> Add AWPB Input', ['awpb-actual-input/create', 'id'=>$model->id], ['class' => 'btn btn-success btn-sm']);
             }

                         [
                            'class' => 'kartik\grid\EditableColumn',
                            'label' => 'Input Description',
                            'attribute' => 'name',
                            'readonly' => true,
                            'filter' => false,
                            'editableOptions' => [
                                'header' => 'Name',
                                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                            ],
                            'hAlign' => 'left',
                            'vAlign' => 'left',
                        // 'width' => '7%',
                        
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'unit_cost',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Unit Cost',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => false
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'mo_1',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Q1 Qty',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => true
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'mo_2',
                            'readonly' => true,

                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Feb',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => true
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'mo_3',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Mar',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => true
                        ],
                        
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'mo_1_amount',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Jan',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => true
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'mo_2_amount',
                            'readonly' => true,

                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Feb',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => true
                        ],
                        [
                            'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'mo_3_amount',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Mar',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => true
                        ],
                      
                        [
                                    
                                         'class' => 'kartik\grid\EditableColumn',
                            'attribute' => 'quarter_one_amount',
                            'readonly' => true,
                            'refreshGrid' => true,'filter' => false,
                            'editableOptions' => [
                                'header' => 'Total Qtr 1',
                                'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                                'options' => [
                                    'pluginOptions' => ['min' => 0, 'max' => 999999999999999999999]
                                ]
                            ],
                            'hAlign' => 'right',
                            'vAlign' => 'middle',
                            'width' => '7%',
                            'format' => ['decimal', 2],
                            'pageSummary' => true
                        ],      
                        
                                    
                            
                    
                    ['class' => 'yii\grid\ActionColumn',
                    'options' => ['style' => 'width:150px;'],
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            if ( User::userIsAllowedTo('View AWPB')||User::userIsAllowedTo('Request Funds') ) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['awpb-actual-input/view', 'id' => $model->id], [
                                            'title' => 'View input',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                        'update' => function ($url, $model) use ($user, $quarter) {
 if (User::userIsAllowedTo('Request Funds') && ($user->district_id > 0 || $user->district_id != '')) {  
                return Html::a(
                                                '<span class="fas fa-edit"></span>', ['awpb-actual-input/update', 'id' => $model->id,'quarter'=>$quarter], [
                                            'title' => 'Update input',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            // 'target' => '_blank',)
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                        'delete' => function ($url, $model) use ($user) {
                          if ( User::userIsAllowedTo('Request Funds') && ($user->district_id > 0 || $user->district_id != '')) {
          return Html::a(
                                                '<span class="fa fa-trash"></span>', ['awpb-actual-input/delete', 'id' => $model->id], [
                                            'title' => 'delete input',
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
                        },
                    ]
                ]
                    ];

             
                 
                  
                  
                 
            $budget = \backend\models\AwpbBudget::findOne(['id' => $id]);
          
            if (User::userIsAllowedTo('Request Funds') && ( $user->district_id != 0 || $user->district_id != '')) {
                $searchModel = new \backend\models\AwpbActualInputSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andFilterWhere(['=', 'budget_id', $id])->andFilterWhere(['=', 'district_id', $budget->district_id])->andFilterWhere(['=', 'quarter_number', $template_model->quarter])->andFilterWhere(['=', 'status', AwpbActualInput::STATUS_NOT_REQUESTED]);
                  
                    
           
           } 
            elseif (User::userIsAllowedTo('Review Funds Request') && ( $user->province_id != 0 || $user->province_id != '')) {
                $searchModel = new \backend\models\AwpbActualInputSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andFilterWhere(['=', 'budget_id', $id])->andFilterWhere(['=', 'district_id', $budget->district_id])->andFilterWhere(['=', 'quarter_number', $template_model->quarter])->andFilterWhere(['=', 'status', AwpbActualInput::STATUS_DISTRICT]);

                
             
            } 
            elseif (User::userIsAllowedTo('Approve Funds Requisition') && ($user->province_id == 0 || $user->province_id == '')) {
                $searchModel = new \backend\models\AwpbActualInputSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andFilterWhere(['=', 'budget_id', $id])->andFilterWhere(['=', 'district_id', $budget->district_id])->andFilterWhere(['=', 'quarter_number', $template_model->quarter])->andFilterWhere(['=', 'status', AwpbActualInput::STATUS_PROVINCIAL]);

               
            } 
            elseif (User::userIsAllowedTo('Disburse Funds') && ($user->province_id == 0 || $user->province_id == '')) {
                $searchModel = new \backend\models\AwpbActualInputSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andFilterWhere(['=', 'budget_id', $id])->andFilterWhere(['=', 'district_id', $budget->district_id])->andFilterWhere(['=', 'quarter_number', $template_model->quarter])->andFilterWhere(['=', 'status', AwpbActualInput::STATUS_SPECIALIST]);

               
            }  else {
                $searchModel = new \backend\models\AwpbActualInputSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andFilterWhere(['=', 'budget_id', $id])->andFilterWhere(['=', 'district_id', $budget->district_id])->andFilterWhere(['=', 'quarter_number', $template_model->quarter])->andFilterWhere(['=', 'status', 10]);
               
            }

                  
        echo GridView::widget([
            'dataProvider' => $dataProvider,
           // 'filterModel' => $searchModel,
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
// 
//                          
//}
//    else {
//            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
//            return $this->redirect(['site/home']);
//        }
?>
                </div>
                        <!-- /.card -->
                
            </div>
        <?php
        $this->registerCss('.popover-x {display:none}');
        ?>
