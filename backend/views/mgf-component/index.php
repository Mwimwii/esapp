<?php

use frontend\models\MgfComponent;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfComponentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
$this->title = "Project's Components";
$usertype=Yii::$app->user->identity->type_of_user;
?>


<?php if($usertype=="Applicant"){ ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h2><?= Html::encode($this->title) ?></h2>
    
            <h3>Inputs Required (by Component(s), Activities and Items of Cost)</h3>
            <div class="modal-footer">
                <?= Html::button('<i class="glyphicon glyphicon-plus"></i>Create MGF Project Component', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#newComponent\').modal();']);?>
            </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'component_name',
            'activities',
            'subtotal',
            [
                'class' => 'yii\grid\ActionColumn','template' => '{view} {update} {manage} {delete}',
                'visibleButtons' => [
                    'update' => function ($model) {
                        return $model->activities==0;;
                    },

                    'manage' => function ($model) {
                        return $model->proposal->proposal_status == 'Updated' || $model->proposal->proposal_status == 'Created';
                    },

                     'delete' => function ($model) {
                         return $model->activities==0;
                     },
                ]
            ] 
        ],
    ]); ?>

<?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile'],['class' => 'btn btn-default'])?>

<div class="modal fade" id="newComponent">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Project Component</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-component/create',]) ?>
                <?php $model = new MgfComponent();?>
                <?= $form->field($model, 'component_name')->textInput() ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

</div>

<div class="col-md-2"></div>
</div>

<?php }else{ ?>
    <h2><?= Html::encode($this->title) ?></h2>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'component_name',
        'proposal.organisation.cooperative',
        'proposal.project_title',
        'subtotal',
        'date_created',
        //'createdby',
        //['class' => 'yii\grid\ActionColumn', 'template'=>'{view} {update} {manage}'],
        [
            'class' => 'yii\grid\ActionColumn','template' => '{view} {update} {manage}',
            'visibleButtons' => [
                'update' => function ($model) {
                    return $model->proposal->proposal_status == 'Created';
                },

                 'manage' => function ($model) {
                     return $model->proposal->proposal_status == 'Updated';
                 },
            ]

        ]
    ],
]); ?>

<?php } ?>

