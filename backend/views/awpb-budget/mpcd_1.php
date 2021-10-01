<?php

/////use kartik\editable\Editable;
//use kartik\grid\EditableColumn;
//use kartik\grid\GridView;
//use yii\helpers\Html;
//use kartik\form\ActiveForm;
//use yii\grid\ActionColumn;
//use backend\models\User;
//use \kartik\popover\PopoverX;
//use kartik\depdrop\DepDrop;
//use yii\helpers\Url;
use kartik\export\ExportMenu;
//use kartik\money\MaskMoney;
//use yii\helpers\ArrayHelper;
//use yii\helpers\Json;
//use yii\data\ActiveDataProvider;
//use ivankff\yii2ModalAjax\ModalAjax;
use backend\models\AwpbActivityLine;
use backend\models\AwpbActivityLineSearch;
//use yii\web\Controller;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use backend\models\User;
use kartik\form\ActiveForm;
use kartik\number\NumberControl;
use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use yii\grid\ActionColumn;
use kartik\touchspin\TouchSpin;
use ivankff\yii2ModalAjax\ModalAjax;
use yii\helpers\ArrayHelper;
use backend\models\AwpbBudget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'District AWPB';
//$this->params['breadcrumbs'][] = ['label' => 'District AWPB', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
//$district_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
//$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;
//$template_model =  \backend\models\AwpbTemplate::find()->where(['status' =>\backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
$user = User::findOne(['id' => Yii::$app->user->id]);
$role = \common\models\Role::findOne(['id' => $user->role])->role;

$access_level = 1;

$time = new \DateTime('now');
$today = $time->format('Y-m-d');
$template_model = \backend\models\AwpbTemplate::find()->where(['status' => \backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
$awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $template_model->id, 'province_id' => $id2]);
$status = 100;
if (!empty($awpb_province)) {
    $status = $awpb_province->status;
}
?>
<div class="card card-success card-outline">

    <div class="card-body" style="overflow: auto;">
        <p>

<?php
//   echo Html::a('<span class="fas fa-arrow-left fa-2x float-left"></span>', ['mpc', 'id' => $awpb_template_id,'id2'=>$province_id,'status'=> $status], [
//    'title' => 'back',
//    'data-toggle' => 'tooltip',
//    'data-placement' => 'top',
//]);
//  
//
//   echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";


