<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use kartik\grid\EditableColumn;
//use kartik\grid\GridView;;
//use kartik\editable\Editable;
use backend\models\User;
use backend\models\AwpbUnitOfMeasure;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwbpActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


if (isset(Yii::$app->session['fiscal_year']))
 {
       $fiscal_year = Yii::$app->session['fiscal_year'];
    } 
	else 
	{
        $fiscal_year = null;
    }
   
	
$this->title =  $fiscal_year. ' AWPB Activities';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card card-success card-outline">
    <div class="card-body">

        <p>
         <?php
            if (\backend\models\User::userIsAllowedTo('Manage AWPB activities')) {
               echo Html::a('<i class="fa fa-plus"></i> Add AWPB Activity', ['create'], ['class' => 'btn btn-success btn-sm']);
            }
            ?>
        </p>
        <hr class="dotted short">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],
		//	'awpb_template_id',
			'activity_code',
			//'parent_activity_id',
			//'component_id',
			'description',		
			  [
              'label' => 'Unit of measure',
                    'value' => function($model) {
                        $unit_of_measure = \backend\models\AwpbUnitOfMeasure::findOne(['id' => $model->unit_of_measure_id]);
						
						 if (!empty($unit_of_measure)) {
                            $unit_of_measure_description = $unit_of_measure->description;
                        }
                        return  $unit_of_measure_description;
                        
                    }
                ],
				  [
              'label' => 'Expense Category',
                    'value' => function($model) {
                        $expense_category = \backend\models\AwpbExpenseCategory::findOne(['id' => $model->expense_category_id]);
						
						 if (!empty($expense_category)) {
                            $expense_category_name =  $expense_category->expense_category_name;
                        }
                        return   $expense_category_name;
                        
                    }
                ],
            //'quarter_one_budget',
            //'quarter_two_budget',
            //'quarter_three_budget',
            //'quarter_four_budget',
            //'total_budget',
           // 'expense_category_id',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            /* [
                    'label' => 'Created by',
                    'value' => function($model) {
                        $user = \backend\models\User::findOne(['id' => $model->created_by]);
                        return !empty($user) ? $user->first_name . " " . $user->other_name . " " . $user->last_name . "-" . $user->email : "";
                    }
                ],
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
               /* [
                    'label' => 'Created at',
                    'value' => function($model) {
                        return date('d-F-Y H:i:s', $model->created_at);
                    }
                ],
        */
 ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            if (User::userIsAllowedTo('View AWPB activities') && User::STATUS_ACTIVE) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                            'title' => 'View AWPB activity',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data-pjax' => '0',
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




