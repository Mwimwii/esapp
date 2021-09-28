<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use frontend\models\MgfPosition;
use kartik\form\ActiveForm;
use frontend\models\MgfContact;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisation */

$this->title = "Profile of the Organisation";
$usertype=Yii::$app->user->identity->type_of_user;
\yii\web\YiiAsset::register($this);
?>


<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-9">
        <h3><?= Html::encode($this->title); ?></h3>
          <?= DetailView::widget([
              'model' => $model,
              'attributes' => [
                  ['label' => 'Organisation','value' => $model->cooperative],
                  'acronym',
                  'registration_type',
                  'registration_no',
                  'trade_license_no',
                  'registration_date',
                  'business_objective:ntext',
                  'email_address:email',
                  'physical_address',
                  'tel_no',
                  ['label' => 'Applicant','value' => $model->applicant->first_name." ".$model->applicant->last_name,],
                  'date_created',
                ],
            ]) ?>

          <?php if($usertype=="Applicant"){ ?>
              <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile'],['class' => 'btn btn-default']),
              Html::a('<i class="glyphicon glyphicon-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
          <?php }else{ ?>
              <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'],['class' => 'btn btn-default'])?>
          <?php } ?>
        </div>

    <div class="col-md-1">
    </div>
</div>

<h3>Contact Details</h3>
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Mobile No.</th>
            <th scope="col">Position</th>
            <th scope="col">Date Created</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($contacts)>0): ?>
          <?php  $i=1; ?>
          <?php foreach($contacts as $post):?>
          <tr class="table-active">
            <th scope="row"><?=$i; ?></th>
            <td><?=$post->first_name; ?></td>
            <td><?=$post->last_name; ?></td>
            <td><?=$post->mobile; ?></td>
            <td><?=$post->position->position; ?></td>
            <td><?=$post->date_created; ?></td>
          </tr>
          <?php  $i=$i+1; ?>
          <?php endforeach; ?>
            <?php else:?>
              <tr>
                  <td>No Records Found</td>
              </tr>
            <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="modal fade" id="addContantact">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Create Contact Person</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
              <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-contact%2Fcreate&id='.$model->id,]) ?>
              <?php $model = new MgfContact();?>
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tel_no')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'physical_address')->textarea(['maxlength' => true]) ?>

                <?= $form->field($model, 'position_id')->dropDownList(ArrayHelper::map(MgfPosition::find()->all(),'id','position'),['prompt'=>'Position'])?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>


