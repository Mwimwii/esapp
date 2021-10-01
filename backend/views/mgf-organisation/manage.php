<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisation */

$this->title = "MGF Application: ".$model->cooperative;

\yii\web\YiiAsset::register($this);
?>
<div class="mgf-organisation-view">
    <h1><?= Html::encode($this->title) ?></h1>


<?php if($applicant->applicant_type=="Subsistence Farmer"){}else{?>
      <h3>Project Concept Note</h3> 
      <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Project Title</th>
            <th scope="col">Estimated Cost(K)</th>
            <th scope="col">Starting Date</th>
            <th scope="col">Operation Type</th>
            <th scope="col">Period(Years)</th>
            <th scope="col">District</th>
            <th scope="col">Date Created</th>
            <th scope="col">Date Submitted</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($concepts)>0): ?>
          <?php  $i=1; ?>
          <?php foreach($concepts as $post):?>
          <tr class="table-active">
            <th scope="row"><?=$i; ?></th>
            <td><?=$post->project_title; ?></td>
            <td><?=$post->estimated_cost; ?></td>
            <td><?=$post->starting_date; ?></td>
            <td><p><?=$post->operation->operation_type; ?></p>
            <p>Other Type:<?=$post->other_operation_type; ?></p></td>
            <td><?=$post->implimentation_period; ?></td>
            <td><?=$post->organisation->district->name; ?></td>
            <td><?=$post->date_created; ?></td>
            <td><?=$post->date_submitted; ?></td>
            <td>
            <?php if($post->application->application_status=="Initialized" || $post->application->application_status=="Cancelled"): ?>
            <span><?=Html::a('<i class="glyphicon glyphicon-check"></i>Submit Application',['mgf-concept-note/submit','id'=>$post->id],['class'=>'btn btn-warning','onclick' => 'return confirm("Submit this Application For Approval?")'])?></span> 
            <?php elseif($post->application->application_status=="Submitted"): ?>
            <span><?=Html::a('<i class="glyphicon glyphicon-remove"></i>Cancel Application',['mgf-concept-note/cancel','id'=>$post->id],['class'=>'btn btn-danger','onclick' => 'return confirm("Cancel this Submission?")'])?></span> 
            <?php else:?><?php endif; ?>
          </td>
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
<?php } ?>  

<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Uploaded Documents
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="collapseThree" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Registration Certificate</th>
              <th scope="col">Articles Of Assoc</th>
              <th scope="col">Audit Reports</th>
              <th scope="col">MOU Contract</th>
              <th scope="col">Board Resolution</th>
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
              <?php if($post->application->application_status=="Initialized"): ?>
              <td>
                <?=Html::a('<i class="glyphicon glyphicon-upload"></i>Upload Documents',['mgf-attachements/update','id'=>$post->id],['class'=>'btn btn-default'])?>
              </td>
              <?php endif; ?>
            </tr>
            <?php  $i=$i+1; ?>
              <?php endforeach; ?>
                <?php else:?>
                  <tr>
                      <td>No Records Fount</td>
                  </tr>
                <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?=Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'], ['class' => 'btn btn-default']);?>

</div>
