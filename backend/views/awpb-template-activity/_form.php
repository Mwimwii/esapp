<?php

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use backend\models\AwpbComponent;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplateActivity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="awpb-template-activity-form">

    <?php $form = ActiveForm::begin();

$model->icons = [
    'align-left' => Html::icon('align-left') . ' Align Left',
    'align-center' => Html::icon('align-center') . ' Align Center',
    'align-right' => Html::icon('align-right') . ' Align Right',
    'align-justify' => Html::icon('align-justify') . ' Align Justify',
    'arrow-down' => Html::icon('arrow-down') . ' Direction Down',
    'arrow-up' => Html::icon('arrow-up') . ' Direction Up',
    'arrow-left' => Html::icon('arrow-left') . ' Direction Left',
    'arrow-right' => Html::icon('arrow-right') . ' Direction Right',
];


?>

<div class="form-group col-lg-6">
    <div class="form-group field-role-role">
        <div class="form-group">
            <?=
          //  $form->field($model, 'role', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' => 'Role name', 'class' => 'form-control', 'required' => true]);
             $form->field($model,'component_id')->dropDownList((AwpbComponent::getAwpbSubComponentsList()),
            [
              'prompt'=>'Select component','id'=>'comp_id']);
         
         ?>
        </div>
    </div>
</div>
<div class="form-group col-lg-12">
    <div class="form-group field-role-rights">
        <label for="role-rights" class="control-label">Permissions<span class="required">*</span></label>
        <?=
        $form->field($model, 'activities')->checkboxList(ArrayHelper::map(\backend\models\AwpbActivity::getActivities(),'right','right'), [
            'item' => function($index, $label, $name, $checked, $value)
             {
                $checked = $checked ? 'checked' : '';
                return "<label class='bt-df-checkbox col-lg-3' > <input type='checkbox' {$checked} name='{$name}' value='{$value}'> {$label} </label>";
            }
            , 'separator' => ' ', 'required' => true])->label(true)
        ?>
        <?php

        $data = \backend\models\AwpbActivity::find()->orderBy(['name' => SORT_ASC])
        ->where(['parent_activity_id'=>null])
        ->all();
        $list = ArrayHelper::map($data, 'id','name');


               $model->icons=$list;

               echo $form->field($model, 'activities')->multiselect($model->icons);
        ?>
    </div>
</div>
<div class="form-group col-lg-12">
    <?= Html::submitButton('Update', ['class' => 'btn btn-success btn-sm']) ?>
</div>
