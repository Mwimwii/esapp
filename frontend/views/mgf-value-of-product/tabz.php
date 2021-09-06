<?php
 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
 
/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>
 
<div class="customer-form">
 
    <?php $form = ActiveForm::begin(); ?>
 
    <?php
    //--------------------
    // TAB: Contact Information
    //--------------------
    $tabContact = '<div class="col-md-4"><br />';
    $tabContact .= $form->field($model, 'account_number')->textInput(['maxlength' => true]);
 
    $tabContact .= $form->field($model, 'contact')->textInput(['maxlength' => true]);
    $tabContact .= $form->field($model, 'company_name')->textInput(['maxlength' => true]);
    $tabContact .= '</div>';
 
    $tabContact .= '<div class="col-md-4"><br />';
    $tabContact .= $form->field($model, 'address1')->textInput(['maxlength' => true]);
    $tabContact .= $form->field($model, 'address2')->textInput(['maxlength' => true]);
    $tabContact .= $form->field($model, 'city')->textInput(['maxlength' => true]);
    $tabContact .= $form->field($model, 'state_prov')->dropDownList(
                    $model->states,
                    [ 'prompt' => '--Select One--' ]
        );
    $tabContact .= $form->field($model, 'postal_code')->textInput(['maxlength' => true]);
    $tabContact .= $form->field($model, 'country')->dropDownList(
            $model->countries,
            [ 'prompt' => '--Select One--' ]
        );
    $tabContact .= '</div>';
 
    $tabContact .= '<div class="col-md-4"><br />';
    $tabContact .= $form->field($model, 'phone')->textInput(['maxlength' => true]);
    $tabContact .= $form->field($model, 'phone_ext')->textInput(['maxlength' => true]);
    $tabContact .= $form->field($model, 'fax')->textInput(['maxlength' => true]);
    $tabContact .= $form->field($model, 'email')->textInput(['maxlength' => true]);
    $tabContact .= $form->field($model, 'website')->textInput(['maxlength' => true]);
    $tabContact .= $form->field($model, 'ship_address_id')->textInput(['maxlength' => true]);
 
    $tabContact .= $form->field($model, 'status')->dropDownList([
                    '1' => 'Active',
                    '0' => 'Inactive',
                ]);
 
    $tabContact .= '</div>';
 
    //--------------------
    // TAB: Notes
    //--------------------
    $tabNotes = '<div class="col-md-12"><br />';
    $tabNotes .= $form->field($model, 'notes')->textarea(['rows' => 6]);
 
 
 
    $tabNotes .= '</div>';
    ?>
 
    <!-- // Conditional hidden field selection if this is a new record -->
    <?= ($model->isNewRecord ? 
            Html::activeHiddenInput($model, 'created_at',  ['value' => Yii::$app->formatter->asDate('now', 'php:Y-m-d')]) :
            Html::activeHiddenInput($model, 'updated_at', ['value' => Yii::$app->formatter->asDate('now', 'php:Y-m-d')])
        ) ?>
 
    <?= Tabs::widget([
        'items' => [
            [
                'label'   => 'Contact',
                'content' => $tabContact,
                'active'  => true
            ],
            [
                'label'   => 'Notes',
                'content' => $tabNotes,
            ],
        ],
    ]); ?>   
 
    <?= Html::errorSummary($model, ['class' => 'errors']) ?>
 
    <div class="col-md-12">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
 
 
    <?php ActiveForm::end(); ?>
 
</div>