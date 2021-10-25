<?php

use backend\models\AwpbBudget;
use backend\models\AwpbInput;
use backend\models\AwpbInputSearch;
use backend\models\AwpbActualInput;
use backend\models\AwpbActualInputSearch;
use backend\models\AuditTrail;
use backend\models\User;
use backend\models\AwpbDistrict;
use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use \kartik\popover\PopoverX;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\money\MaskMoney;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\Model;
use yii\caching\DbDependency;
use yii\data\ActiveDataProvider;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$this->title = 'Quarterly Operations Funds Requisition';

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;

$user = User::findOne(['id' => Yii::$app->user->id]);
//$budget = AwpbBudget::findOne(['id'=>$modid]);
//$model = new backend\models\AwpbInput();
//$access_level=1;
$template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_CURRENT_BUDGET])->one();
$district_model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $template_model->id, 'district_id' => $id2]);
$this->title = 'Quarterly Operations Funds Requisition ';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;
$model = new backend\models\AwpbFundsRequisition();
$form = ActiveForm::begin();
?>

<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">

        <h3><?= Html::encode($this->title) ?> : Q<?= $template_model->quarter ?> </h3>
        <h5>Instructions</h5>
        <div class="row" style="">
            <div class="col-lg-4">

                <?=
                $form->field($model, 'cost_centre_id', [
                    'addon' => [
                        'append' => [
                            'content' => Html::submitButton('Filter', ['name' => 'costCentre', 'value' => 'true', 'class' => 'btn btn-success btn-sm']),
                            'asButton' => true
                        ]
                    ]
                ])->dropDownList(
                        [
                            '1' => 'District',
                            '2' => 'Others',
                        ], [
                    'custom' => true,
                    'prompt' => 'Filter by request source',
                    'required' => true,
                        ]
                );
                ?>
            </div>

            <div class="col-lg-4">
                <ol>
                    <li>Select the source of the funds request and click <span class="badge badge-success">Filter</span> button to view submitted requests.
                    </li>
                    <li>Click <span class="badge badge-success">Submit Request</span> button below to 
                        request for funding.
                    </li>


                </ol>
            </div>


            <?php
            ActiveForm::end();

            if ((User::userIsAllowedTo('Disburse Funds') || User::userIsAllowedTo('Approve Funds Requisition')) && ($user->province_id == 0 || $user->province_id == '')) {
//                      echo Html::a(
//                                        '<span class="btn btn-success btn-lg float-right">Submit</span>',['awpb-district/submit','id'=>$template_model->id,'id2'=>$user->district_id,'status'=> \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED], [ 
//                                    'title' => 'Submit Funds Request',
//                                    'data-toggle' => 'tooltip',
//                                    'data-placement' => 'top',
//                                    // 'target' => '_blank',
//                                    'data-pjax' => '0',
//                                   // 'style' => "padding:5px;",
//                                    'class' => 'bt btn-lg'
//                                        ]
//                        );
            }
            ?>



            <div class="col-lg-4">  

                <h5>Instructions</h5>
                <ol>
                    <li>Click <span class="fa fa-check"> </span> icon to approve the request.
                    </li>
                    <li>Click the 
                        <span class="fa fa-ban"></span> icon to the decline the request.
                    </li>

                </ol>
            </div></div>
        <?php
//$gridColumns ="";
        $id3 = 0;

        $id3 = 1;
