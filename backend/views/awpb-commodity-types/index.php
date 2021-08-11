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
/* @var $searchModel app\models\CommodityTypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB Commodity Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <p>
            <?php
                 if (user::userIsAllowedTo("Setup AWPB") ){
                echo '<button class="btn btn-success btn-sm" href="#" onclick="$(\'#addNewModal\').modal(); 
                    return false;"><i class="fa fa-plus"></i> Add commodity type</button>';
                echo '<hr class="dotted short">';
            }
            ?>
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                // [
                //     'class' => EditableColumn::className(),
                //     'attribute' => 'category_id',
                //     //'readonly' => false,
                //     'refreshGrid' => true,
                //     'filterType' => GridView::FILTER_SELECT2,
                //     'filterWidgetOptions' => [
                //         'pluginOptions' => ['allowClear' => true],
                //     ],
                //     'filter' => \backend\models\CommodityCategories::getList(),
                //     'filterInputOptions' => ['prompt' => 'Filter by commodity category', 'class' => 'form-control', 'id' => null],
                //     'editableOptions' => [
                //         'asPopover' => true,
                //         'type' => 'success',
                //         'size' => PopoverX::SIZE_MEDIUM,
                //         'options' => ['class' => 'form-control', 'prompt' => 'Select commodity category', 'custom' => true,],
                //         'inputType' => Editable::INPUT_DROPDOWN_LIST,
                //         'data' => \backend\models\CommodityCategories::getList(),
                //     ],
                //     'value' => function ($model) {
                //         $name = backend\models\CommodityCategories::findOne($model->category_id)->name;
                //         return $name;
                //     },
                // ],
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
                    'filter' => \backend\models\AWPBCommodityTypes::getNames(),
                    'filterInputOptions' => ['prompt' => 'Filter by name', 'class' => 'form-control',],
                    'format' => 'raw',
                    'refreshGrid' => true,
                ],
                //  'name',
                [
                    'attribute' => 'created_at',
                    'filter' => false,
                    'label' => 'Date added',
                    'value' => function ($model) {
                        return date('d-M-Y', $model->created_at);
                    }
                ],
                // 'updated_at',
                //'created_by',
                //'updated_by',
                ['class' => ActionColumn::className(),
                    'options' => ['style' => 'width:130px;'],
                    'template' => '{delete}',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            if (User::userIsAllowedTo('Remove commodity config')) {
                                return Html::a(
                                                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                            'title' => 'Remove type',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to remove ' . $model->name . ' commodity type?<br>'
                                                . 'Commodity type will only be removed if its not being used by the system!',
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
                <h5 class="modal-title">Add new commodity type</h5>
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
                    'Name of commodity type', 'id' => "type", 'required' => true,])
                ?>
            </div>
            <div class="modal-footer justify-content-between">
                <?= Html::submitButton('Save commodity type', ['class' => 'btn btn-success btn-sm']) ?>
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
