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
use backend\models\AwpbTemplate;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB Programme Wide (PW) Activities';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;

//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;


$user = User::findOne(['id' => Yii::$app->user->id]);
//$role = \common\models\Role::findOne(['id' => $user->role])->role;
$access_level = 1;
$time = new \DateTime('now');
$today = $time->format('Y-m-d');
$template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();

//$awpb_district = \backend\models\AwpbDistrict::findOne(['awpb_template_id' => $id, 'province_id' => null]);
////$status = 100;
//if (!empty($awpb_district)) {
//    $status = $awpb_district->status;
//}

//$awpb_district->status=0;
?>

<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
<h3><?= Html::encode($this->title) ?></h3>
        <p>
        <?php
        if ((User::userIsAllowedTo("Manage PW AWPB") || User::userIsAllowedTo('Approve AWPB - PCO') ) && ($user->province_id == 0 || $user->province_id == '')) {

//        if (User::userIsAllowedTo("Manage AWPB") || User::userIsAllowedTo("Approve AWPB - Provincial") || User::userIsAllowedTo('Approve AWPB - PCO') || User::userIsAllowedTo('Approve AWPB - Ministry')) {


            if (!empty($template_model)) {
                if (strtotime($template_model->submission_deadline) >= strtotime($today) && $status == \backend\models\AwpbBudget::STATUS_DRAFT) {

//                    echo Html::a('Add AWPB PW Activity', ['createpw'], ['class' => 'btn btn-success btn-sm']);
//                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

                   echo Html::a(
                                        '<span class="btn btn-success float-left">Add AWPB PW Activity</span>',['awpb-budget/createpw'], [ 
                                    'title' => 'Add AWPB PW Activity',
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
            if (!empty($template_model)) {
                if (strtotime($template_model->submission_deadline) >= strtotime($today) && $status == \backend\models\AwpbTemplate::STATUS_DRAFT) {
                    if ($dataProvider->getCount() > 0) {

                     //   echo Html::a('Submit District AWPB', ['submitpw', 'id' => $id, 'status' => AwpbBudget:: STATUS_SUBMITTED], ['class' => 'float-right btn btn-success btn-sm btn-space']);
                    
                         echo Html::a(
                                        '<span class="btn btn-success float-right">Submit PW AWPB</span>',['submitpw', 'id' => $id, 'status' => AwpbBudget:: STATUS_SUBMITTED], [ 
                                    'title' => 'Submit PW AWPB',
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
        }
        ?>
    <?php
    $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '36px',
            'pageSummary' => 'Total',
            'pageSummaryOptions' => ['colspan' => 3],
            'header' => '',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],
        [
            'attribute' => 'component_id',
            'label' => 'Component',
            'vAlign' => 'middle',
            'width' => '7%',
            'value' => function ($model, $key, $index, $widget) {
                $component = \backend\models\AwpbComponent::findOne(['id' => $model->component_id]);

                return !empty($component) ? $component->code : "";
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(backend\models\AwpbComponent::find()->orderBy('code')->asArray()->all(), 'id', 'code'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Filter by component'],
            'format' => 'raw'
        ],
        [
            'attribute' => 'activity_id',
            'label' => 'Activity',
            'vAlign' => 'middle',
            //'width' => '180px',
            'value' => function ($model) {
                $name = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id]);

                return $name->activity_code . ' ' . $name->name;
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \backend\models\AwpbActivity::getAwpbActivitiesList($access_level),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                'options' => ['multiple' => true]
            ],
            'filterInputOptions' => ['placeholder' => 'Filter by activity'],
            'format' => 'raw'
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'quarter_one_quantity',
            'readonly' => true,
            //='readonly' => function($model, $key, $index, $widget) {
            //    return (!$model->status); // do not allow editing of inactive records
            // },
            'filterType' => false,
            'refreshGrid' => true,
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
            'attribute' => 'quarter_two_quantity',
            'readonly' => true,
            //'readonly' => function($model, $key, $index, $widget) {
            //    return (!$model->status); // do not allow editing of inactive records
            // },
            'refreshGrid' => true,
            'editableOptions' => [
                'header' => 'Q2 Qty',
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
            'attribute' => 'quarter_three_quantity',
            'readonly' => true,
            //'readonly' => function($model, $key, $index, $widget) {
            //    return (!$model->status); // do not allow editing of inactive records
            // },
            'refreshGrid' => true,
            'editableOptions' => [
                'header' => 'Q3 Qty',
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
            'attribute' => 'quarter_four_quantity',
            'readonly' => true,
            //'readonly' => function($model, $key, $index, $widget) {
            //    return (!$model->status); // do not allow editing of inactive records
            // },
            'refreshGrid' => true,
            'editableOptions' => [
                'header' => 'Q4 Qty',
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
            'attribute' => 'total_amount',
            'label' => 'Budget',
            //'width' => '7%',
            'readonly' => true,
            //'readonly' => function($model, $key, $index, $widget) {
            //    return (!$model->status); // do not allow editing of inactive records
            // },
//            'value' => function ($model) {
//                //  \backend\models\AwpbInput::findOne(['id' =>  $model->indicator_id])->name;
//                $total_amount = \backend\models\AwpbInput::find()->where(['budget_id' => $model->id])->sum('total_amount');
//                return $total_amount; // Html::a($name, ['awpb-ind/view', 'id' => $model->indicator_id], ['class' => 'awbp-indicator']);
//            },
            'refreshGrid' => true,
            'editableOptions' => [
                'header' => 'Budget',
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
        // // //'id',
        // [
        //     'class' => 'kartik\grid\CheckboxColumn',
        //     'headerOptions' => ['class' => 'kartik-sheet-style'],
        //     'pageSummary' => '<small>(amounts in $)</small>',
        //     'pageSummaryOptions' => ['colspan' => 3, 'data-colspan-dir' => 'rtl']
        // ],
        ['class' => 'yii\grid\ActionColumn',
             'options' => ['style' => 'width:8%;'],
            'header' => 'Action',
             
            'template' => '{view}{update}{delete}',
            'buttons' => [
                'view' => function ($url, $model) use ($status) {
                    if (User::userIsAllowedTo('View AWPB') || User::userIsAllowedTo('Manage PW AWPB')) {
                        return Html::a(
                                        '<span class="fa fa-eye"></span>', ['viewpw', 'id' => $model->id, 'status' => $status], [
                                    'title' => 'View AWPB',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data-pjax' => '0',
                                    'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );
                    }
                },
                'update' => function ($url, $model) use ($editable, $user, $template_model, $today, $status) {
                    if ($editable == 1 && User::userIsAllowedTo('Manage PW AWPB') && ($user->province_id == 0 || $user->province_id == '')) {
                        if (strtotime($template_model->submission_deadline) >= strtotime($today) && $status == \backend\models\AwpbTemplate::STATUS_DRAFT) {

                            return Html::a(
                                            '<span class="fas fa-edit"></span>', ['updatepw', 'id' => $model->id, 'status' => $status], [
                                        'title' => 'Update AWPB',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        // 'target' => '_blank',
                                        'data-pjax' => '0',
                                        'style' => "padding:5px;",
                                        'class' => 'bt btn-lg'
                                            ]
                            );
                        }
                    }
                },
                'delete' => function ($url, $model) use ($editable, $user, $template_model, $today, $status) {
                    if ($editable == 1 && User::userIsAllowedTo('Manage PW AWPB') && ($user->province_id == 0 || $user->province_id == '')) {
                        if (strtotime($template_model->submission_deadline) >= strtotime($today) && $status == \backend\models\AwpbTemplate::STATUS_DRAFT) {


                            if ($model->total_amount <= 0) {
                                return Html::a(
                                                '<span class="fa fa-trash"></span>', ['deletepw', 'id' => $model->id, 'id2' => $model->awpb_template_id, 'status' => $status], [
                                            'title' => 'delete AWPB',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete this AWPB?',
                                                'method' => 'post',
                                            ],
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        }
                    }
                },
            ]
        ],
    ];

    if ($dataProvider->getCount() > 0) {

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
    }
    ?>


            <?=
            GridView::widget([
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
            

            </p>




            <div class="row">
                <div class="col-md-12">
            <?php
            
        
       
        ?>
            </div>
        </div>
    </div>
</div>
        <?php
        $this->registerCss('.popover-x {display:none}');
        ?>