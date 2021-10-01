<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use frontend\models\MgfBpiCategories;
use frontend\models\MgfBpiCategoriesIndicators;


/* @var $this yii\web\View */
/* @var $model frontend\models\MgfBusinessPerfomanceIndicator */
/* @var $form yii\widgets\ActiveForm */

$bpicategories = ArrayHelper::map(MgfBpiCategories::find()->all(), 'id', 'category_description');
$bpicategoriesindicators = ArrayHelper::map(MgfBpiCategoriesIndicators::find()->groupBy('category_id')->all(), 'id', 'indicator_description');
// $inputs = ArrayHelper::map(MgfInputItem::find()->all(), 'id', 'input_name');
?>

<div class="mgf-business-perfomance-indicator-form">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'category_id')
                        ->dropDownList($bpicategories, 
                        ['id' => 'category_id', 'custom' => true, 'prompt' => 'Please select a Category', 'required' => true]
                );?>
<?= Html::hiddenInput('selected_id', $model->isNewRecord ? '' : $model->category_id, ['id' => 'selected_id']);?>

<?=$form->field($model, 'indicator_id')->widget(DepDrop::classname(), [
                    'options' => ['id' => 'indicator_id', 'custom' => true, 'required' => TRUE],
                    'pluginOptions' => [
                        'depends' => ['category_id'],
                        'initialize' => $model->isNewRecord ? false : true,
                        'placeholder' => 'Please select a Indicator',
                        'url' => Url::to(['/mgf-business-perfomance-indicator/indicator']),
                        'params' => ['selected_id'],
                    ]
                ]);
?>
    <?= $form->field($model, 'status_at_application')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_after_1yr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_after_2yr')->textInput(['maxlength' => true]) ?>

      
    


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
