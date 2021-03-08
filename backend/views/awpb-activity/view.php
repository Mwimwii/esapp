<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use \backend\models\User;

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\base\InvalidCallException;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivity */

$this->title = 'AWPB Activities '.$model->activity_code;
$this->params['breadcrumbs'][] = ['label' => 'AWPB Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="card card-success card-outline">
    <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    
    <?php
    if (\backend\models\User::userIsAllowedTo('Manage AWPB activities')) {
        echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['index', 'id' => $model->id], [
            'title' => 'back',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
        ]);
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
      
        echo Html::a('<span class="fas fa-edit fa-2x"></span>', ['update', 'id' => $model->id], [
            'title' => 'Update component',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
        ]);
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        
            echo Html::a(
                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
            'title' => 'delete component',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data' => [
                'confirm' => 'Are you sure you want to remove this activitiy?',
                'method' => 'post',
            ],
            'style' => "padding:5px;",
            'class' => 'bt btn-lg'
                ]
);
        
    }
 

$fiscal_year="";
$template = \backend\models\AWPBTemplate::findOne(['id' => $model->awpb_template_id]);
	
if (!empty($template)) {
    $fiscal_year=  $template->fiscal_year;
    }

    $comp="";
$component = \backend\models\AWPBComponent::findOne(['id' => $model->component_id]);
	
if (!empty($component)) {
    $comp=  $component->code;
    }
    $unit="";
$unit_of_me = \backend\models\AwpbUnitOfMeasure::findOne(['id' => $model->unit_of_measure_id]);
	
if (!empty($unit_of_me)) {
    $unit=  $unit_of_me->name;
    }
    $expense="";
$expense_cat = \backend\models\AwpbExpenseCategory::findOne(['id' => $model->expense_category_id]);
	
if (!empty($expense_cat)) {
    $expense=  $expense_cat->name;
    }

    $parent_act="";
    $parent_activity = \backend\models\AwpbActivity::findOne(['id' => $model->parent_activity_id]);
        
    if (!empty($parent_activity)) {
        $parent_act=  $parent_activity->activity_code;
        }


?>
<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
            // [
            //     'attribute' => 'awpb_template_id',
            //     'label' => 'AWPB Template',
            //     'format' => 'raw',
            //     "value" => $fiscal_year
            // ],
            
            [
                'attribute'=>'component_id',
                'format' => 'raw',
                'label' => 'Component',
                'value' => $comp
            ],
            [
                'attribute'=>'parent_activity_id',
                'format' => 'raw',
                'label' => 'Parent Activity',
                'value' => $parent_act
            ],
            'activity_code',
            'name',

            [
                'attribute'=>'unit_of_measure_id',
                'format' => 'raw',
                'label' => 'Unit of Measure',
                'value' => $unit
            ],
            [
                'attribute'=>'expense_category_id',
                'format' => 'raw',
                'label' => 'Expense Category',
                'value' =>  $expense
            ],
            
            // 'subcomponent',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
        ],
    ]) ?>




</div>
</div>