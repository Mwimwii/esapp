<?php

use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use backend\models\User;
use \kartik\popover\PopoverX;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MeCampSubprojectRecordsPlannedWorkEffortSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Camp monthly schedules';
$this->params['breadcrumbs'][] = $this->title;
$readonly = true;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <li>You can add the camp monthly schedule by clicking the button <span class="badge badge-success">Add Camp <?=date('F')?> schedule</span>
            </li>
            <li>After adding a monthly camp work effort record, the system will allow you to add planned activities and submit actual achieved details for the month
            </li>
            <li>You will only be able to plan activities for the current month. The other months you can only view
            </li>
        </ol>
        <?php echo $this->render('_search', ['model' => $model]); ?>
        <hr class="dotted">
        <p>
            <?php
            if (User::userIsAllowedTo('Plan camp monthly activities')) {
                $readonly = false;
                echo Html::a('<i class="fa fa-plus"></i> Add Camp '.date('F').' schedule', ['create'], ['class' => 'btn btn-success btn-sm']);
            }
            ?>
        </p>
        <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'condensed' => true,
            'responsive' => true,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                // 'id',
                'camp_id',
                'year',
                'month',
                'days_in_month',
                'days_field',
                'days_office',
                'days_total',
                'days_other_non_esapp_activities',
                //'created_at',
                //'updated_at',
                //'created_by',
                //'updated_by',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>


    </div>
</div>
<div class="modal fade" id="addNewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-success card-outline">
            <div class="modal-header">
                <h5 class="modal-title">Add camp work effort for the month: <?php echo date("F"); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5">
                        <?php
                        $form = ActiveForm::begin([
                                    'action' => 'create',
                                ])
                        ?>

                        <?php
                        echo
                                $form->field($model, 'camp_id')
                                ->dropDownList(
                                        \backend\models\Camps::getListByDistrictId(Yii::$app->user->identity->district_id), ['prompt' => 'Please select a camp', 'required' => true]
                        );
                        ?>
                        <?php
                        echo $form->field($model, 'days_office')->widget(NumberControl::classname(), [
                            'maskedInputOptions' => [
                                // 'prefix' => '$ ',
                                'suffix' => ' days',
                                'allowMinus' => false,
                                'min' => 1,
                                'max' => 31
                            ],
                        ]);
                        ?>
                        <?php
                        echo $form->field($model, 'days_field')->widget(NumberControl::classname(), [
                            'maskedInputOptions' => [
                                // 'prefix' => '$ ',
                                'suffix' => ' days',
                                'allowMinus' => false,
                                'digits' => 0,
                                'min' => 1,
                                'max' => 31
                            ],
                        ]);
                        ?>
                        <?php
                        echo $form->field($model, 'days_other_non_esapp_activities')->widget(NumberControl::classname(), [
                            'maskedInputOptions' => [
                                // 'prefix' => '$ ',
                                'suffix' => ' days',
                                'allowMinus' => false,
                                'digits' => 0,
                                'min' => 1,
                                'max' => 31
                            ],
                        ]);
                        ?>

                    </div>
                    <div class="col-lg-7">
                        <h5>Instructions</h5>
                        <ol>
                            <li>Fields marked with <i style="color: red;">*</i> are required</span>
                            </li>
                            <li>If you do not see a camp in the dropdown it means you have already added a record for this month</span>
                            </li>
                            <li>The Total days for <?php echo date("F"); ?> is <?php echo date("t"); ?>
                            </li>
                            <li>The sum of (Days office + Days field + Days non-esapp activities) cannot exceed the total days in a month 
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <?= Html::submitButton('Save FaaBS group', ['class' => 'btn btn-success btn-xs']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php
$this->registerCss('.popover-x {display:none}');
?>
