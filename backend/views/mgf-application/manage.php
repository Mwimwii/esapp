<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisation */

$this->title = "MGF Application: ".$model->organisation->cooperative;

\yii\web\YiiAsset::register($this);
//echo $model->application_status;
?>
<div class="mgf-organisation-view">
    <h1><?= Html::encode($this->title) ?></h1>


<?php if($applicant->applicant_type=="Subsistence Farmer"){}else{?>
      <h3>Project Concept Note</h3> 
      <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Project Title</th>
            <th scope="col">Estimated Cost(K)</th>
            <th scope="col">Starting Date</th>
            <th scope="col">Operation Type</th>
            <th scope="col">Period(Years)</th>
            <th scope="col">District</th>
            <th scope="col">Date Created</th>
            <th scope="col">Date Submitted</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-active">
            <td><?=$concept->project_title; ?></td>
            <td><?=$concept->estimated_cost; ?></td>
            <td><?=$concept->starting_date; ?></td>
            <td><p><?=$concept->operation->operation_type; ?></p>
            <p>Other Type:<?=$concept->other_operation_type; ?></p></td>
            <td><?=$concept->implimentation_period; ?></td>
            <td><?=$concept->organisation->district->name; ?></td>
            <td><?=$concept->date_created; ?></td>
            <td><?=$concept->date_submitted; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
<?php } ?>  

     <h3>Uploaded Documents</h3>
  
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
              <?php if($model->application_status=='Initialized' || $model->application_status=='Updated'): ?>
              <td>
                <?=Html::a('<i class="glyphicon glyphicon-upload"></i>Upload Documents',['mgf-attachements/update','id'=>$post->id],['class'=>'btn btn-default'])?>
              </td>
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
</div>

<?=Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'], ['class' => 'btn btn-default']);?>

</div>
