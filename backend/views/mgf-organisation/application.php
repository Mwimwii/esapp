<?php
<<<<<<< HEAD
use backend\models\MgfApplicant;
use backend\models\Districts;
use backend\models\Provinces;
use backend\models\MgfEligibilityApproval;
use backend\models\MgfOrganisation;
//use yii\bootstrap4\ActiveForm;
//use kartik\detail\DetailView;
use yii\helpers\Html;

use yii\widgets\DetailView;
use kartik\form\ActiveForm;
use yii\helpers\Url;

=======

use backend\models\Districts;
use backend\models\Provinces;
use frontend\models\MgfApproval;
use frontend\models\MgfOrganisation;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\form\ActiveForm;
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisation */
yii\web\YiiAsset::register($this);
$fname=Yii::$app->user->identity->first_name;
$lname=Yii::$app->user->identity->last_name;
$organisation=MgfOrganisation::findOne($_GET['id']);
$district=Districts::findOne($organisation->district_id);
$province=Provinces::findOne($organisation->province_id);
<<<<<<< HEAD
$usertype=Yii::$app->user->identity->type_of_user;
$applicant=MgfApplicant::findOne($organisation->applicant_id);
if($applicant->applicant_type=="Category-A"){
  $window=1;
}else{
  $window=2;
}
$this->title = 'APPLICATION SCREENING FORM [WINDOWS 1 and 2]';
?>

<div class="card card-success card-outline">
    <div class="card-body">
=======
$this->title = 'APPLICATION SCREENING FORM [WINDOWS 2]';

?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
<h3><?= Html::encode($this->title) ?></h3>

  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#" aria-expanded="false">
    <h4>Screening for eligibility criteria and general conditions for participation</h4>
  </button>

<div class="panel with-nav-tabs panel-primary">
<div class="panel-body">
<<<<<<< HEAD
<h3>Organisation: <?=$organisation->cooperative; ?></h3>


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
                        <span class="text">Appendix 1: Application for Participation in the E-SAPP-MGF</span>
                        <div class="tools"><i class="fas fa-download fa-1x"></i></div>',
                        ['mgf-organisation/download-appendix-one','id'=>$organisation->id,],
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


      <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Registration Certificate</th>
              <th scope="col">Articles of Association/Constituion</th>
              <th scope="col">Audit Reports</th>
              <th scope="col">MOU/Contract</th>
              <th scope="col">Executive/Board Resolution</th>
              <th scope="col">Application Attachement</th>
            </tr>
          </thead>
          <tbody>
          <?php if(count($documents)>0): ?>
          <?php  $i=1; ?>
          <?php foreach($documents as $post):?>
            <tr class="table-active">
            <th scope="row"><?=$i; ?></th>
            <?php if($post->registration_certificate=="Nil"):?>
              <td><?=$post->registration_certificate;?></td>
              <td><?=$post->articles_of_assoc;?></td>
              <td><?=$post->audit_reports;?></td>
              <td><?=$post->mou_contract;?></td>
              <td><?=$post->board_resolution;?></td>
              <td><?=$post->application_attachement;?></td>
            <?php else:?>
              <td><a href="<?=$post->registration_certificate;?>">Download</a></td>
              <td><a href="<?=$post->articles_of_assoc;?>">Download</a></td>
              <td><a href="<?=$post->audit_reports;?>">Download</a></td>
              <td><a href="<?=$post->mou_contract;?>">Download</a></td>
              <td><a href="<?=$post->board_resolution;?>">Download</a></td>
              <td><a href="<?=$post->application_attachement;?>">Download</a></td>
            <?php endif; ?>
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



