<?php

<<<<<<< HEAD
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;;
use kartik\editable\Editable;
use backend\models\User;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwpbTemplateSearch */
=======
use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use backend\models\User;
use kartik\popover\PopoverX;
use backend\models\AwpbTemplate;
use backend\models\AwpbTemplateActivity;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoryofchangeSearch */
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB Templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<<<<<<< HEAD

<div class="card card-success card-outline">
    <div class="card-body">

        <p>
            <?php
            if (\backend\models\User::userIsAllowedTo('Manage AWPB templates')) {
               echo Html::a('<i class="fa fa-plus"></i> Add AWPB Template', ['create'], ['class' => 'btn btn-success btn-sm']);
            }
            ?>
        </p>
        <hr class="dotted short">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'fiscal_year',
            'budget_theme',
            'comment',
            //'status',
            
             [
                    'label' => 'Status',
                    'value' => function($model) {
                        if ($model->status==1)
                        {
                            return "Active";
                              
                        }
                        else
                        {
                           
                            return "Blocked";
                        }
                        // $user = \backend\models\User::findOne(['id' => $model->created_by]);
                        // return !empty($user) ? $user->first_name . " " . $user->other_name . " " . $user->last_name . "-" . $user->email : "";
                    }
                ],
                /*
                ['class' => 'yii\grid\ActionColumn',
                    'label' => 'Updated by',
                    'value' => function($model) {
                        $user = \backend\models\User::findOne(['id' => $model->updated_by]);
                        return !empty($user) ? $user->first_name . " " . $user->other_name . " " . $user->last_name . "-" . $user->email : "";
                    }
                ],
                [
                    'label' => 'Updated at',
                    'value' => function($model) {
                        return date('d-F-Y H:i:s', $model->updated_at);
                    }
                ],
               [
                    'label' => 'Created at',
                    'value' => function($model) {
                        return date('d-F-Y H:i:s', $model->created_at);
                    }
                ], */
        
 ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view}{activity}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            if (User::userIsAllowedTo('View AWPB templates') && User::STATUS_ACTIVE) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                            'title' => 'View AWPB template',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                       'activity' => function ($url, $model) {
                              if (User::userIsAllowedTo('View AWPB activities') && User::STATUS_ACTIVE){
                                return Html::a(
                                                '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id], [
                                            'title' => 'View AWPB activities',
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
                        'delete' => function ($url, $model) {
                            if (User::userIsAllowedTo('Manage AWPB templates') ) {
                                return Html::a(
                                                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                            'title' => 'Delete AWPB template',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to remove '.$model->fiscal_year . ' AWPB template?',
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
            ],
        ]);


            ?>


</div>
=======
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <li>Click <span class="badge badge-success">Add AWPB template</span> button below to 
                add a new AWPB template
            </li>
            <li>You can only edit an AWPB template which has not been published
            </li>
            <li>To edit the template details, click the 
                <span class="badge badge-primary"><span class="fa fa-edit fa-1x"></span></span> 
                icon in the table below
            </li>
            <li>To view the AWPB template details, click the 
                <span class="badge badge-primary"><span class="fa fa-eye fa-1x"></span></span> 
                icon in the table below
            </li>
            <li>You can delete the AWPB template that have not yet been published. To delete a template, click the
                <span class="badge badge-primary"><span class="fa fa-trash fa-1x"></span></span> 
                icon in the table below
            </li>
        </ol>
               <p>
            <?php
            if (\backend\models\User::userIsAllowedTo('Manage AWPB templates')) {
               echo Html::a('<i class="fa fa-plus"></i> Add AWPB Template', ['create'], ['class' => 'btn btn-success btn-xs']);
            }
            ?>
        </p>



        <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'
            ],
               
                [ 'attribute' => 'fiscal_year', 'filter' => false,
                'width' => '100px',
                'format' => 'raw'],
               [ 'attribute' => 'budget_theme', 'filter' => false,
                'format' => 'raw'],
              
                [ 'attribute' => 'comment', 'filter' => false,
                
                'format' => 'raw'],
                [
                    'attribute' => 'status',
                    'width' => '360px',
                    //'class' => EditableColumn::className(),
                    'enableSorting' => true,
                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => [
                    AwpbTemplate::STATUS_DRAFT  => 'Pending publication',
                    AwpbTemplate::STATUS_PUBLISHED =>'Current AWPB Template',
                    AwpbTemplate::STATUS_CURRENT_BUDGET =>'Current budget',
                    AwpbTemplate::STATUS_OLD_BUDGET => 'Old budget'
                     
                    ],
                    'filterInputOptions' => ['prompt' => 'Filter by Status', 'class' => 'form-control', 'id' => null],
                    'format' => 'raw',
                    'value' => function($model) {
                        $str = "";
                        if ($model->status ==  AwpbTemplate::STATUS_DRAFT ) {
                            $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-primary'> "
                            . "<i class='fa fa-times'></i> 'Pending publication'</p><br>";
                        } elseif ($model->status ==  AwpbTemplate::STATUS_PUBLISHED) {
                            $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-secondary'> "
                            . "<i class='fa fa-times'></i>Current AWPB Template </p><br>";
                           
                        } elseif ($model->status == AwpbTemplate::STATUS_CURRENT_BUDGET) {
                            $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-success'> "
                            . "<i class='fa fa-check'></i>Current budget</p><br>";
                        } else {
                            $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-info'> "
                            . "<i class='fa fa-times'></i>". $model->fiscal_year." budget</p><br>";
                          
                        }
                        return $str;
                    },
                ],
                //'paio_review_status',
                //'paio_comments:ntext',
                //'ikmo_review_status',
                //'ikmo_comments:ntext',
                //'created_at',
                //'updated_at',
                //'created_by',
                //'updated_by',
                ['class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:150px;'],
                'template' => '{view}{check-list}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        if (User::userIsAllowedTo('View AWPB templates')) {
                            return Html::a(
                                            '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                        'title' => 'View AWPB template',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data-pjax' => '0',
                                        'style' => "padding:5px;",
                                        'class' => 'bt btn-lg'
                                            ]
                            );
                        }
                    },
                   'check-list' => function ($url, $model) {
                       //  if (User::userIsAllowedTo('Setup AWPB') && $model->status==AwpbTemplate::STATUS_DRAFT){
                          if (User::userIsAllowedTo('Setup AWPB') &&($model->status==AwpbTemplate::STATUS_DRAFT || $model->status==AwpbTemplate::STATUS_PUBLISHED)){
                            return Html::a(
                                            '<span class="fas fa-edit"></span>', ['check-list', 'id' => $model->id], [
                                        'title' => 'Update template',
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
                    'delete' => function ($url, $model) {
                       if (User::userIsAllowedTo('Setup AWPB') && $model->status==AwpbTemplate::STATUS_DRAFT){
                            return Html::a(
                                            '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                        'title' => 'Delete AWPB template',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to remove '.$model->fiscal_year . ' AWPB template?',
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
            ],
        ]);
        ?>


    </div>
</div>
<?php
$this->registerCss('.popover-x {display:none}');
?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
