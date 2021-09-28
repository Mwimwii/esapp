<?php
use frontend\models\MgfConceptNote;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use frontend\models\MgfOperation;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfConceptNoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MGF Project Concept Notes';
$usertype=Yii::$app->user->identity->type_of_user;
?>

<?php if($usertype=="Applicant"){ ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h2><?= Html::encode($this->title) ?></h2>
        <?= Html::button('<i class="glyphicon glyphicon-plus"></i>Create MGF Project Concept Note', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#newConceptNote\').modal();']);?>

<div class="modal fade" id="newConceptNote">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Create Project Concept Note</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-concept-note/create',]) ?>
                <?php $model = new MgfConceptNote();?>
               
                    <?= $form->field($model, 'project_title')->textInput(['maxlength' => true]) ?>
                              
                    <?= $form->field($model, 'estimated_cost')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'implimentation_period')->dropDownList([ '1' => '1 Year', '2' => '2 Years','3' => '3 Years', '4' => '4 Years','5' => '5 Years', '6' => '6 Years','7' => '7 Years', '8' => '8 Years' ], ['prompt' => 'SELECT','required'=>true]) ?>
                     
                <?= $form->field($model, 'operation_id')->dropDownList(ArrayHelper::map(MgfOperation::find()->all(),'id','operation_type'),['prompt'=>'Operational Type']) ?>

                <?= $form->field($model, 'starting_date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true,'format' => 'yyyy-mm-dd']]);?>
                <?= $form->field($model, 'other_operation_type')->textarea(['rows' => 5]) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model) {
            if ($model->application->is_active==1) {
                return ['class'=>'success'];
            } else {
                return ['class'=>'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'project_title',
            'estimated_cost',
            'starting_date',
            'operation.operation_type',
            'implimentation_period',
            ['label'=>'Status','value'=>'application.application_status'],
            'date_submitted',
            [
                'class' => 'yii\grid\ActionColumn','template' => '{view} {update} {submit} {cancel}',
                'visibleButtons' => [
                    'update' => function ($model) {
                        return $model->application->application_status == 'Initialized' 
                        || $model->application->application_status == 'Rejected'
                        || $model->application->application_status == 'Updated' 
                        || $model->application->application_status == 'Cancelled';
                    },

                     'submit' => function ($model) {
                         return ($model->application->application_status == 'Updated' || $model->application->application_status == 'Initialized' || $model->application->application_status == 'Cancelled') && $model->application->is_active == 1;
                     },
                     'cancel' => function ($model) {
                        return $model->application->application_status == 'Submitted';
                    }
                ]
            ] 
        
        ],
    ]); ?>


<?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile'],['class' => 'btn btn-default'])?>

</div>

<div class="col-md-2"></div>
</div>

<?php }else{ ?>
    <h2><?= Html::encode($this->title) ?></h2>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'rowOptions' => function ($model) {
        if ($model->application->is_active==1) {
            return ['class'=>'success'];
        } else {
            return ['class'=>'danger'];
        }
    },
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'project_title',
        'estimated_cost',
        'starting_date',
        'operation.operation_type',
        'implimentation_period',
        ['label'=>'Status','value'=>'application.application_status'],
        'organisation.cooperative',
        'date_created',
        'date_submitted',
        ['class' => 'yii\grid\ActionColumn','template' => '{view}',] 
    ],
]); ?>


<?php } ?>



