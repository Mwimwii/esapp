<?php
<<<<<<< HEAD
=======

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
use backend\models\Districts;
use backend\models\Provinces;
use backend\models\MgfApproval;
use backend\models\MgfConceptNote;
use backend\models\MgfOrganisation;
use backend\models\User;
//use yii\bootstrap4\ActiveForm;
//use kartik\detail\DetailView;
use yii\helpers\Html;

use yii\widgets\DetailView;
use kartik\form\ActiveForm;
<<<<<<< HEAD
use yii\helpers\Url;

=======
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisation */
yii\web\YiiAsset::register($this);
$user = User::findOne(['id' => Yii::$app->user->id]);
$fname=Yii::$app->user->identity->first_name;
$lname=Yii::$app->user->identity->last_name;
<<<<<<< HEAD
$usertype=Yii::$app->user->identity->type_of_user;
=======
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
$concept=MgfConceptNote::findOne($model->id);
$model=MgfOrganisation::findOne($model->organisation_id);

$district=Districts::findOne($model->district_id);
$province=Provinces::findOne($model->province_id);

?>

<div class="card card-success card-outline">
    <div class="card-body">
  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#" aria-expanded="false">
    <h4>Project Concept Note Screening Form [WINDOW 2]</h4>
  </button>

<div class="panel with-nav-tabs panel-primary">
<div class="panel-body">
<h3>Project Title: <?=$concept->project_title; ?></h3>
<<<<<<< HEAD
<?=Html::a('<i class="fa fa-backward"></i>Back', ['mgf-proposal/submitted-concept-notes',], ['class' => 'btn btn-default']);?>


<div class="row">
    <div class="col-lg-6">
        <!-- TO DO List -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Application Forms
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                <ul class="todo-list" data-widget="todo-list">
                    <li>
                        <?php
                        echo Html::a(
                        '<div  class="icheck-primary d-inline ml-2"><i class="fa fa-file-pdf fa-1x"></i></div>
                        <span class="text">Appendix 2a: Project Concept Note - Summary Sheet</span>
                        <div class="tools"><i class="fas fa-download fa-1x"></i></div>',
                        ['mgf-organisation/download-appendix-one','id'=>$model->id,],
                          [
                            'target' => '_blank',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'data-pjax' => '0',
                            'style' => "padding:5px;",
                            ]
                        );
                        ?>

                    </li>
                    <li>
                        <?php
                        echo Html::a(
                        '<div  class="icheck-primary d-inline ml-2"><i class="fa fa-file-pdf fa-1x"></i></div>
                        <span class="text">Appendix 2b: MGF – Project Concept Note (Template)</span>
                        <div class="tools"><i class="fas fa-download fa-1x"></i></div>',
                        ['mgf-organisation/download-appendix-one','id'=>$model->id,],
                        [
                            'target' => '_blank',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'data-pjax' => '0',
                            'style' => "padding:5px;",
                          ]
                        );
                        ?>
                    </li>                 
                </ul>
            </div>
        </div>
    </div>
</div>


