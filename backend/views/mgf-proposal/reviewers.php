<?php

use backend\models\User;
use frontend\models\MgfOperation;
use frontend\models\MgfReviewer;
use yii\helpers\Html;
use kartik\form\ActiveForm;

use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProposalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project Reviewers';
?>

<div class="card card-success card-outline">
    <div class="card-body">
    <?php include('tab.php');?>
    <hr class="dotted short"> 
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">First Name</th>
            <th scope="col">Mobile No.</th>
            <th scope="col">Email</th>
            <th scope="col">Type</th>
            <th scope="col">Operational Type</th>
            <th scope="col">Assigned(WIndow 1)</th>
            <th scope="col">Assigned(WIndow 2)</th>
            <th scope="col">
                <?= Html::button('<i class="glyphicon glyphicon-plus"></i>Create Project Reviewer', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#newReviwer\').modal();']);?>
            </th>  
          </tr>
        </thead>
        <tbody>
          <?php  $i=1; ?>
          <?php foreach($reviewers as $post):?>
          <tr class="table-active">
            <th scope="row"><?=$i; ?></th>
            <td><?=$post->first_name; ?></td>
            <td><?=$post->last_name; ?></td>
            <td><?=$post->mobile; ?></td>
            <td><?=$post->email; ?></td>
            <td><?=$post->reviewer_type; ?></td>
            <td><?=$post->area_of_expertise; ?></td>
            <td><?=$post->total_assigned_1; ?></td>
            <td><?=$post->total_assigned_2; ?></td>
            <td>              
              <span><?=Html::a('<i class="glyphicon glyphicon-link"></i>Assign Proposal',['mgf-proposal/unassigned','id'=>$post->id],['class'=>'btn btn-default btn-sm'])?></span> 
            </td>
          </tr>
          <?php  $i=$i+1; ?>
          <?php endforeach; ?>
            
        </tbody>
      </table>
    </div>
</div>


<div class="modal fade" id="newReviwer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Create Reviewer</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-proposal/create-reviewer',]) ?>
                <?php $model = new MgfReviewer();?>
                <?= $form->field($model, 'login_code')->textInput(['maxlength' => true]) ?>
               
                    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                              
                    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'reviewer_type')->dropDownList(['External' => 'External', 'Internal' => 'Internal'], ['prompt'=>'SELECT']) ?>

                    <?= $form->field($model, 'area_of_expertise')->dropDownList(ArrayHelper::map(MgfOperation::find()->all(),'operation_type','operation_type'),['prompt' => 'SELECT','required'=>true]);?>


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


<div class="modal fade" id="updateReviewer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Update Information</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-proposal/create-reviewer',]) ?>
                <?= $form->field($model, 'login_code')->textInput(['maxlength' => true]) ?>
               
                    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                              
                    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'reviewer_type')->dropDownList(['External' => 'External', 'Internal' => 'Internal'], ['prompt'=>'SELECT']) ?>

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
