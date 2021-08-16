<?php

use backend\models\MgfReviewer;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\form\ActiveForm;
use backend\models\MgfOperation;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfReviewerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Reviewers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
    <h1><?= Html::encode($this->title) ?></h1>

    <!--
        <div class="modal-footer">
            <?= Html::button('<i class="fa fa-plus"></i>Create MGF Reviewer', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#newReviewer\').modal();']);?>
        </div>
    -->

    <div class="modal-footer">
        <?= Html::a('<i class="fa fa-plus"></i>Create MGF Reviewer', ['users/create'], ['class' => 'btn btn-success btn-sm']);?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'first_name',
            'last_name',
            'mobile',
            'email:email',
            'reviewer_type',
            'area_of_expertise:ntext',
            'total_assigned_1',
            'total_assigned_2',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>

    </div>
</div>


<div class="modal fade" id="newReviewer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create MGF Project Reviewer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-reviewer/create']) ?>
                <?php $model = new MgfReviewer();?>
                <?= $form->field($model, 'title')->dropDownList([ 'Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Ms.' => 'Ms.', 'Miss.' => 'Miss.', 'Dr.' => 'Dr.', 'Prof.' => 'Prof.', 'Rev.' => 'Rev.', ], ['prompt' => 'SELECT','required'=>true]) ?>

                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'login_code')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'reviewer_type')->dropDownList([ 'Internal' => 'Internal', 'External' => 'External', ], ['prompt' => 'SELECT']) ?>

                <?= $form->field($model, 'area_of_expertise')->dropDownList(ArrayHelper::map(MgfOperation::find()->all(),'operation_type','operation_type'),['prompt' => 'SELECT','required'=>true]);?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
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