<?php if ($usertype=="District user"){ ?>
=======
<?php if ($status==0){ ?>
  <?=Html::a('<i class="fa fa-backward"></i>Back', ['index',], ['class' => 'btn btn-default']);?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
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
        <span><?=Html::a('<i class="fa fa-check"></i>Yes', ['mgf-screening/approve','id'=>$post->id,'orgid'=>$post->organisation_id,'conceptid'=>$post->conceptnote_id], ['class'=>'btn btn-success btn-sm'])?></span>
        <span><?=Html::a('<i class="fa fa-times"></i>No', ['mgf-screening/disapprove','id'=>$post->id,'orgid'=>$post->organisation_id,'conceptid'=>$post->conceptnote_id], ['class'=>'btn btn-danger btn-sm'])?></span>
      <?php }else if($post->satisfactory == 'YES') {?>
        <span><?=Html::a('<i class="fa fa-times"></i>No', ['mgf-screening/disapprove','id'=>$post->id,'orgid'=>$post->organisation_id,'conceptid'=>$post->conceptnote_id], ['class'=>'btn btn-danger btn-sm'])?></span>
      <?php }else{ ?>
        <span><?=Html::a('<i class="fa fa-check"></i>Yes', ['mgf-screening/approve','id'=>$post->id,'orgid'=>$post->organisation_id,'conceptid'=>$post->conceptnote_id], ['class'=>'btn btn-success btn-sm'])?></span>
      <?php } ?>
    </td>
    </tr>
    <?php  $i=$i+1; ?>
    <?php endforeach; ?>
    <?php if (!boolval($unmarked)) {?>
    <tr>
        <td></td>
<<<<<<< HEAD
        <td>
          <div class="row">
            <div class="col-lg-4">
              District Remarks<br/>
              District: <label><?=$district->name;?></label><br/>
              Reviewer: <label><?=$approval->reviewed_by;?></label><br/>
              Date: <label><?=$approval->review_submission;?></label><br/>
              Comment:<?=$approval->review_remark?>
            </div>  

            <div class="col-lg-4">
              Province Remarks<br/>
              Province: <label><?=$province->name;?></label><br/>
              Reviewer: <label><?=$approval->certified_by;?></label><br/>
              Date: <label><?=$approval->certify_submission;?></label><br/>
              Comment:<?=$approval->certify_remark?>
            </div>

            <div class="col-lg-4">
              PCO Remarks<br/>
              Reviewer: <label><?=$approval->approved_by;?></label><br/>
              Date: <label><?=$approval->approve_submittion;?></label><br/>
              Comment:<?=$approval->approval_remark?>
            </div>
          </div>
      </td>
          
        <td>
            <?php if($application_status=="Accepted") {?>
              <label class='btn btn-success'><?=$application_status?></label><br/>
              <?php }else{ ?>
                  <label class='btn btn-danger'><?=$application_status?></label>
              <?php } ?>
              </td>
              <td>
          <?=Html::a('<i class="fa fa-upload"></i>Upload Minutes', ['district-minutes','id'=>$concept->id], ['class' => 'btn btn-success']);?>
              
=======
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
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
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

<<<<<<< HEAD
<?php }elseif($usertype=="Provincial user"){ ?>
=======
<?php }elseif($status==1){ ?>
  <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications','status'=>1], ['class' => 'btn btn-default']);?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

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
<<<<<<< HEAD
        <td>
          <div class="row">
            <div class="col-lg-4">
              District Remarks<br/>
              District: <label><?=$district->name;?></label><br/>
              Reviewer: <label><?=$approval->reviewed_by;?></label><br/>
              Date: <label><?=$approval->review_submission;?></label><br/>
              Comment:<?=$approval->review_remark?>
            </div>  

            <div class="col-lg-4">
              Province Remarks<br/>
              Province: <label><?=$province->name;?></label><br/>
              Reviewer: <label><?=$approval->certified_by;?></label><br/>
              Date: <label><?=$approval->certify_submission;?></label><br/>
              Comment:<?=$approval->certify_remark?>
            </div>

            <div class="col-lg-4">
              PCO Remarks<br/>
              Reviewer: <label><?=$approval->approved_by;?></label><br/>
              Date: <label><?=$approval->approve_submittion;?></label><br/>
              Comment:<?=$approval->approval_remark?>
            </div>
          </div>
      </td>
        <td>
              <?php if($application_status=="Accepted") {?>
                  <label class='btn btn-success'><?=$application_status?></label><br/>
              <?php }else{ ?>
                  <label class='btn btn-danger'><?=$application_status?></label>
              <?php } ?>
              <?=Html::a('<i class="fa fa-upload"></i>Upload Minutes', ['province-minutes','id'=>$concept->id], ['class' => 'btn btn-success']);?>

              <?=Html::a('<i class="fa fa-upload"></i>Send back to District', ['province-minutes2','id'=>$concept->id], ['class' => 'btn btn-danger']);?>
=======
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
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
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

<<<<<<< HEAD
=======
  <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications','status'=>3], ['class' => 'btn btn-default']);?>

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
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
<<<<<<< HEAD
      <td>
          <div class="row">
            <div class="col-lg-4">
              District Remarks<br/>
              District: <label><?=$district->name;?></label><br/>
              Reviewer: <label><?=$approval->reviewed_by;?></label><br/>
              Date: <label><?=$approval->review_submission;?></label><br/>
              Comment:<?=$approval->review_remark?>
            </div>  

            <div class="col-lg-4">
              Province Remarks<br/>
              Province: <label><?=$province->name;?></label><br/>
              Reviewer: <label><?=$approval->certified_by;?></label><br/>
              Date: <label><?=$approval->certify_submission;?></label><br/>
              Comment:<?=$approval->certify_remark?>
            </div>

            <div class="col-lg-4">
              PCO Remarks<br/>
              Reviewer: <label><?=$approval->approved_by;?></label><br/>
              Date: <label><?=$approval->approve_submittion;?></label><br/>
              Comment:<?=$approval->approval_remark?>
            </div>
          </div>
      </td>
      <td>
          <?php if($application_status=="Accepted") {?>
                <label class='btn btn-success'><?=$application_status?></label><br/>
            <?php }else{ ?>
                <label class='btn btn-danger'><?=$application_status?></label>
            <?php } ?>
      </td>
  </tr>

  <tr>
    <td></td>
    <td>
        <div class="row">
            <div class="col-lg-4">
            </div>

            <div class="col-lg-4">
    
            <?=Html::a('<i class="fa fa-upload"></i>Upload Minutes', ['pco-minutes','id'=>$concept->id], ['class' => 'btn btn-success']);?>

            </div>  

            <div class="col-lg-4">
            <?=Html::a('<i class="fa fa-upload"></i>Send Back to District', ['pco-minutes2','id'=>$concept->id], ['class' => 'btn btn-danger']);?>
            
            </div>
          </div>
        </td>
      </tr>
=======
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
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
  <?php } ?>
    <?php else:?>
      <tr>
          <td>No Records Found</td>
      </tr>
    <?php endif; ?>
</tbody>
</table>
<?php }?>

<<<<<<< HEAD
</div>
</div>
=======

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
                <?php $model = MgfApproval::findOne($approval->id);?>
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
                <?php $model = MgfApproval::findOne($approval->id);?>
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
                <?php $model = MgfApproval::findOne($approval->id);?>
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
                <?php $model = MgfApproval::findOne($approval->id);?>
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
                <?php $model = MgfApproval::findOne($approval->id);?>
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
                <?php $model = MgfApproval::findOne($approval->id);?>
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

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
