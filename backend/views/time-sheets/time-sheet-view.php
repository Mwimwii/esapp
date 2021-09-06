<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use backend\models\TimeSheetsDistrictStaff;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TimeSheetsDistrictStaff */
if ($model->status == TimeSheetsDistrictStaff::_status_pending_approval) {
    $this->title = "Approve Time sheet #:" . $model->id;
} else {
    $this->title = "View Time sheet #:" . $model->id;
}
$this->params['breadcrumbs'][] = ['label' => 'Time Sheets', 'url' => ['time-sheets']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <?php
        if ($model->status == TimeSheetsDistrictStaff::_status_pending_approval &&
                backend\models\User::userIsAllowedTo("Review timesheets")) {
            ?>
            <h5>Instructions</h5>
            <ol>
                <li>
                    Review this Time sheet and take action to either accept it or send it back for more information using the form on the right below
                </li>
                <li>Fields marked with <i style="color:red;">*</i> are required
                </li>
            </ol>
        <?php } ?>
        <div class="row">
            <?php
            if ($model->status == TimeSheetsDistrictStaff::_status_pending_approval &&
                    backend\models\User::userIsAllowedTo("Review timesheets")) {
                ?>
                <div class="col-lg-8">
                    <?php
                } else {
                    echo '<div class="col-lg-12">';
                }
                ?>
                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'province',
                            'filterType' => GridView::FILTER_SELECT2,
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filter' => true,
                            'filter' => \backend\models\Provinces::getProvinceList(),
                            'filterInputOptions' => ['prompt' => 'Filter by Province', 'class' => 'form-control', 'id' => null],
                            'value' => function ($model) {
                                //$province_id = backend\models\Districts::findOne($model->district_id)->province_id;
                                $name = !empty($model->province) ? backend\models\Provinces::findOne($model->province)->name : "";
                                return $name;
                            },
                        ],
                        [
                            'attribute' => 'district',
                            'filterType' => GridView::FILTER_SELECT2,
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filter' => \backend\models\Districts::getList(),
                            'filterInputOptions' => ['prompt' => 'Filter by District', 'class' => 'form-control', 'id' => null],
                            'value' => function ($model) {
                                $name = !empty($model->district) ? backend\models\Districts::findOne($model->district)->name : "";
                                return $name;
                            },
                        ],
                        [
                            'label' => 'Submitted by',
                            'value' => function($model) {
                                $user = \backend\models\User::findOne(['id' => $model->created_by]);
                                return !empty($user) ? $user->first_name . " " . $user->other_name . " " . $user->last_name : "";
                            }
                        ],
                        [
                            'attribute' => 'month',
                            'filter' => false,
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'year',
                            'filter' => false,
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'designation',
                            'filter' => false,
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'activity_description',
                            'filter' => false,
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'hours_field_esapp_activities',
                            'filter' => false,
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'hours_office_esapp_activities',
                            'filter' => false,
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'total_hours_worked',
                            'filter' => false,
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'rate_id',
                            'filter' => false,
                            'format' => 'raw',
                            'value' => function($model) {
                                return !empty($model->rate_id) ? \backend\models\HourlyRates::findOne($model->rate_id)->rate : 0;
                            }
                        ],
                        [
                            'attribute' => 'contribution',
                            'filter' => false,
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => function($model) {
                                $str = "";
                                if ($model->status == TimeSheetsDistrictStaff::_accepted) {
                                    $str = "<p class='badge badge-success'> "
                                            . "<i class='fa fa-check'></i> Approved</p><br>";
                                } elseif ($model->status == TimeSheetsDistrictStaff::_status_pending_approval) {
                                    $str = "<p class='badge badge-warning'> "
                                            . "<i class='fa fa-hourglass-half'></i> Pending approval</p><br>";
                                } else {
                                    $str = "<p class='badge badge-danger'> "
                                            . "<i class='fa fa-times'></i> Resent back. Requires changes</p><br>";
                                }
                                return $str;
                            },
                        ],
                        'reviewer_comments:ntext',
                        [
                            'label' => 'Approved by',
                            'value' => function($model) {
                                $user = \backend\models\User::findOne(['id' => $model->approved_by]);
                                if ($model->approved_by == Yii::$app->user->id) {
                                    return "You";
                                } else {
                                    return !empty($user) ? $user->first_name . " " . $user->other_name . " " . $user->last_name . "-" . $user->email : "";
                                }
                            }
                        ],
                        [
                            'label' => 'Date approved',
                            'value' => function($model) {
                                return $model->approved_at;
                            }
                        ],
                        [
                            'label' => 'Date submitted',
                            'value' => function($model) {
                                return date('d-F-Y H:i:s', $model->created_at);
                            }
                        ],
                    ],
                ])
                ?>
            </div>
            <?php
            if ($model->status == TimeSheetsDistrictStaff::_status_pending_approval &&
                    backend\models\User::userIsAllowedTo("Review timesheets")) {
                ?>
                <div class="col-lg-4">
                    <p>Take action by filling in the form below</p>
                    <?php
                    $model1 = new \backend\models\TimeSheetsDistrictStaff();
                    $form = ActiveForm::begin(['action' => 'approve-time-sheet-action?id=' . $model->id,])
                    ?>
                    <?=
                            $form->field($model1, 'status')
                            ->dropDownList(
                                    [TimeSheetsDistrictStaff::_accepted => "Accept Time sheet", TimeSheetsDistrictStaff::_resent_back => "Send back for more information"], ['custom' => true, 'prompt' => 'Select Action', 'required' => true]
                    );
                    ?>
                    <?=
                    $form->field($model1, 'reviewer_comments')->textarea(['rows' => 4, 'placeholder' =>
                        'Enter any comments for your action'])->label("Comments ");
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('Submit action', ['class' => 'btn btn-success btn-sm']) ?>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
