<?php
use backend\models\Districts;
use backend\models\Provinces;
use backend\models\MgfEligibilityApproval;
use backend\models\MgfOrganisation;
//use yii\bootstrap4\ActiveForm;
//use kartik\detail\DetailView;
use yii\helpers\Html;

use yii\widgets\DetailView;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisation */
yii\web\YiiAsset::register($this);
$fname=Yii::$app->user->identity->first_name;
$lname=Yii::$app->user->identity->last_name;
$organisation=MgfOrganisation::findOne($_GET['id']);
$district=Districts::findOne($organisation->district_id);
$province=Provinces::findOne($organisation->province_id);
$this->title = 'APPLICATION SCREENING FORM [WINDOWS 1 and 2]';

?>

<div class="card card-success card-outline">
    <div class="card-body">
<h3><?= Html::encode($this->title) ?></h3>

  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#" aria-expanded="false">
    <h4>Screening for eligibility criteria and general conditions for participation</h4>
  </button>

<div class="panel with-nav-tabs panel-primary">
<div class="panel-body">
<h3>Organisation: <?=$organisation->cooperative; ?></h3>
<?php if ($status==0){ ?>
  <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications','status'=>0], ['class' => 'btn btn-default']);?>
<table class="table table-bordered border-primary">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Criterion</th>
      <th scope="col"><p>Satisfactory</p></th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if(count($criteria)>0): ?>
    <?php  $i=1; ?>
    <?php foreach($criteria as $post):?>
    <tr class="table-active">
      <th scope="row"><?=$i; ?></th>
      <td><?=$post->criterion; ?></td>
      <td>
          <?php if($post->satisfactory == NULL) {?>
          <?php }else if($post->satisfactory == 'YES') {?>
            <i class="fa fa-thumbs-up" style="color:green"></i>
          <?php }else{ ?>
            <i class="fa fa-thumbs-down" style="color:red"></i>
          <?php } ?>
      </td>
      <td>
      <?php if($post->satisfactory == NULL) {?>
        <span><?=Html::a('<i class="fa fa-check"></i>Yes', ['mgf-screening/accept','id'=>$post->id,'orgid'=>$_GET['id'],'applicationid'=>$post->application_id], ['class'=>'btn btn-success btn-sm'])?></span>
        <span><?=Html::a('<i class="fa fa-times"></i>No', ['mgf-screening/deny','id'=>$post->id,'orgid'=>$_GET['id'],'applicationid'=>$post->application_id], ['class'=>'btn btn-danger btn-sm'])?></span>
      <?php }else if($post->satisfactory == 'YES') {?>
        <span><?=Html::a('<i class="fa fa-times"></i>No', ['mgf-screening/deny','id'=>$post->id,'orgid'=>$_GET['id'],'applicationid'=>$post->application_id], ['class'=>'btn btn-danger btn-sm'])?></span>
      <?php }else{ ?>
        <span><?=Html::a('<i class="fa fa-check"></i>Yes', ['mgf-screening/accept','id'=>$post->id,'orgid'=>$_GET['id'],'applicationid'=>$post->application_id], ['class'=>'btn btn-success btn-sm'])?></span>
      <?php } ?>
    </td>
    </tr>
    <?php  $i=$i+1; ?>
    <?php endforeach; ?>
    <?php if (!boolval($unmarked)) {?>
    <tr>
        <td></td>
        <td>Final Remarks
        <?php if($application_status=="Accepted") {?>
            <label class='btn btn-success'><?=$application_status?></label><br/>
            Reviewer: <label><?=$fname.' '.$lname;?></label><br/>
            District: <label><?=$district->name;?></label><br/>
            Date: <label><?=date('Y-m-d')?></label>
        <?php }elseif($application_status=="Rejected") {?>
            <label class='btn btn-danger'><?=$application_status?></label>
        <?php }else{ ?>
            <label class='btn btn-warning'><?=$application_status?></label>
        <?php } ?>
        </td>
        <td>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $approval->scores.'%'; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">(<?= $approval->scores.'%'; ?>)</div>
          </div>
        </td>
          
        <td>
          <?php if($application_status=="Accepted") {?>
              <?= Html::button('<i class="fa fa-plus"></i>Accept Application', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#acceptProject\').modal();']);?>
          <?php }else{ ?>
              <?= Html::button('<i class="fa fa-comment"></i>Add Final Comment', [ 'class' => 'btn btn-info', 'onclick' => '$(\'#acceptProject\').modal();']);?>
          <?php } ?>
        </td>
    </tr>
    <?php } ?>
      <?php else:?>
        <tr>
            <td>No Records Found</td>
        </tr>
      <?php endif; ?>
  </tbody>
</table>

<?php }elseif($status==1){ ?>
  <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications','status'=>1], ['class' => 'btn btn-default']);?>

  <table class="table table-bordered border-primary">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Criterion</th>
      <th scope="col"><p>Satisfactory</p></th>
    </tr>
  </thead>
  <tbody>
    <?php if(count($criteria)>0): ?>
    <?php  $i=1; ?>
    <?php foreach($criteria as $post):?>
    <tr class="table-active">
      <th scope="row"><?=$i; ?></th>
      <td><?=$post->criterion; ?></td>
      <td>
          <?php if($post->satisfactory == NULL) {?>
          <?php }else if($post->satisfactory == 'YES') {?>
            <i class="fa fa-check" style="color:green"></i>
          <?php }else{ ?>
            <i class="fa fa-times" style="color:red"></i>
          <?php } ?>
      </td>
    </tr>
    <?php  $i=$i+1; ?>
    <?php endforeach; ?>
    <?php if (!boolval($unmarked)) {?>
    <tr>
        <td></td>
        <td>Final Remarks
        <?php if($application_status=="Accepted") {?>
            <label class='btn btn-success'><?=$application_status?></label><br/>
            Reviewer: <label><?=$fname.' '.$lname;?></label><br/>
            District: <label><?=$district->name;?></label><br/>
            Date: <label><?=date('Y-m-d')?></label>
        <?php }elseif($application_status=="Rejected") {?>
            <label class='btn btn-danger'><?=$application_status?></label>
        <?php }else{ ?>
            <label class='btn btn-warning'><?=$application_status?></label>
        <?php } ?>
        </td>
        <td>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $approval->scores.'%'; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">(<?= $approval->scores.'%'; ?>)</div>
          </div>
        
          <?php if($application_status=="Accepted") {?>
              <?= Html::button('<i class="fa fa-plus"></i>Province Verification', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#acceptProject\').modal();']);?>
          <?php }else{ ?>
              <?= Html::button('<i class="fa fa-comment"></i>Add Final Comment', [ 'class' => 'btn btn-info', 'onclick' => '$(\'#acceptProject\').modal();']);?>
          <?php } ?>
        </td>
    </tr>
    <?php } ?>
      <?php else:?>
        <tr>
            <td>No Records Found</td>
        </tr>
      <?php endif; ?>
  </tbody>
</table>

<?php }elseif($status==2){ ?>
  <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications','status'=>2], ['class' => 'btn btn-default']);?>

  <table class="table table-bordered border-primary">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Criterion</th>
      <th scope="col"><p>Satisfactory</p></th>
    </tr>
  </thead>
  <tbody>
    <?php if(count($criteria)>0): ?>
    <?php  $i=1; ?>
    <?php foreach($criteria as $post):?>
    <tr class="table-active">
      <th scope="row"><?=$i; ?></th>
      <td><?=$post->criterion; ?></td>
      <td>
          <?php if($post->satisfactory == NULL) {?>
          <?php }else if($post->satisfactory == 'YES') {?>
            <i class="fa fa-check" style="color:green"></i>
          <?php }else{ ?>
            <i class="fa fa-times" style="color:red"></i>
          <?php } ?>
      </td>
    </tr>
    <?php  $i=$i+1; ?>
    <?php endforeach; ?>
    <?php if (!boolval($unmarked)) {?>
    <tr>
        <td></td>
        <td>Final Remarks
        <?php if($application_status=="Certified") {?>
            <label class='btn btn-success'><?=$application_status?></label><br/>
            Reviewer: <label><?=$fname.' '.$lname;?></label><br/>
            District: <label><?=$district->name;?></label><br/>
            Province: <label><?=$province->name;?></label><br/>
            Date: <label><?=date('Y-m-d')?></label>
        <?php }elseif($application_status=="Rejected") {?>
            <label class='btn btn-warning'><?=$application_status?></label>
        <?php } ?>
        </td>
        <td>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $approval->scores.'%'; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">(<?= $approval->scores.'%'; ?>)</div>
          </div>
        
          <?php if($application_status=="Certified") {?>
              <?= Html::button('<i class="fa fa-plus"></i>PCO Verification', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#acceptProject\').modal();']);?>
          <?php }else{ ?>
              <?= Html::button('<i class="fa fa-comment"></i>Add Final Comment', [ 'class' => 'btn btn-info', 'onclick' => '$(\'#addFinalComment\').modal();']);?>
          <?php } ?>
        </td>
    </tr>
    <?php } ?>
      <?php else:?>
        <tr>
            <td>No Records Found</td>
        </tr>
      <?php endif; ?>
  </tbody>
</table>

<?php }else{ ?>

  <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications','status'=>3], ['class' => 'btn btn-default']);?>

<table class="table table-bordered border-primary">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Criterion</th>
    <th scope="col"><p>Satisfactory</p></th>
  </tr>
</thead>
<tbody>
  <?php if(count($criteria)>0): ?>
  <?php  $i=1; ?>
  <?php foreach($criteria as $post):?>
  <tr class="table-active">
    <th scope="row"><?=$i; ?></th>
    <td><?=$post->criterion; ?></td>
    <td>
        <?php if($post->satisfactory == NULL) {?>
        <?php }else if($post->satisfactory == 'YES') {?>
          <i class="fa fa-check" style="color:green"></i>
        <?php }else{ ?>
          <i class="fa fa-times" style="color:red"></i>
        <?php } ?>
    </td>
  </tr>
  <?php  $i=$i+1; ?>
  <?php endforeach; ?>
  <?php if (!boolval($unmarked)) {?>
  <tr>
      <td></td>
      <td>Final Remarks
      <?php if($application_status=="Certified") {?>
          <label class='btn btn-success'><?=$application_status?></label><br/>
          Reviewer: <label><?=$fname.' '.$lname;?></label><br/>
          District: <label><?=$district->name;?></label><br/>
          Province: <label><?=$province->name;?></label><br/>
          Date: <label><?=date('Y-m-d')?></label>
      <?php }elseif($application_status=="Rejected") {?>
          <label class='btn btn-warning'><?=$application_status?></label>
      <?php } ?>
      </td>
      <td>
        <div class="progress">
          <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $approval->scores.'%'; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">(<?= $approval->scores.'%'; ?>)</div>
        </div>
      
        <?php if($application_status=="Certified") {?>
            <?= Html::button('<i class="glyphicon glyphicon-plus"></i>PCO Verification', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#acceptProject\').modal();']);?>
        <?php }else{ ?>
            <?= Html::button('<i class="glyphicon glyphicon-comment"></i>Add Final Comment', [ 'class' => 'btn btn-info', 'onclick' => '$(\'#addFinalComment\').modal();']);?>
        <?php } ?>
      </td>
  </tr>
  <?php } ?>
    <?php else:?>
      <tr>
          <td>No Records Found</td>
      </tr>
    <?php endif; ?>
</tbody>
</table>
<?php }?>


  <?php if($application_status=="Accepted") {?>
    <?=Html::a('<i class="fa fa-open"></i><h5>Concept Note Screening</h5>', ['applications','status'=>3], ['class' => 'btn btn-link']);?>
  <?php } ?>


<div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <h4>General Information</h4> 
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
      
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          ['label' => 'Organisation','value' => $model->cooperative],
            'registration_no',
            'registration_date',
            ['label'=>'Applicant','value'=>$model->applicant->first_name." ".$model->applicant->last_name]
        ],
        ]) ?>
      </div>
    </div>
  </div>
<?php include('extension.php')?>


<div class="modal fade" id="acceptProject1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Recommend Project Concept Note (<?=$application_status?>) </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-approval/accept&id='.$approval->id]) ?>
                <?php $model = MgfEligibilityApproval::findOne($approval->id);?>
                <?= $form->field($model, 'review_remark')->textarea(['maxlength' => true,'rows' => 4,'value'=>'Certified as meeting eligibility criteria and conditions for participation']) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="acceptProject">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Recommend Project Concept Note (<?=$application_status?>) </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <?php if($application_status=="Accepted"){?>
                Certified as meeting eligibility criteria and conditions for participation
              <?php } ?>
              <?php if($application_status=="Certified"){?>
                Approved for participation
              <?php } ?>
            <div class="modal-footer">
                <span><?=Html::a('<i class="fa fa-check"></i>Yes', ['mgf-approval/accept','id'=>$approval->id,], ['class'=>'btn btn-success btn-sm'])?></span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="certifyProject">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Recommend Project Concept Note (<?=$application_status?>) </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            Certified as meeting eligibility criteria and conditions for participation
            <div class="modal-footer">
                <span><?=Html::a('<i class="fa fa-check"></i>Yes', ['mgf-approval/accept','id'=>$approval->id,], ['class'=>'btn btn-success btn-sm'])?></span>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="certifyProject3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Final Comment (<?=$application_status?>) </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            Checked and confirmed
            <div class="modal-footer">
                <span><?=Html::a('<i class="fa fa-check"></i>Yes', ['mgf-approval/certify','id'=>$approval->id,], ['class'=>'btn btn-success btn-sm'])?></span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="certifyProject1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Final Comment (<?=$application_status?>) </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-approval/certify&id='.$approval->id]) ?>
                <?php $model = MgfEligibilityApproval::findOne($approval->id);?>
                <?= $form->field($model, 'certify_remark')->textarea(['maxlength' => true,'rows' => 4,'value'=>'Checked and confirmed']) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="approveProject">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Final Comment (<?=$application_status?>) </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-approval/approve&id='.$approval->id]) ?>
                <?php $model = MgfEligibilityApproval::findOne($approval->id);?>
                <?= $form->field($model, 'approval_remark')->textarea(['maxlength' => true,'rows' => 4,'value'=>'Approved for participation']) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="districtFinalComment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Final Comment (<?=$application_status?>)</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-approval/review&id='.$approval->id]) ?>
                <?php $model = MgfEligibilityApproval::findOne($approval->id);?>
                <?= $form->field($model, 'review_remark')->textarea(['maxlength' => true,'rows' => 4,'value'=>'Has not met eligibility criteria and conditions for participation']) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="provinceFinalComment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Final Comment (<?=$application_status?>)</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-approval/province-review&id='.$approval->id]) ?>
                <?php $model = MgfEligibilityApproval::findOne($approval->id);?>
                <?= $form->field($model, 'certify_remark')->textarea(['maxlength' => true,'rows' => 4,'']) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="nationalFinalComment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Final Comment (<?=$application_status?>)</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-approval/national-review&id='.$approval->id]) ?>
                <?php $model = MgfEligibilityApproval::findOne($approval->id);?>
                <?= $form->field($model, 'approval_remark')->textarea(['maxlength' => true,'rows' => 4,'value'=>'Not approved for participation because ']) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>

</div>
</div>