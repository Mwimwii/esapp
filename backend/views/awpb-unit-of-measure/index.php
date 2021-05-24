<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;;
use kartik\editable\Editable;
use backend\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwpbUnitOfMeasureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB Unit Of Measures';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="card card-success card-outline">
    <div class="card-body">

        <p>
            <?php
           if (User::userIsAllowedTo("Setup AWPB") ) {
               echo Html::a('<i class="fa fa-plus"></i> Add AWPB Unit of Measure', ['create'], ['class' => 'btn btn-success btn-sm']);
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
          //  'code',
            'name',
                
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
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            if (User::userIsAllowedTo('View AWPB') && User::STATUS_ACTIVE) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                            'title' => 'View AWPB Unit of Measure',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                
                        'update' => function ($url, $model) {
                            if (User::userIsAllowedTo('Setup AWPB') ) {
                                return Html::a(
                                                '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id], [
                                            'title' => 'Update AWPB Unit of Measure',
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
                            if (User::userIsAllowedTo('Setup AWPB') ) {
                                return Html::a(
                                                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                            'title' => 'Delete AWPB Unit of Measure',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to remove '.$model->name . '?',
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

