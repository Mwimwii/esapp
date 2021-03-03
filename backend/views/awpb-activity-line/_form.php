<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbActivityLine */
/* @var $form yii\widgets\ActiveForm */


$js = 'jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {

    jQuery(".dynamicform_wrapper .card-title-address").each(function(index) {

        jQuery(this).html("AWPB activity line: " + (index + 1))

    });
});
jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {

    jQuery(".dynamicform_wrapper .card-title-address").each(function(index) {

        jQuery(this).html("AWPB activity line: " + (index + 1))

    });

});';

$this->registerJs($js);

$months = [
    1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun",
    7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec"
];
?>






<?php
$form = ActiveForm::begin(['id' => 'dynamic-form']);
DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items', // required: css class selector
    'widgetItem' => '.item', // required: css class
    'limit' => 4, // the maximum times, an element can be cloned (default 999)
    'min' => 0, // 0 or 1 (default 1)
    'insertButton' => '.add-item', // css class
    'deleteButton' => '.remove-item', // css class
    'model' => $modelForm[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'activity_id',
        'name',
        'unit_of_measure_id',
        'unit_cost',
        'quarter_one_quantity',
        'quarter_two_quantity',
        'quarter_three_quantity',
        'quarter_four_quantity',
        


    ],
]);
?>

<div class="card-tools pull-right">
    <button type="button" class="add-item btn btn-success btn-xs">
        <i class="fa fa-plus"></i> Add line row</button>
</div>
<hr class="dotted short">
<div class="container-items"><!-- widgetContainer -->
    <?php foreach ($modelForm as $index => $modelactivityline): ?>
        <div class="item card card-success card-outline"><!-- widgetBody -->
            <div class="card-header">
                <span class="card-title-address">AWPB activity line: <?= ($index + 1) ?></span>
                <div class="card-tools">
                    <button type="button" class="pull-right remove-item btn btn-tool btn-xs">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body">
                <?php
                if (!$modelactivityline->isNewRecord) {
                    echo Html::activeHiddenInput($modelactivity, "[{$index}]id");
                }
                ?>
                <div class="row">
                    <div class="col-lg-2">
                        <?=
                       
                                $form->field($modelactivityline, "[{$index}]activity_id",['enableAjaxValidation' => true])
                                ->dropDownList(
                                        \backend\models\AWPBActivity::getAwpbActivitiesList(1),['custom' => true, 'prompt' => 'Select activity', 'required' => true]
                                  ) ;
                        ?>

                    </div>
                   

                    <div class="col-lg-2">
                        <?=
                                $form->field($modelactivityline, "[{$index}]name",['enableAjaxValidation' => true])->textInput(['maxlength' => true])
                                ->label("Name");
                        ?>
                    </div>
                  

                    <div class="col-lg-2">
                        <?=
                       
                                $form->field($modelactivityline, "[{$index}]unit_of_measure_id",['enableAjaxValidation' => true])
                                ->dropDownList(
                                        \backend\models\AwpbUnitOfMeasure::getAwpbUnitOfMeasuresList(),['custom' => true, 'prompt' => 'Select unit of measure', 'required' => true]
                                  ) ;
                        ?>

                    </div>


                    <div class="col-lg-2">
                    <?=
                    $form->field($modelactivityline, "[{$index}]unit_cost",['enableAjaxValidation' => true])->widget(MaskMoney::classname(), [
                        'pluginOptions' => [
                            'allowZero' => false,
                            'allowNegative' => false,
                        ]
                    ])->label("Unit Cost");
                    ?>
                </div>
                <div class="col-lg-1">
                <?=
                        $form->field($modelactivityline, "[{$index}]quarter_one_quantity",['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
                        ->label("Q1-Qty")
                ?>
            </div>
            <div class="col-lg-1">
                <?=
                        $form->field($modelactivityline, "[{$index}]quarter_two_quantity",['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
                        ->label("Q2-Qty")
                ?>
            </div>
            <div class="col-lg-1">
            <?=
                    $form->field($modelactivityline, "[{$index}]quarter_three_quantity",['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
                    ->label("Q3-Qty")
            ?>
        </div>
            <div class="col-lg-1">
            <?=
                    $form->field($modelactivityline, "[{$index}]quarter_four_quantity",['enableAjaxValidation' => true])->textInput(['value'=>'0','maxlength' => true])
                    ->label("Q4-Qty")
            ?>
        </div>
        
                </div>


            </div>
        </div>

    <?php endforeach; ?>
</div>

<?php DynamicFormWidget::end(); ?>
<div class="form-group col-lg-12">
<?= Html::submitButton('Save prices', ['class' => 'btn btn-success btn-sm']) ?>
</div>
<?php ActiveForm::end(); ?>

