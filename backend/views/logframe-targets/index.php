<?php

use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use backend\models\User;
use kartik\popover\PopoverX;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LogframeProgrammeTargetsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logframe programme targets';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h4>Instructions</h4>
        <ol>
            <li>These are programme wide Logframework targets<code>(Baseline,Mid term and End Targets)</code></li>
            <li>The records were pre-populated at system development. The system depends on these records to populate the logframework</li>
            <li>The system uses these records hence you are only allowed to modify fields: <code>(Baseline,Mid term and End Target)</code></li>
            <li>The fields: <code>(record_type,indicator and description)</code> are strictly used by the system</li>
        </ol>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'baseline',
                    //'readonly' => false,
                    'refreshGrid' => true,
                    'filter' => false,
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => PopoverX::SIZE_MEDIUM,
                        'options' => ['class' => 'form-control', 'custom' => true,],
                        'inputType' => Editable::INPUT_WIDGET,
                        'widgetClass' => '\kartik\number\NumberControl',
                        'options' => [
                            'maskedInputOptions' => [
                                //  'suffix' => ' User(s)',
                                'allowMinus' => false,
                                'min' => 0,
                                'max' => 10000000,
                                'digits' => 0
                            ],
                        ]
                    ],
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'mid_term',
                    //'readonly' => false,
                    'refreshGrid' => true,
                    'filter' => false,
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => PopoverX::SIZE_MEDIUM,
                        'options' => ['class' => 'form-control', 'custom' => true,],
                        'inputType' => Editable::INPUT_WIDGET,
                        'widgetClass' => '\kartik\number\NumberControl',
                        'options' => [
                            'maskedInputOptions' => [
                                //  'suffix' => ' User(s)',
                                'allowMinus' => false,
                                'min' => 0,
                                'max' => 10000000,
                                'digits' => 0
                            ],
                        ]
                    ],
                ],
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'end_target',
                    //'readonly' => false,
                    'refreshGrid' => true,
                    'filter' => false,
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => PopoverX::SIZE_MEDIUM,
                        'options' => ['class' => 'form-control', 'custom' => true,],
                        'inputType' => Editable::INPUT_WIDGET,
                        'widgetClass' => '\kartik\number\NumberControl',
                        'options' => [
                            'maskedInputOptions' => [
                                //  'suffix' => ' User(s)',
                                'allowMinus' => false,
                                'min' => 0,
                                'max' => 10000000,
                                'digits' => 0
                            ],
                        ]
                    ],
                ],
                [
                    'attribute' => 'record_type',
                    'filter' => false,
                ],
                [
                    'attribute' => 'indicator',
                    'filter' => false,
                ],
                [
                    'attribute' => 'description',
                    'filter' => false,
                ],
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            ],
        ]);
        ?>
    </div>
</div>
<?php
$this->registerCss('.popover-x {display:none}');
?>