// $gridColumns=[];
        if ($cost_centre_id == 1) {

            $gridColumns = [
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'contentOptions' => ['class' => 'kartik-sheet-style'],
                    'width' => '5%',
                    'pageSummary' => 'Total',
                    'pageSummaryOptions' => ['colspan' => 3],
                    'header' => '',
                    'headerOptions' => ['class' => 'kartik-sheet-style']
                ],
                [
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '5%',
                    'value' => function ($model, $key, $index, $column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    // uncomment below and comment detail if you need to render via ajax
                    // 'detailUrl' => Url::to(['/site/book-details']),
                    'detail' => function ($model, $key, $index, $column) use ($id,$cost_centre_id) {

                        return Yii::$app->controller->renderPartial('qofr_1', ['id' => $model->awpb_template_id, 'id2' => $model->district_id,'id3'=>$cost_centre_id]);
                    },
                    //  'headerOptions' => ['class' => 'kartik-sheet-style'] ,
                    'expandOneOnly' => true
                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'district_id',
                    'header' => 'District',
                    'pageSummary' => 'Total',
                    'vAlign' => 'middle',
                    'width' => '40%',
                    'readonly' => true,
                    'value' => function ($model) {
                        return !empty($model->district_id) && $model->district_id > 0 ? backend\models\Districts::findOne($model->district_id)->name : "";
                        ;
                    },
                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'mo_1_amount',
                    'label' => 'Month 1 Budget',
                    'readonly' => function ($model, $key, $index, $widget) {
                        return (!$model->status); // do not allow editing of inactive records
                    },
                    'editableOptions' => [
                        'header' => 'Month 1 Budget',
                        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                        'options' => [
                            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
                    'label' => 'Month 2 Budget',
                    'attribute' => 'mo_2_amount', 'readonly' => true,
//    'readonly' => 
//    'readonly' => function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
                    'editableOptions' => [
                        'header' => 'Month 2 Budget',
                        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                        'options' => [
                            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
                    'label' => 'Month 3 Budget',
                    'readonly' => function ($model, $key, $index, $widget) {
                        return (!$model->status); // do not allow editing of inactive records
                    },
                    'editableOptions' => [
                        'header' => 'Month 1 Budget',
                        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                        'options' => [
                            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
                    'label' => 'Quarter Budget',
                    'attribute' => 'quarter_amount',
                    'readonly' => true,
                    'editableOptions' => [
                        'header' => 'Quarter Budget',
                        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                        'options' => [
                            'pluginOptions' => ['min' => 0, 'max' => 5000]
                        ]
                    ],
                    'hAlign' => 'right',
                    'vAlign' => 'middle',
                    'width' => '7%',
                    'format' => ['decimal', 2],
                    'pageSummary' => true
                ],
                ['class' => 'yii\grid\ActionColumn',
                    'options' => ['style' => 'width:7%;'],
                    'header' => 'Action',
                    'template' => '{view}{submit}{decline}',
                    'buttons' => [
                        
                         'view' =>function ($url, $model) use ($user, $template_model, $cost_centre_id) {
        if (User::userIsAllowedTo('View AWPB') ) {
            return Html::a(
                            '<span class="fa fa-eye"></span>', ['awpb-funds-requisition/quarterly-operations-funds-requisition', 'id' => $model->district_id,'id3'=>$cost_centre_id], [
                        'title' => 'Quarterly Operations Funds Requisition Form',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'data-pjax' => '0',
                        'style' => "padding:5px;",
                        'class' => 'bt btn-lg'
                            ]
            );
        }
    },
                        
                        
                        'submit' => function ($url, $model) use ($user, $template_model, $cost_centre_id) {
                            $district_model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $model->awpb_template_id, 'district_id' => $model->district_id]);
                            if (!empty($district_model)) {
                                if (User::userIsAllowedTo('Approve Funds Requisition') && ($user->province_id == 0 || $user->province_id == '')) {

                                    if ($district_model->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED) {
                                        return Html::a(
                                                        '<span class="fa fa-check"></span>', ['awpb-district/submit', 'id' => $district_model->id, 'id2' => $model->district_id, 'status' => \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED], [
                                                    'title' => 'Approve Funds Disurbsement',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    // 'target' => '_blank',
                                                    'data-pjax' => '0',
                                                    // 'style' => "padding:5px;",
                                                    'class' => 'bt btn-lg'
                                                        ]
                                        );
                                    } else  if ($district_model->status_q_1 > \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_2 > \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_3 >\backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_4 > \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED) {
                                        return "Request Approved";
                                    }
                                    else  if ($district_model->status_q_1 < \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_2 < \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_3 <\backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_4 < \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED) {
                                        return "Not requested";
                                    }
                                } else if (User::userIsAllowedTo('Disburse Funds') && ($user->province_id == 0 || $user->province_id == '')) {
//                        
                                    if ($district_model->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED) {

                                        return Html::a(
                                                        '<span class="fa fa-check"></span>', ['awpb-district/submit', 'id' =>$district_model->id, 'id2' => $model->district_id, 'status' => \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED], [
                                                    'title' => 'Disburse Funds',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    // 'target' => '_blank',
                                                    'data-pjax' => '0',
                                                    // 'style' => "padding:5px;",
                                                    'class' => 'bt btn-lg'
                                                        ]
                                        );
                                    } else if ($district_model->status_q_1 > \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_2 > \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_3 > \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_4 > \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED) {

                                        return "Funds Disbursed";
                                    
                                     } else if ($district_model->status_q_1 < \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_2 < \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_3 < \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_4 < \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED) {

                                        return "Not approved";
                                    }
                                    
                                }
                            }
                        },
                        'decline' => function ($url, $model) use ($user, $template_model,$cost_centre_id) {
                            $district_model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $model->awpb_template_id, 'district_id' => $model->district_id]);
                            if (!empty($district_model)) {
                                if (User::userIsAllowedTo('Approve Funds Requisition') && ($user->province_id == 0 || $user->province_id == '')) {
//                        
                                    if ($district_model->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED) {

                                        return Html::a(
                                                        '<span class="fa fa-ban"></span>', ['awpb-district/decline', 'id' => $district_model->id, 'id2' => $model->district_id, 'id3'=>$cost_centre_id, 'status' => \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED], [
                                                    'title' => 'Decline Funds Request',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    // 'target' => '_blank',
                                                    'data-pjax' => '0',
                                                    // 'style' => "padding:5px;",
                                                    'class' => 'bt btn-lg'
                                                        ]
                                        );
                                    }
                                } else if (User::userIsAllowedTo('Disburse Funds') && ($user->province_id == 0 || $user->province_id == '')) {
//                        
                                    if ($district_model->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED) {

                                        return Html::a(
                                                        '<span class="fa fa-ban"></span>', ['awpb-district/decline', 'id' => $district_model->id, 'id2' => $model->district_id,  'id3'=>$cost_centre_id,'status' => \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED], [
                                                    'title' => 'Decline Funds Disburment',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    // 'target' => '_blank',
                                                    'data-pjax' => '0',
                                                    // 'style' => "padding:5px;",
                                                    'class' => 'bt btn-lg'
                                                        ]
                                        );
                                    }
                                }
                            }
                        },
//                   
//               
                    ]]
//              
            ];
            if ($dataProvider->getCount() > 0) {
                //Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
                // echo ' </p>';
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
            }

            echo GridView::widget([
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
        } 
        else if ($cost_centre_id == 2) {

            $gridColumns = [
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'contentOptions' => ['class' => 'kartik-sheet-style'],
                    'width' => '5%',
                    'pageSummary' => 'Total',
                    'pageSummaryOptions' => ['colspan' => 3],
                    'header' => '',
                    'headerOptions' => ['class' => 'kartik-sheet-style']
                ],
                [
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '5%',
                    'value' => function ($model, $key, $index, $column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    // uncomment below and comment detail if you need to render via ajax
                    // 'detailUrl' => Url::to(['/site/book-details']),
                    'detail' => function ($model, $key, $index, $column) use ($id,$cost_centre_id) {

                        return Yii::$app->controller->renderPartial('qofr_1', ['id' => $model->awpb_template_id, 'id2' => $model->cost_centre_id,'id3'=>$cost_centre_id]);
                        // return Yii::$app->controller->renderPartial('qofr_1', ['id' => $model->awpb_template_id, 'id2' => $model->district_id]);
                        //return Yii::$app->controller->renderPartial('qofri_1', ['id' => $model->budget_id]);
                    },
                    //  'headerOptions' => ['class' => 'kartik-sheet-style'] ,
                    'expandOneOnly' => true
                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'cost_centre_id',
                    'header' => 'Cost Centre',
                    'pageSummary' => 'Total',
                    'vAlign' => 'middle',
                    'width' => '40%',
                    'readonly' => true,
                    'value' => function ($model) {
                        return !empty($model->cost_centre_id) && $model->cost_centre_id > 0 ? backend\models\AwpbCostCentre::findOne($model->cost_centre_id)->name : "";
                        ;
                    },
                ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'mo_1_amount',
                    'label' => 'Month 1 Budget',
                    'readonly' => function ($model, $key, $index, $widget) {
                        return (!$model->status); // do not allow editing of inactive records
                    },
                    'editableOptions' => [
                        'header' => 'Month 1 Budget',
                        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                        'options' => [
                            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
                    'label' => 'Month 2 Budget',
                    'attribute' => 'mo_2_amount', 'readonly' => true,
//    'readonly' => 
//    'readonly' => function($model, $key, $index, $widget) {
//        return (!$model->status); // do not allow editing of inactive records
//    },
                    'editableOptions' => [
                        'header' => 'Month 2 Budget',
                        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                        'options' => [
                            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
                    'label' => 'Month 3 Budget',
                    'readonly' => function ($model, $key, $index, $widget) {
                        return (!$model->status); // do not allow editing of inactive records
                    },
                    'editableOptions' => [
                        'header' => 'Month 1 Budget',
                        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                        'options' => [
                            'pluginOptions' => ['min' => 0, 'max' => 5000]
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
                    'label' => 'Quarter Budget',
                    'attribute' => 'quarter_amount',
                    'readonly' => true,
                    'editableOptions' => [
                        'header' => 'Quarter Budget',
                        'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                        'options' => [
                            'pluginOptions' => ['min' => 0, 'max' => 5000]
                        ]
                    ],
                    'hAlign' => 'right',
                    'vAlign' => 'middle',
                    'width' => '7%',
                    'format' => ['decimal', 2],
                    'pageSummary' => true
                ],
                ['class' => 'yii\grid\ActionColumn',
                    'options' => ['style' => 'width:7%;'],
                    'header' => 'Action',
                    'template' => '{view}{submit}{decline}',
                    'buttons' => [
                                                 'view' =>function ($url, $model) use ($user, $template_model, $cost_centre_id) {
        if (User::userIsAllowedTo('View AWPB') ) {
            return Html::a(
                            '<span class="fa fa-eye"></span>', ['awpb-funds-requisition/quarterly-operations-funds-requisition', 'id' => $model->cost_centre_id,'id3'=>$cost_centre_id], [
                        'title' => 'Quarterly Operations Funds Requisition Form',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'data-pjax' => '0',
                        'style' => "padding:5px;",
                        'class' => 'bt btn-lg'
                            ]
            );
        }
    },
        
                        'submit' => function ($url, $model) use ($user, $template_model,$cost_centre_id) {
                            $district_model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $model->awpb_template_id, 'cost_centre_id' => $model->cost_centre_id]);
                            if (!empty($district_model)) {
                                if (User::userIsAllowedTo('Approve Funds Requisition') && ($user->province_id == 0 || $user->province_id == '')) {

                                    if ($district_model->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED) {


                                        return Html::a(
                                                        '<span class="fa fa-check"></span>', ['awpb-district/submit', 'id' => $district_model->id, 'id2' => $model->cost_centre_id, 'id3'=>$cost_centre_id, 'status' => \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED], [
                                                    'title' => 'Approve Funds Disurbsement',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    // 'target' => '_blank',
                                                    'data-pjax' => '0',
                                                    // 'style' => "padding:5px;",
                                                    'class' => 'bt btn-lg'
                                                        ]
                                        );
                                    } else {
                                        return "Request Approved";
                                    }
                                } else if (User::userIsAllowedTo('Disburse Funds') && ($user->province_id == 0 || $user->province_id == '')) {
//                        
                                    if ($district_model->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED) {

                                        return Html::a(
                                                        '<span class="fa fa-check"></span>', ['awpb-district/submit', 'id' => $district_model->id, 'id2' => $model->cost_centre_id,'id3'=>$cost_centre_id, 'status' => \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED], [
                                                    'title' => 'Disburse Funds',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    // 'target' => '_blank',
                                                    'data-pjax' => '0',
                                                    // 'style' => "padding:5px;",
                                                    'class' => 'bt btn-lg'
                                                        ]
                                        );
                                    } else {

                                        return "Funds Disbursed";
                                    }
                                }
                            }
                        },
                        'decline' => function ($url, $model) use ($user, $template_model, $cost_centre_id) {
                            $district_model = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $model->awpb_template_id, 'cost_centre_id' => $model->cost_centre_id]);
                            if (!empty($district_model)) {
                                if (User::userIsAllowedTo('Approve Funds Requisition') && ($user->province_id == 0 || $user->province_id == '')) {
//                        
                                    if ($district_model->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED ||
                                            $district_model->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED) {

                                        return Html::a(
                                                        '<span class="fa fa-ban"></span>', ['awpb-district/decline', 'id' =>  $district_model->id, 'id2' => $model->cost_centre_id,'id3'=>$cost_centre_id, 'status' => \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED], [
                                                    'title' => 'Decline Funds Request',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    // 'target' => '_blank',
                                                    'data-pjax' => '0',
                                                    // 'style' => "padding:5px;",
                                                    'class' => 'bt btn-lg'
                                                        ]
                                        );
                                    }
                                } else if (User::userIsAllowedTo('Disburse Funds') && ($user->province_id == 0 || $user->province_id == '')) {
//                        
                                    if ($district_model->status_q_1 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_2 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_3 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED ||
                                            $district_model->status_q_4 == \backend\models\AwpbDistrict::STATUS_QUARTER_APPROVED) {

                                        return Html::a(
                                                        '<span class="fa fa-ban"></span>', ['awpb-district/decline', 'id' => $district_model->id, 'id2' => $model->cost_centre_id,'id3'=>$cost_centre_id, 'status' => \backend\models\AwpbDistrict::STATUS_QUARTER_REQUESTED], [
                                                    'title' => 'Decline Funds Disburment',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    // 'target' => '_blank',
                                                    'data-pjax' => '0',
                                                    // 'style' => "padding:5px;",
                                                    'class' => 'bt btn-lg'
                                                        ]
                                        );
                                    }
                                }
                            }
                        },
//                   
//               
                    ]]
//              
            ];

            if ($dataProvider->getCount() > 0) {
                //Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
                // echo ' </p>';
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
            }

            echo GridView::widget([
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
        }
        ?>
        <div class="row" style="">
            <div class="col-lg-12">
                <div class="row" style="">
                    <div class="col-lg-5">

                    </div>


                    <div class="col-lg-5">
                        <?php
                        //if ($funds_requisition->funds_request==0) {
                        ?> </div>
                </div></div></div>


    </div>
</div>
<?php
$this->registerCss('.popover-x {display:none}');
?>