<?php if ($usertype=="District user"){ ?>
  <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications','status'=>0], ['class' => 'btn btn-default']);?>
=======
<h3>Project Title: <?=$concept->project_title; ?></h3>
<?php if ($status==0){ ?>
  <?=Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['applications','status'=>0], ['class' => 'btn btn-default']);?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
<table class="table table-bordered border-primary">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Criterion</th>
      <th scope="col"><p>Satisfactory</p></th>
<<<<<<< HEAD
      <th scope="col">Action</th>
=======
      <th scope="col">Mark</th>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
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
<<<<<<< HEAD
            <i class="fa fa-thumbs-up" style="color:green"></i>
          <?php }else{ ?>
            <i class="fa fa-thumbs-down" style="color:red"></i>
=======
            <i class="glyphicon glyphicon-ok" style="color:green"></i>
          <?php }else{ ?>
            <i class="glyphicon glyphicon-remove" style="color:red"></i>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
          <?php } ?>
      </td>
      <td>
      <?php if($post->satisfactory == NULL) {?>
<<<<<<< HEAD
        <span><?=Html::a('<i class="fa fa-check"></i>Yes', ['mgf-screening/accept','id'=>$post->id,'orgid'=>$_GET['id'],'applicationid'=>$post->application_id], ['class'=>'btn btn-success btn-sm'])?></span>
        <span><?=Html::a('<i class="fa fa-times"></i>No', ['mgf-screening/deny','id'=>$post->id,'orgid'=>$_GET['id'],'applicationid'=>$post->application_id], ['class'=>'btn btn-danger btn-sm'])?></span>
      <?php }else if($post->satisfactory == 'YES') {?>
        <span><?=Html::a('<i class="fa fa-times"></i>No', ['mgf-screening/deny','id'=>$post->id,'orgid'=>$_GET['id'],'applicationid'=>$post->application_id], ['class'=>'btn btn-danger btn-sm'])?></span>
      <?php }else{ ?>
        <span><?=Html::a('<i class="fa fa-check"></i>Yes', ['mgf-screening/accept','id'=>$post->id,'orgid'=>$_GET['id'],'applicationid'=>$post->application_id], ['class'=>'btn btn-success btn-sm'])?></span>
=======
        <span><?=Html::a('Yes', ['mgf-screening/approve','id'=>$post->id], ['class'=>'label label-success'])?></span>
        <span><?=Html::a('No', ['mgf-screening/disapprove','id'=>$post->id], ['class'=>'label label-danger'])?></span> 
      <?php }else if($post->satisfactory == 'YES') {?>
        <span><?=Html::a('No', ['mgf-screening/disapprove','id'=>$post->id], ['class'=>'label label-danger'])?></span> 
      <?php }else{ ?>
        <span><?=Html::a('Yes', ['mgf-screening/approve','id'=>$post->id], ['class'=>'label label-success'])?></span>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
      <?php } ?>
    </td>
    </tr>
    <?php  $i=$i+1; ?>
    <?php endforeach; ?>
    <?php if (!boolval($unmarked)) {?>
    <tr>
<<<<<<< HEAD
    <td></td>
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
                  <label class='btn btn-success'><?=$application_status?></label>
              <?php }else{ ?>
                  <label class='btn btn-danger'><?=$application_status?></label>
              <?php } ?>
        </td>
          
        <td> 
          <?php $form = ActiveForm::begin(['method' => 'GET','action' => Url::to(['mgf-organisation/addcomment', 'applicationid' =>$applicationid])]); ?>
            <textarea type="text" name="comment" class="form-control" placeholder="Add Comment" required></textarea><br/>
            <input type="hidden" name="score" class="form-control" value=<?=$approval->scores?> required><br/>
              <?= Html::submitButton('<i class="fa fa-comment"></i>Send to Province', ['class' => 'btn btn-info']) ?>
          <?php ActiveForm::end(); ?>
