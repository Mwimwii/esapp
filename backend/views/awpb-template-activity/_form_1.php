<?php

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use backend\models\AwpbComponent;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\builder\Form;
/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplateActivity */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card">

<div class="card-body">
<div class="row">
		<div class="col-md-6">
        <?php
        
        


$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);

echo Form::widget([       // 3 column layout
    'model'=>$model,
    'form'=>$form,
    'columns'=>3,
    'compactGrid'=>true,
    'attributes'=>[
        'created_at'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\DatePicker', 
            'hint'=>'Enter birthday (mm/dd/yyyy)'
        ],
        'id'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\select2\Select2', 
            'options'=>['data'=>$model->id], 
            'hint'=>'Type and select state'
        ],
//        'color'=>[
//            'type'=>Form::INPUT_WIDGET, 
//            'widgetClass'=>'\kartik\color\ColorInput', 
//            'hint'=>'Choose your color'
//        ],
        'id'=>[
            'type'=>Form::INPUT_RADIO_LIST, 
            'items'=>[true=>'Active', false=>'Inactive'], 
            'options'=>['inline'=>true]
        ],
        'id'=>[
            'type'=>Form::INPUT_WIDGET, 
            'label'=>Html::label('Brightness (%)'), 
            'widgetClass'=>'\kartik\range\RangeInput', 
            'options'=>['width'=>'80%']
        ],
        'actions'=>[
            'type'=>Form::INPUT_RAW, 
            'value'=>'<div style="text-align: right; margin-top: 20px">' . 
                Html::resetButton('Reset', ['class'=>'btn btn-secondary']) . ' ' .
                Html::button('Submit', ['type'=>'button', 'class'=>'btn btn-primary']) . 
                '</div>'
        ],
    ]
]);
//ActiveForm::end();


?>
</div>  
<?php ActiveForm::end(); ?>
 </div>
</div></div>

