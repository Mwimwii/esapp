<?php

use backend\models\User;
use frontend\models\MgfComponent;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfComponentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = "Project's Components";
?>
<?= Html::a('<i class="fas fa-backward"></i>Back', ['/mgf-applicant/profile'], ['class' => 'btn btn-default']);?>

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
                'class' => 'yii\grid\ActionColumn','template' => '{view}{update}{manage} {delete}',
                'visibleButtons' => [
                    'update' => function ($model) {
                        return $model->activities==0;
                    },
                    'manage' => function ($model) {
                        if($model->proposal->proposal_status == 'Updated' || 
                                $model->proposal->proposal_status == 'Created' || 
                                $model->proposal->proposal_status == 'Cancelled' || 
                                $model->proposal->proposal_status == 'Prepared'){
                            return Html::a('<span class="fa fa-cog"></span>',['manage', 'id' => $model->id],
                                [
                                'title' => 'Manage Component',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-pjax' => '0',
                                'style' => "padding:5px;",
                                'class' => 'bt btn-lg'
                                ]);
                            }
                        return $model->proposal->proposal_status == 'Updated' || $model->proposal->proposal_status == 'Created' || $model->proposal->proposal_status == 'Prepared';
                    },

                     'delete' => function ($model) {
                         return $model->activities==0;
                     },
                ]
            ]
        ],
    ]); ?>


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
                <?= Html::submitButton('<i class="fa fa-check"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>





