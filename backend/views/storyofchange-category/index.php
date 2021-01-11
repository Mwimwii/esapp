<?php

use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use backend\models\User;
use \kartik\popover\PopoverX;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LkmStoryofchangeCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lkm Storyofchange Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <p>
            <?php
            if (User::userIsAllowedTo('Manage story of change categories')) {
                echo '<button class="btn btn-success btn-sm" href="#" onclick="$(\'#addNewModal\').modal(); 
                    return false;"><i class="fa fa-plus"></i> Add story of change category</button>';
                echo '<hr class="dotted short">';
            }
            ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                // 'id',
                [
                    'class' => EditableColumn::className(),
                    'enableSorting' => true,
                    'attribute' => 'name',
                    'editableOptions' => [
                        'asPopover' => true,
                        'type' => 'success',
                        'size' => kartik\popover\PopoverX::SIZE_MEDIUM,
                    ],
                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => \backend\models\LkmStoryofchangeCategory::getNames(),
                    'filterInputOptions' => ['prompt' => 'Filter by name', 'class' => 'form-control',],
                    'format' => 'raw',
                    'refreshGrid' => true,
                ],
                [
                    'class' => EditableColumn::className(),
                    'enableSorting' => true,
                    'attribute' => 'description',
                    'width' => '600px',
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
                [
                    'attribute' => 'created_at',
                    'filter' => false,
                    'label' => 'Date added',
                    'value' => function ($model) {
                        return date('d-M-Y', $model->created_at);
                    }
                ],
                //   'created_at',
                // 'updated_at',
                //'created_by',
                //'updated_by',
                ['class' => ActionColumn::className(),
                    'options' => ['style' => 'width:130px;'],
                    'template' => '{delete}',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            if (User::userIsAllowedTo('Manage story of change categories')) {
                                return Html::a(
                                                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                            'title' => 'Remove Interview question',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to remove this story of change category?<br>'
                                                . 'Category will only be removed if its not being used by the system!',
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new story of change category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $form = ActiveForm::begin(['action' => 'create',])
                ?>
                <?=
                $form->field($model, 'name', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' =>
                    'Name of category', 'id' => "type", 'required' => true,])
                ?>
                <?=
                $form->field($model, 'description')->textarea(['rows' => 5, 'placeholder' =>
                    'Enter description'])->label("Description ");
                ?>
            </div>
            <div class="modal-footer justify-content-between">
                <?= Html::submitButton('Save category', ['class' => 'btn btn-success btn-sm']) ?>
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
