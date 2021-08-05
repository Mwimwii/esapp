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
use backend\models\Storyofchange;
use backend\models\AwpbBudget;
use backend\models\AwpbActivityLineSearch;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CommodityPriceCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Provincial AWPB';
//$province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
$this->params['breadcrumbs'][] = $this->title;

//$this->params['breadcrumbs'][] = \backend\models\Provinces::findOne($province_id)->name;
//$this->params['breadcrumbs'][] = \backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->name;

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
//var_dump($status);
?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">
        <p>

<?php
//$searchModel = "";
//$dataProvider="";
?>


        </p>



<?php
$gridColumns = [
    [
        'class' => 'kartik\grid\SerialColumn',
        'contentOptions' => ['class' => 'kartik-sheet-style'],
        'width' => '36px',
        'pageSummary' => 'Total',
        'pageSummaryOptions' => ['colspan' => 2],
        'header' => '',
        'headerOptions' => ['class' => 'kartik-sheet-style']
    ],
    [
        'attribute' => 'awpb_template_id',
        'label' => 'Fiscal Year',
        'vAlign' => 'middle',
        'width' => '180px',
        'value' => function ($model) {
            $name = \backend\models\AwpbTemplate::findOne(['id' => $model->awpb_template_id])->fiscal_year;
            return Html::a($name, ['awpb-template/view', 'id' => $model->awpb_template_id], ['class' => 'awbp-template']);
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
        'attribute' => 'district_id',
        'format' => 'raw',
        'label' => 'District',
        'value' => function ($model) use ($status) {

            return !empty($model->district_id) && $model->district_id > 0 ? Html::a(backend\models\Districts::findOne($model->district_id)->name, ['mpcd', 'status' => $status, 'id' => $model->district_id, 'id2' => $model->province_id], ['class' => 'mpcd']) : "";
            ;
        },
    //     'visible' => !empty($model->district_id) && $model->district_id > 0 ? TRUE : FALSE,
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'quarter_one_amount',
        'readonly' => true,
        //='readonly' => function($model, $key, $index, $widget) {
        //    return (!$model->status); // do not allow editing of inactive records
        // },
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
        'attribute' => 'quarter_two_amount',
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
        'attribute' => 'quarter_three_amount',
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
        'attribute' => 'quarter_four_amount',
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
        'class' => 'kartik\grid\FormulaColumn',
        'attribute' => 'total_amount',
        'header' => 'Total <br> Amount',
        'vAlign' => 'middle',
        'hAlign' => 'right',
        'width' => '7%',
        'format' => ['decimal', 2],
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'mergeHeader' => true,
        'pageSummary' => true,
        'pageSummaryFunc' => GridView::F_SUM,
        'footer' => true
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'vAlign' => 'middle',
        'width' => '10%',
        'template' => '{declinep}',
        'buttons' => [
//                
//                'update' => function ($url, $model) use ($user){
//                  $awpb_province =  \backend\models\AwpbProvince::findOne(['awpb_template_id' =>$model->awpb_template_id, 'province_id'=>$model->province_id]);
//                            //$status=100;
//                            if (!empty($awpb_province)) {
//                              $status= $awpb_province->status;
//
//                            }
//                   if ((User::userIsAllowedTo('Approve AWPB - PCO') && $status == \backend\models\AwpbBudget::STATUS_REVIEWED) || (User::userIsAllowedTo('Approve AWPB - Ministry') && $status == \backend\models\AwpbBudget::STATUS_APPROVED )) {
//
//                              
//                        return Html::a(
//                                        '<span class="fas fa-check">'.$status.'</span>',['submit','id'=>$model->province_id,'status'=> \backend\models\AwpbBudget:: STATUS_APPROVED], [ 
//                                    'title' => 'Approve Provincial AWPB',
//                                    'data-toggle' => 'tooltip',
//                                    'data-placement' => 'top',
//                                    // 'target' => '_blank',
//                                    'data-pjax' => '0',
//                                   // 'style' => "padding:5px;",
//                                    'class' => 'bt btn-lg'
//                                        ]
//                        );
//                        
//                  }
//                },
            'declinep' => function ($url, $model) use ($user, $template_model, $today) {
                $awpb_province = \backend\models\AwpbProvince::findOne(['awpb_template_id' => $template_model->id, 'province_id' => $model->province_id]);
                $status = 100;
                if (!empty($awpb_province)) {
                    $status = $awpb_province->status;
                }
                if (User::userIsAllowedTo('Approve AWPB - Provincial') && strtotime($template_model->consolidation_deadline) >= strtotime($today) && $status == AwpbBudget::STATUS_SUBMITTED && ($user->province_id > 0 || $user->province_id != '')) {



                    return Html::a(
                                    '<span class="fas fa-times-circle"></span>', ['awpb-comment/declinep', 'id' => $model->district_id], [
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
            },
        ]]
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

    if (User::userIsAllowedTo('Approve AWPB - Provincial') && strtotime($template_model->consolidation_deadline) >= strtotime($today) && $status == AwpbBudget::STATUS_SUBMITTED && $status1 == 1 && ($user->province_id > 0 || $user->province_id != '')) {
        //  $status= \backend\models\AwpbBudget::STATUS_SUBMITTED;



        echo Html::a(
                '<span class="btn btn-success float-right">Approve Budget</span>', ['submit', 'id' => $id, 'id2' => $id2, 'status' => \backend\models\AwpbBudget:: STATUS_REVIEWED], [
            'title' => 'Submit Provincial AWPB',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            // 'target' => '_blank',
            'data-pjax' => '0',
            // 'style' => "padding:5px;",
            'class' => 'bt btn-lg'
                ]
        );
    }

    if (User::userIsAllowedTo('Approve AWPB - PCO') && $status == AwpbBudget::STATUS_REVIEWED && (($user->province_id == 0 || $user->province_id == ''))) {
        //   $status= \backend\models\AwpbBudget::STATUS_REVIEWED;
        echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['mp', 'id' => $id, 'status' => $status], [
            'title' => 'back',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
        ]);

        echo Html::a(
                '<span class="btn btn-success float-left">Approve Budget</span>', ['submit', 'id' => $id, 'id2' => $id2, 'status' => \backend\models\AwpbBudget:: STATUS_APPROVED], [
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
    }


    if (User::userIsAllowedTo('Approve AWPB - Ministry') && $status == AwpbBudget::STATUS_APPROVED && ($user->province_id == 0 || $user->province_id == '')) {

        echo Html::a(
                '<span class="btn btn-success float-left">Approve Budget</span>', ['submit', 'id' => $id, 'id2' => $province_id, 'status' => \backend\models\AwpbBudget:: STATUS_MINISTRY], [
            'title' => 'Approve Provincial AWPB',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            // 'target' => '_blank',
            'data-pjax' => '0',
            // 'style' => "padding:5px;",
            'class' => 'bt btn-lg'
                ]
        );

        //  $status= \backend\models\AwpbBudget::STATUS_APPROVED;
    }
}
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
//    }
?>


        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'columns' => $gridColumns,
            // 'pjax' => true,
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