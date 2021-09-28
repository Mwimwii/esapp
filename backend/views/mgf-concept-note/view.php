<?php
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
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisation */
yii\web\YiiAsset::register($this);
$user = User::findOne(['id' => Yii::$app->user->id]);
$fname=Yii::$app->user->identity->first_name;
$lname=Yii::$app->user->identity->last_name;
$usertype=Yii::$app->user->identity->type_of_user;
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
                  <label class='btn btn-success'><?=$application_status?></label><br/>
              <?php }else{ ?>
                  <label class='btn btn-danger'><?=$application_status?></label>
              <?php } ?>
              <?=Html::a('<i class="fa fa-upload"></i>Upload Minutes', ['province-minutes','id'=>$concept->id], ['class' => 'btn btn-success']);?>

              <?=Html::a('<i class="fa fa-upload"></i>Send back to District', ['province-minutes2','id'=>$concept->id], ['class' => 'btn btn-danger']);?>
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