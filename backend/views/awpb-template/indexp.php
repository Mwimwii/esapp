<?php

use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use backend\models\User;
use \kartik\popover\PopoverX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CommodityTypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB Commodity Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>
            <?php
             
			
			$form = ActiveForm::begin([
    'id' => 'login-form', 
    'type' => ActiveForm::TYPE_VERTICAL
]); 
echo $form->field($model, 'select_data')->multiselect($model->icons);
ActiveForm::end();
			
			
			
            ?>
			
			
			
			
			
        </p>


<?php
$this->registerCss('.popover-x {display:none}');
?>
