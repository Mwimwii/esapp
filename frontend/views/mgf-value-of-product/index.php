<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\tabs\TabsX;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfValueOfProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Profit and Loss Values';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="mgf-value-of-product-index">

<div style="border: 3px outset grey;background-color: lightblue;text-align: center;">
      <h4><?= Html::encode($this->title) ?></h4>
 </div>
 
    <p>
        <?= Html::a('Value Of Product', ['create'], ['class' => 'btn btn-success']) ?>
        
        <?= Html::a('variable fixed costs', ['/mgf-variable-fixed-cost/create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Interest ', ['/mgf-interests-taxes/create'], ['class' => 'btn btn-success']) ?>
    
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <!--  echo GridView::widget([
    'dataProvider'=> $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'floatHeader'=>true,
    'floatHeaderOptions'=>['top'=>'50']
      ]);
 -->
 <?php
$items = [
    [
        'label'=>'<i class="fas fa-back"></i> Product Value',
        'content'=>GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
             'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
    
                //'id',
                'product_name',
               // 'product_unit',
                'product_yr1_qty',
                'product_yr1_price',
                'product_yr1_value',
                   
                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => [],
                    'header'=>'Actions',
                    'template' => '{view} {update} {delete}',
                    'visibleButtons'=>[ ]
                ],
            ],
        ]),
        'active'=>true,
    ],
    [
        'label'=>'<i class="fas fa-money"></i> Cost of Products',
        'content'=>GridView::widget([
            'dataProvider' => $dataProvider1,
            'filterModel' => $searchModel1,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
    
                //'id',
                'cost_name',
                'cost_type',
                'cost_yr1_value',
                'cost_yr2_value',
                 
                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => [],
                    'header'=>'Actions',
                    'template' => '{view} {update} {delete}',
                    'visibleButtons'=>[
                    ]
                ]
            ],
        ]),
    ],
    [
        'label'=>'<i class="fas fa-chevron-right"></i>Products Total',
        'encode'=>false,
        'content'=>GridView::widget([
        'dataProvider' => $dataProvider2,
        //'filterModel' => $searchModel2,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'total_yr1_value',
            'total_yr2_value',
            'total_yr3_value',
            'total_yr4_value',
            'proposal_id',
            ],
        ]),
    ],
    [
            'label'=>'<i class="fas fa-chevron-right"></i> Variable/Fixed Totals',
            'encode'=>false,
            'content'=>GridView::widget([
            'dataProvider' => $dataProvider3,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
    
                // 'id',
                'total_yr1_value',
                'total_yr2_value',
                'total_yr3_value',
                'total_yr4_value',
                'proposal_id',
                ],
        ]),
    ],

    [
        'label'=>'<i class="fas fa-chevron-right"></i> Gross Profit',
        'encode'=>false,
        'content'=>GridView::widget([
            'dataProvider' => $dataProvider4,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
    
                'id',
                'profit_yr1_value',
                'profit_yr2_value',
                'profit_yr3_value',
                'profit_yr4_value',
                ],
        ]),
    ],
    [
        'label'=>'<i class="fas fa-chevron-right"></i> Net Profit',
        'encode'=>false,
        'content'=>GridView::widget([
            'dataProvider' => $dataProvider5,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
    
               // 'id',
                'netprofit_yr1_value',
                'netprofit_yr2_value',
                'netprofit_yr3_value',
                'netprofit_yr4_value',
                //'proposal_id',
                //'date_created',
                //'date_update',
                //'created_by',
                //'updated_by',
    
               // ['class' => 'yii\grid\ActionColumn'],
            ],
        ]), 
    ],
    [
        'label'=>'<i class="fas fa-chevron-right"></i> Cumulative Profit',
        'encode'=>false,
        'content'=>GridView::widget([
            'dataProvider' => $dataProvider6,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
    
               // 'id',
                'cumulative_profit_yr1_value',
                'cumulative_profit_yr2_value',
                'cumulative_profit_yr3_value',
                'cumulative_profit_yr4_value',
                //'proposal_id',
                //'date_created',
                //'date_update',
                //'created_by',
                //'updated_by',
    
                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]), 
    ],
            
    ];

// Ajax Tabs Above
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_ABOVE,
    'encodeLabels'=>false
]);
/* // Ajax Tabs Below
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_BELOW,
    'encodeLabels'=>false
]);
// Ajax Tabs Left
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_LEFT,
    'encodeLabels'=>false
]);
// Ajax Tabs Right
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_RIGHT,
    'encodeLabels'=>false
]); */
?>

    
</div>
