<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\MgfApplicant;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfAttachements */

$this->title = "Uploaded Documents";
$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-attachements-view">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php if($applicant->applicant_type=="Category-A"){ ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'registration_certificate:ntext',
                'articles_of_assoc:ntext',
                'mou_contract:ntext',
                'board_resolution:ntext',
                'date_submitted',
            ],

            ]) ,Html::a('<i class="fa fa-home"></i>Home', ['/mgf-applicant/profile'], ['class' => 'btn btn-default']);

        ?>

        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Registration Certificate</th>
              <th scope="col">Articles of Association/Constituion</th>
              <th scope="col">MOU/Contract</th>
              <th scope="col">Executive/Board Resolution</th>
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
              <td><?=$post->mou_contract;?></td>
              <td><?=$post->board_resolution;?></td>
            <?php else:?>
              <td><a href="<?=$post->registration_certificate;?>">Download</a></td>
              <td><a href="<?=$post->articles_of_assoc;?>">Download</a></td>
              <td><a href="<?=$post->mou_contract;?>">Download</a></td>
              <td><a href="<?=$post->board_resolution;?>">Download</a></td>
            <?php endif; ?>
              <?php if($post->application->application_status=="Initialized" || $post->application->application_status=="Updated" || $post->application->application_status=="Cancelled"): ?>
              <td>
                <?=Html::a('<i class="fa fa-upload"></i>Upload Documents',['mgf-attachements/update','id'=>$post->id],['class'=>'btn btn-default'])?>
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

    <?php }else{ ?>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'registration_certificate:ntext',
                'articles_of_assoc:ntext',
                'audit_reports:ntext',
                'mou_contract:ntext',
                'board_resolution:ntext',
                'application_attachement:ntext',
                'date_submitted',
            ],
            ]) ,Html::a('<i class="fa fa-home"></i>Home', ['/mgf-applicant/profile'], ['class' => 'btn btn-default']);
        ?>

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
            <?php if($post->application->application_status=="Initialized" || $post->application->application_status=="Updated" || $post->application->application_status=="Cancelled"): ?>
              <td>
                <?=Html::a('<i class="fa fa-upload"></i>Upload Documents',['mgf-attachements/update','id'=>$post->id],['class'=>'btn btn-default'])?>
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
    <?php } ?>
</div>
