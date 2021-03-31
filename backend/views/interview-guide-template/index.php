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
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LkmStoryofchangeInterviewGuideTemplateQuestionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Story of change interview guide template';
$this->params['breadcrumbs'][] = $this->title;
$question_numbers = backend\models\LkmStoryofchangeInterviewGuideTemplateQuestions::getQuestionNumbers();
$ready_only = true;
$section_list = [
    "Introduction" => "Introduction",
    "The Problem" => "The Problem",
    "The Action" => "The Action",
    "Recommendations" => "Recommendations",
];
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <?php
            if (User::userIsAllowedTo('Manage interview guide template questions')) {
                echo '<li>You can update the interview guide questions by clicking in a particular field of each table row below</li>';
                echo '<li>Click <span class="badge badge-success">Add Interview guide question</span> below to add a new question to the interview guide template.</li>';
            }
            ?>
            <li>Click <span class="badge badge-primary"><span class="fa fa-download">
                    </span> Download template</span> to download the interview question guide template.
            </li>
            <li>Questions will appear on the Interview guide template based on the section and the question number in ascending order</li>
        </ol>
        <hr class="dotted short">
        <div class="card-header">
            <div class="card-title">
                <?php
                if (User::userIsAllowedTo('Manage interview guide template questions')) {
                    $ready_only = false;
                    echo '<button class="btn btn-success btn-xs" href="#" onclick="$(\'#addNewModal\').modal(); 
                    return false;"><i class="fa fa-plus"></i> Add Interview guide question</button>';
                    //  echo '<hr class="dotted short">';
                }
                ?>
            </div>
            <div class="card-tools">
                <?php
                if (!empty($dataProvider) && $dataProvider->getCount() > 0) {
                    echo Html::a(
                            '<span class="fa fa-download fa-2x"></span> Download template', ['download-template',], [
                        'title' => 'Download interview guide template',
                        'target' => '_blank',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'data-pjax' => '0',
                        'style' => "padding:5px;",
                            ]
                    );
                }
                ?>
            </div>
        </div>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'], [
                    'class' => EditableColumn::className(),
                    'enableSorting' => true,
                    'readonly' => $ready_only,
                    'attribute' => 'section',
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => PopoverX::SIZE_MEDIUM,
                        'options' => ['class' => 'form-control', 'prompt' => 'Select a section', 'custom' => true,],
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'data' => $section_list,
                    ],
                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => $section_list,
                    'filterInputOptions' => ['prompt' => 'Filter by section', 'class' => 'form-control',],
                    'format' => 'raw',
                    'refreshGrid' => true,
                ],
                [
                    'class' => EditableColumn::className(),
                    'enableSorting' => true,
                    'readonly' => $ready_only,
                    'attribute' => 'number',
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => kartik\popover\PopoverX::SIZE_MEDIUM,
                    ],
                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => \backend\models\LkmStoryofchangeInterviewGuideTemplateQuestions::getQuestionNumber(),
                    'filterInputOptions' => ['prompt' => 'Filter by question number', 'class' => 'form-control',],
                    'format' => 'raw',
                    'refreshGrid' => true,
                ],
                [
                    'class' => EditableColumn::className(),
                    'enableSorting' => true,
                    'attribute' => 'question',
                    'width' => '600px',
                    'readonly' => $ready_only,
                    'contentOptions' => [
                        // 'style' => 'padding:0px 0px 0px 30px;',
                        'class' => 'text-left',
                    ],
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'inputType' => Editable::INPUT_TEXTAREA,
                        'submitOnEnter' => false,
                        'placement' => \kartik\popover\PopoverX::ALIGN_TOP,
                        'size' => PopoverX::SIZE_LARGE,
                        'options' => [
                            'class' => 'form-control',
                            'rows' => 6,
                            'placeholder' => 'Enter Question...',
                            'style' => 'width:460px;',
                        ]
                    ],
                    'filter' => false,
                    'format' => 'raw',
                    'refreshGrid' => true,
                ],
                /* [
                  'attribute' => 'created_at',
                  'filter' => false,
                  'label' => 'Date added',
                  'value' => function ($model) {
                  return date('d-M-Y', $model->created_at);
                  }
                  ], */
                // 'created_at',
                //'updated_at',
                //'created_by',
                //'updated_by',
                ['class' => ActionColumn::className(),
                    'options' => ['style' => 'width:130px;'],
                    'template' => '{delete}',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            if (User::userIsAllowedTo('Remove interview guide template question')) {
                                return Html::a(
                                                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                            'title' => 'Remove Interview question',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to remove this interview question?<br>'
                                                . 'Question will only be removed if its not being used by the system!',
                                                'method' => 'post',
                                            ],
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                    ]
                ],
            ],
        ]);
        ?>


    </div>
</div>
<div class="modal fade" id="addNewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-success card-outline">
            <div class="modal-header">
                <h5 class="modal-title">Add new Interview guide question</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ol>
                    <li>Fields marked with <i style="color: red;">*</i> are required.</li>
                </ol>
                <hr class="dotted">
                <div class="row">
                    <div class="col-lg-7">

                        <?php
                        $form = ActiveForm::begin([
                                    'action' => 'create',
                                ])
                        ?>
                        <?=
                                $form->field($model, 'section')
                                ->dropDownList(
                                        $section_list, ['custom' => true, 'prompt' => 'Select a section', 'required' => true]
                        );
                        ?>

                        <?php
                        echo $form->field($model, 'number', ['enableAjaxValidation' => true])->widget(NumberControl::classname(), [
                            'displayOptions' => [
                                'placeholder' => 'Question number'
                            ],
                            'maskedInputOptions' => [
                                'prefix' => 'Question no. ',
                                'allowMinus' => false,
                                'min' => 1,
                            ],
                        ])->label("Question no");
                        ?>
                        <?=
                        $form->field($model, 'question')->textarea(['rows' => 5, 'placeholder' =>
                            'Enter Question'])->label("Question ");
                        ?>
                    </div>
                    <div class="col-lg-5">
                        <?php
                        if (!empty($question_numbers)) {
                            ?>
                            <p>Existing Question numbers</p>
                            <hr class="dotted">
                            <?php
                            foreach ($question_numbers as $model) {
                                ?>
                                <p><?= $model->section ?>: Question no <?= $model->number ?></p>
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <?= Html::submitButton('Save question', ['class' => 'btn btn-success btn-sm']) ?>
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
