<?php

use yii\helpers\Html;
//use borales\extensions\phoneInput\PhoneInput;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
//use kartik\money\MaskMoney;
//use yii\widgets\MaskedInput;

$form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
//$form = ActiveForm::begin();
?>
<div class="card">

    <div class="card-body">
        <?php
        echo $form->field($model, 'awpb_template_id')->hiddenInput(['value' => $template_id])->label(false);
        echo $form->field($model, 'component_id')->dropDownList((\backend\models\AwpbComponent::getAwpbSubComponentsListDistrict()),
                [
                    'prompt' => 'Select component', 'id' => 'comp_id']);

        echo Html::hiddenInput('selected_id', $model->isNewRecord ? '' : $model->activity_id, ['id' => 'selected_id']);

        echo $form->field($model, 'activity_id')->widget(DepDrop::classname(), [
            'options' => ['id' => 'activity_id1', 'custom' => true, 'required' => TRUE],
            'pluginOptions' => [
                'depends' => ['comp_id'],
                'initialize' => $model->isNewRecord ? false : true,
                'placeholder' => 'Select a parent activity',
                'url' => Url::to(['/awpb-activity/templateactivities']),
                'params' => ['selected_id'],
            ]
        ]);

        echo
                $form->field($model, 'camp_id', ['enableAjaxValidation' => true,])->label('Camp')
                ->dropDownList(
                        \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id), ['prompt' => 'Please select a camp', 'required' => true]
        );
        ?>
        <hr class="dotted">  
        <div class="form-group row mb-0">


        <?= Html::activeLabel($model, 'number_of_females', ['label' => 'No. of Beneficiary By Gender', 'class' => 'col-sm-2 col-form-label'])
        ?>
            <div class="col-sm-5">
        <?=
        $form->field($model, 'number_of_females', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])->label("Females");
        //$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
        ?>
            </div>
            <div class="col-sm-5">
            <?=
            $form->field($model, 'number_of_males', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])->label("Males");
            //$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
            ?>

            </div>



        </div>



        <div class="form-group row mb-0">

<?= Html::activeLabel($model, 'number_of_females', ['label' => 'No. of Beneficiary By Age Group', 'class' => 'col-sm-2 col-form-label'])
?>
            <div class="col-sm-5">
<?=
$form->field($model, 'number_of_young_people', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])->label("Young");
//$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
?>
            </div>
            <div class="col-sm-5">
            <?=
            $form->field($model, 'number_of_not_young_people', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])->label("Not Young");
            //$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
            ?>

            </div>



        </div>
        <div class="form-group row mb-0">


<?= Html::activeLabel($model, 'number_of_women_headed_households', ['label' => 'No. of Beneficiary By Household', 'class' => 'col-sm-2 col-form-label'])
?>
            <div class="col-sm-5">
<?=
$form->field($model, 'number_of_women_headed_households', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])->label("Women headed");
//$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
?>
            </div>
            <div class="col-sm-5">
            <?=
            $form->field($model, 'number_of_non_women_headed_households', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])->label("Non-women headed");
            //$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
            ?>

            </div>




        </div>


        <hr class="dotted">
        <div class="form-group row mb-0">


<?= Html::activeLabel($model, 'mo_1', ['label' => 'Quarter One', 'class' => 'col-sm-2 col-form-label'])
?>
            <div class="col-sm-3">
<?=
$form->field($model, 'mo_1', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter 4 quantity']);
//$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
?>




            </div>
            <div class="col-sm-3">
                <?=
                        $form->field($model, 'mo_2', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                        ->label("Feb");
                // $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'To Date'])->hint('Enter end date'); 
                ?>
            </div>


            <div class="col-sm-3">
                <?=
                        $form->field($model, 'mo_3', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                        ->label("Mar");

                //$form->field($model, 'begin_date',['showLabels'=>false])->textInput(['placeholder'=>'Begin Date']); 
                ?>
            </div>

        </div>


        <div class="form-group row mb-0">
<?= Html::activeLabel($model, 'mo_4', ['label' => 'Quarter Two', 'class' => 'col-sm-2 col-form-label'])
?>
            <div class="col-sm-3">
<?=
        $form->field($model, 'mo_4', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
        ->label("Apr");

//$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
?>
            </div>
            <div class="col-sm-3">
                <?=
                        $form->field($model, 'mo_5', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                        ->label("May");
                // $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'To Date'])->hint('Enter end date'); 
                ?>
            </div>
            <div class="col-sm-3">
                <?=
                        $form->field($model, 'mo_6', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                        ->label("Jun");
                // $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'To Date'])->hint('Enter end date'); 
                ?>
            </div>

        </div>


        <div class="form-group row mb-0">
                <?= Html::activeLabel($model, 'mo_7', ['label' => 'Quarter Three', 'class' => 'col-sm-2 col-form-label'])
                ?>
            <div class="col-sm-3">
<?=
        $form->field($model, 'mo_7', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
        ->label("Jul");

//$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
?>
            </div>
            <div class="col-sm-3">
                <?=
                        $form->field($model, 'mo_8', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                        ->label("Aug");
                // $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'To Date'])->hint('Enter end date'); 
                ?>
            </div>
            <div class="col-sm-3">
                <?=
                        $form->field($model, 'mo_9', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                        ->label("Sep");
                // $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'To Date'])->hint('Enter end date'); 
                ?>
            </div>

        </div>

        <div class="form-group row mb-0">
                <?= Html::activeLabel($model, 'mo_10', ['label' => 'Quarter Four', 'class' => 'col-sm-2 col-form-label'])
                ?>
            <div class="col-sm-3">
<?=
        $form->field($model, 'mo_10', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
        ->label("Oct");

//$form->field($model, 'from_date',['showLabels'=>false])->textInput(['placeholder'=>'From Date'])->hint('Enter begin date'); 
?>
            </div>
            <div class="col-sm-3">
                <?=
                        $form->field($model, 'mo_11', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
                        ->label("Nov");
                // $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'To Date'])->hint('Enter end date'); 
                ?>
            </div>
            <div class="col-sm-3">
<?=
        $form->field($model, 'mo_12', ['enableAjaxValidation' => false])->textInput(['maxlength' => true, 'placeholder' => 'Enter quantity'])
        ->label("Dec");
// $form->field($model, 'to_date',['showLabels'=>false])->textInput(['placeholder'=>'Enter quantity'])->hint('Enter quantity'); 
?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <?= Html::submitButton('Save', ['class' => ' btn btn-success']) ?>
                </div>
            </div>  </div>
    </div>
<?php ActiveForm::end(); ?>