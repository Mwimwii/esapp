<?php
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

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisation */
yii\web\YiiAsset::register($this);
$fname=Yii::$app->user->identity->first_name;
$lname=Yii::$app->user->identity->last_name;
$organisation=MgfOrganisation::findOne($_GET['id']);
$district=Districts::findOne($organisation->district_id);
$province=Provinces::findOne($organisation->province_id);
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
<h3><?= Html::encode($this->title) ?></h3>

  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#" aria-expanded="false">
    <h4>Screening for eligibility criteria and general conditions for participation</h4>
  </button>

<div class="panel with-nav-tabs panel-primary">
<div class="panel-body">
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

<?php }elseif($usertype=="Provincial user"){ ?>
  <?php if ($approval->scores==100){?>
    <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications2','status'=>0], ['class' => 'btn btn-default']);?>
  <?php }else{?>
    <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications_2','status'=>0], ['class' => 'btn btn-default']);?>
  <?php }?>
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
    <?php } ?>
      <?php else:?>
        <tr>
            <td>No Records Found</td>
        </tr>
      <?php endif; ?>
  </tbody>
</table>

<?php }else{ ?>

  <?php if ($approval->scores==100){?>
    <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications3','status'=>0], ['class' => 'btn btn-default']);?>
  <?php }else{?>
    <?=Html::a('<i class="fa fa-backward"></i>Back', ['applications_3','status'=>0], ['class' => 'btn btn-default']);?>
  <?php }?>

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
  <?php } ?>
    <?php else:?>
      <tr>
          <td>No Records Found</td>
      </tr>
    <?php endif; ?>
</tbody>
</table>
<?php }?>

</div>
</div>