if (User::userIsAllowedTo('Approve AWPB - Provincial') && $status == AwpbBudget::STATUS_SUBMITTED  && ($user->province_id > 0 || $user->province_id != '')) {
    //  $status= \backend\models\AwpbBudget::STATUS_SUBMITTED;
    if (strtotime($template_model->consolidation_deadline) >= strtotime($today)) {


            echo Html::a(
                '<span class="btn btn-success float-left">Approve Budget</span>', ['submit', 'id' => $id, 'id2' => $id2, 'status' => \backend\models\AwpbBudget:: STATUS_REVIEWED], [
            'title' => 'Approve Provincial AWPB',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            // 'target' => '_blank',
            'data-pjax' => '0',
            // 'style' => "padding:5px;",
            'class' => 'bt btn-lg'
                ]
        );


                    echo Html::a(
                                        '<span class="btn btn-success float-right">Decline Budget</span>', ['awpb-comment/declinep', 'id' => $id], [
                                'title' => 'Decline Provincial AWPB',
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

if (User::userIsAllowedTo('Approve AWPB - PCO') && $status == \backend\models\AwpbBudget::STATUS_REVIEWED && (($user->province_id == 0 || $user->province_id == ''))) {

    echo Html::a(
            '<span class="fas fa-check"></span>', ['submit', 'id' => $awpb_template_id, 'id2' => $province_id, 'status' => \backend\models\AwpbBudget:: STATUS_APPROVED], [
        'title' => 'Approve Provincial AWPB',
        'data-toggle' => 'tooltip',
        'data-placement' => 'top',
        // 'target' => '_blank',
        'data-pjax' => '0',
        // 'style' => "padding:5px;",
        'class' => 'bt btn-lg'
            ]
    );
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

    echo '<button class="float-right btn btn-success btn-sm btn-space" href="#" onclick="$(\'#addNewModal\').modal(); 
     return false;"></i> Decline Provincial AWPB </button>';
}


if (User::userIsAllowedTo('Approve AWPB - Ministry') && $status == \backend\models\AwpbBudget::STATUS_APPROVED && ($user->province_id == 0 || $user->province_id == '')) {

    echo Html::a(
            '<span class="fas fa-check"></span>', ['submit', 'id' => $awpb_template_id, 'id2' => $province_id, 'status' => \backend\models\AwpbBudget:: STATUS_MINISTRY], [
        'title' => 'Approve Provincial AWPB',
        'data-toggle' => 'tooltip',
        'data-placement' => 'top',
        // 'target' => '_blank',
        'data-pjax' => '0',
        // 'style' => "padding:5px;",
        'class' => 'bt btn-lg'
            ]
    );
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

    echo '<button class="float-right btn btn-success btn-sm btn-space" href="#" onclick="$(\'#addNewModal\').modal(); 
     return false;"></i> Decline Provincial AWPB </button>';
}




?>


        </p>



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
//                        $name = \backend\models\AwpbActivity::findOne(['id' => $model->activity_id]);
//
//                        return $name->activity_code . ' ' . $name->name;
                        
                           return !empty($model->activity_id) && $model->activity_id > 0 ? Html::a(backend\models\AwpbActivity::findOne($model->activity_id)->name, ['viewp', 'id' => $model->id,'status' => $model->id ], ['class' => 'mpcd']) : "";
                 
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
                    'attribute' => 'quarter_one_amount',
                    'readonly' => true,
                    //='readonly' => function($model, $key, $index, $widget) {
                    //    return (!$model->status); // do not allow editing of inactive records
                    // },
                    'filterType' => false,
                    'refreshGrid' => true,
                    'editableOptions' => [
                        'header' => 'Q1 Budget',
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
                    'attribute' => 'quarter_two_amount',
                    'readonly' => true,
                    //'readonly' => function($model, $key, $index, $widget) {
                    //    return (!$model->status); // do not allow editing of inactive records
                    // },
                    'refreshGrid' => true,
                    'editableOptions' => [
                        'header' => 'Q2 Budget',
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
                    'attribute' => 'quarter_three_amount',
                    'readonly' => true,
                    //'readonly' => function($model, $key, $index, $widget) {
                    //    return (!$model->status); // do not allow editing of inactive records
                    // },
                    'refreshGrid' => true,
                    'editableOptions' => [
                        'header' => 'Q3 Budget',
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
                    'attribute' => 'quarter_four_amount',
                    'readonly' => true,
                    //'readonly' => function($model, $key, $index, $widget) {
                    //    return (!$model->status); // do not allow editing of inactive records
                    // },
                    'refreshGrid' => true,
                    'editableOptions' => [
                        'header' => 'Q4 Budget',
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
                // [
                //     'class' => 'kartik\grid\FormulaColumn', 
                //     'attribute' => 'total_quantity', 
                //     'header' => 'Total <br> Quantity', 
                //    // 'refreshGrid' => true,
                //     'vAlign' => 'middle',
                //     'value' => function ($model, $key, $index, $widget) { 
                //         $p = compact('model', 'key', 'index');
                //         return $widget->col(6, $p)+$widget->col(7, $p)+$widget->col(8, $p) + $widget->col(9, $p);
                //     },
                //     'headerOptions' => ['class' => 'kartik-sheet-style'],
                //     'hAlign' => 'right', 
                //     'width' => '7%',
                //     'format' => ['decimal', 2],
                //     'mergeHeader' => true,
                //     'pageSummary' => true,
                //     'footer' => true
                // ],
                // [
                //     'class' => 'kartik\grid\FormulaColumn', 
                //     'attribute' => 'total_amount', 
                //     'header' => 'Total <br> Amount', 
                //     'vAlign' => 'middle',
                //     'hAlign' => 'right', 
                //     'width' => '7%',
                //     'value' => function ($model, $key, $index, $widget) { 
                //         $p = compact('model', 'key', 'index');
                //         return $widget->col(10, $p) != 0 ? $widget->col(5, $p) * $widget->col(10, $p) : 0;
                //     },
                //     'format' => ['decimal', 2],
                //     'headerOptions' => ['class' => 'kartik-sheet-style'],
                //     'mergeHeader' => true,
                //     'pageSummary' => true,
                //     'pageSummaryFunc' => GridView::F_SUM,
                //     'footer' => true
                // ],
//                         [
//            'attribute' => 'total_amount',
//            'label' => 'Budget', 
//            'vAlign' => 'middle',
//            'width' => '180px',
//
//            'value' => function ($model) {
//               //  \backend\models\AwpbInput::findOne(['id' =>  $model->indicator_id])->name;
//               $total_amount =\backend\models\AwpbInput::find()->where(['budget_id'=>$model->id])->sum('total_amount');
//                return $total_amount; // Html::a($name, ['awpb-ind/view', 'id' => $model->indicator_id], ['class' => 'awbp-indicator']);
//            },
//           
//          
//        ],
                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'total_amount',
                    'label' => 'Budget',
                    'readonly' => true,
                    //'readonly' => function($model, $key, $index, $widget) {
                    //    return (!$model->status); // do not allow editing of inactive records
                    // },
//                    'value' => function ($model) {
//                        //  \backend\models\AwpbInput::findOne(['id' =>  $model->indicator_id])->name;
//                        $total_amount = \backend\models\AwpbInput::find()->where(['budget_id' => $model->id])->sum('total_amount');
//                        return $total_amount; // Html::a($name, ['awpb-ind/view', 'id' => $model->indicator_id], ['class' => 'awbp-indicator']);
//                    },
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
                    'options' => ['style' => 'width:50px;'],
                    'header' => 'Action',
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) use ($status) {
                            if (User::userIsAllowedTo('View AWPB') || User::userIsAllowedTo('Manage AWPB')) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id, 'status' => $status], [
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
                            if ($editable == 1 && User::userIsAllowedTo('Manage AWPB') && ($user->district_id != 0 || $user->district_id != '')) {
                                if (strtotime($template_model->submission_deadline) >= strtotime($today) && $status == \backend\models\AwpbTemplate::STATUS_DRAFT) {

                                    return Html::a(
                                                    '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id, 'status' => $status], [
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
                            if ($editable == 1 && User::userIsAllowedTo('Manage AWPB') && ($user->district_id != 0 || $user->district_id != '')) {
                                if (strtotime($template_model->submission_deadline) >= strtotime($today) && $status == \backend\models\AwpbTemplate::STATUS_DRAFT) {


                                    if ($model->total_amount <= 0) {
                                        return Html::a(
                                                        '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id, 'id2' => $model->awpb_template_id, 'status' => $status], [
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


    </div>
</div>




        <?php
        $this->registerCss('.popover-x {display:none}');
        ?>