<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\touchspin\TouchSpin;

$form = ActiveForm::begin([
        ]);
?>
<div class="row">
    <div class="col-lg-6">
        <?php
        echo
                $form->field($model, 'activity_id')
                ->dropDownList(
                        \backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities::getActivityListByDistrictId(Yii::$app->user->identity->district_id), ['id' => 'prov_id', 'custom' => true, 'prompt' => 'Please select activity', 'required' => true]
        );
        ?>
        <?php
        echo
                $form->field($model, 'faabs_id')
                ->dropDownList(
                        \backend\models\MeFaabsGroups::getListByCampIds(), ['custom' => true, 'prompt' => 'Please select FaaBS', 'required' => true]
        );
        echo $form->field($model, 'activity_target')->widget(TouchSpin::classname(), [
            'options' => ['placeholder' => 'Activity target'],
            'pluginOptions' => [
                // 'initval' => 3.00,
                'min' => 0,
            // 'max' => 100,
            ],
        ]);

        echo $form->field($model, 'beneficiary_target_women')->widget(TouchSpin::classname(), [
            'options' => ['placeholder' => 'Beneficiary target women'],
            'pluginOptions' => [
                // 'initval' => 3.00,
                'min' => 0,
            //  'max' => 100,
            // 'step' => 0.1,
            // 'decimals' => 2,
            // 'boostat' => 5,
            // 'maxboostedstep' => 10,
            // 'prefix' => '$',
            ],
        ]);
        /* echo $form->field($model, 'beneficiary_target_women', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
          'maskedInputOptions' => [
          // 'prefix' => '$ ',
          'suffix' => '',
          'allowMinus' => false,
          'min' => 0,
          'max' => 10
          ],
          ]); */
        echo $form->field($model, 'beneficiary_target_youth')->widget(TouchSpin::classname(), [
            'options' => ['placeholder' => 'Beneficiary target youth'],
            'pluginOptions' => [
                // 'initval' => 3.00,
                'min' => 0,
            // 'max' => 100,
            ],
        ]);

        echo $form->field($model, 'beneficiary_target_women_headed')->widget(TouchSpin::classname(), [
            'options' => ['placeholder' => 'Beneficiary target women headed'],
            'pluginOptions' => [
                // 'initval' => 3.00,
                'min' => 0,
            //'max' => 100,
            ],
        ]);
        ?>

    </div>
    <div class="col-lg-6">
        <h5>Instructions</h5>
        <ol>
            <li>Fields marked with <i style="color: red;">*</i> are required</span>
            </li>
        </ol>
    </div>

    <div class="col-md-12">
        <hr class="dotted"/>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-xs']) ?>

    </div>
</div>
<?php ActiveForm::end(); ?>