=======
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
              <?= Html::button('<i class="glyphicon glyphicon-plus"></i>Accept Application', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#acceptProject\').modal();']);?>
          <?php }else{ ?>
              <?= Html::button('<i class="glyphicon glyphicon-comment"></i>Add Final Comment', [ 'class' => 'btn btn-info', 'onclick' => '$(\'#addFinalComment\').modal();']);?>
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
  <?php if ($approval->scores==100){?>
    <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications2','status'=>0], ['class' => 'btn btn-default']);?>
  <?php }else{?>
    <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications_2','status'=>0], ['class' => 'btn btn-default']);?>
  <?php }?>
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
<<<<<<< HEAD
    <td></td>
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
                <label class='btn btn-success'><?=$application_status?></label>
            <?php }else{ ?>
                <label class='btn btn-danger'><?=$application_status?></label>
            <?php } ?>
        </td>
    </tr>
    <tr>
    <td></td>
    <td>
        <div class="row">
            <div class="col-lg-6">
              <?php $form = ActiveForm::begin(['method' => 'GET','action' => Url::to(['mgf-organisation/addcomment2', 'applicationid' =>$applicationid])]); ?>
                <textarea type="text" name="comment" class="form-control" placeholder="Add Comment" required></textarea>
                <?= Html::submitButton('<i class="fa fa-comment"></i>Foward to PCO', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
            </div>  

            <div class="col-lg-6">
                <?php $form = ActiveForm::begin(['method' => 'GET','action' => Url::to(['mgf-organisation/addcomment22', 'applicationid' =>$applicationid])]); ?>
                  <textarea type="text" name="comment" class="form-control" placeholder="Add Comment" required></textarea>
                  <?= Html::submitButton('<i class="fa fa-comment"></i>Send Back to District', ['class' => 'btn btn-danger']) ?>
              <?php ActiveForm::end(); ?>
            </div>
          </div>
        </td>
      </tr>
=======
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
              <?= Html::button('<i class="glyphicon glyphicon-plus"></i>Province Verification', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#certifyProject\').modal();']);?>
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

<?php }elseif($status==2){ ?>
  <?=Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['applications','status'=>2], ['class' => 'btn btn-default']);?>

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
            <i class="glyphicon glyphicon-ok" style="color:green"></i>
          <?php }else{ ?>
            <i class="glyphicon glyphicon-remove" style="color:red"></i>
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
              <?= Html::button('<i class="glyphicon glyphicon-plus"></i>PCO Verification', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#approveProject\').modal();']);?>
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

<?php }else{ ?>

<<<<<<< HEAD
  <?php if ($approval->scores==100){?>
    <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications3','status'=>0], ['class' => 'btn btn-default']);?>
  <?php }else{?>
    <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications_3','status'=>0], ['class' => 'btn btn-default']);?>
  <?php }?>
=======
  <?=Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['applications','status'=>3], ['class' => 'btn btn-default']);?>
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
<<<<<<< HEAD
          <i class="fa fa-check" style="color:green"></i>
        <?php }else{ ?>
          <i class="fa fa-times" style="color:red"></i>
=======
          <i class="glyphicon glyphicon-ok" style="color:green"></i>
        <?php }else{ ?>
          <i class="glyphicon glyphicon-remove" style="color:red"></i>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
        <?php } ?>
    </td>
  </tr>
  <?php  $i=$i+1; ?>
  <?php endforeach; ?>
  <?php if (!boolval($unmarked)) {?>
  <tr>
<<<<<<< HEAD
    <td></td>
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
                <label class='btn btn-success'><?=$application_status?></label>
            <?php }else{ ?>
                <label class='btn btn-danger'><?=$application_status?></label>
            <?php } ?>
      </td>
  </tr>

  <tr>
    <td></td>
    <td>
        <div class="row">
            <div class="col-lg-6">
              <?php $form = ActiveForm::begin(['method' => 'GET','action' => Url::to(['mgf-organisation/addcomment3', 'applicationid' =>$applicationid])]); ?>
                <textarea type="text" name="comment" class="form-control" placeholder="Add Comment" required></textarea>
                <?= Html::submitButton('<i class="fa fa-save"></i>Save', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
            </div>  

            <div class="col-lg-6">
                <?php $form = ActiveForm::begin(['method' => 'GET','action' => Url::to(['mgf-organisation/addcomment33', 'applicationid' =>$applicationid])]); ?>
                  <textarea type="text" name="comment" class="form-control" placeholder="Add Comment" required></textarea>
                  <?= Html::submitButton('<i class="fa fa-comment"></i>Send Back to District', ['class' => 'btn btn-danger']) ?>
              <?php ActiveForm::end(); ?>
            </div>
          </div>
        </td>
      </tr>
=======
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
            <?= Html::button('<i class="glyphicon glyphicon-plus"></i>PCO Verification', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#approveProject\').modal();']);?>
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
=======
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


<div class="modal fade" id="acceptProject">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Approve Project Concept Note (<?=$application_status?>) </h3>
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


<div class="modal fade" id="certifyProject">
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
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
</div>