<?php

use backend\models\MgfProposal;
use frontend\models\MgfReviewer;
use yii\helpers\Html;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProposalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if ($assigned=="NO") {
    $this->title = 'Unassigned Reviewers';
}else{
    $this->title = 'Assigned Reviewers';
}
?>
<?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-proposal/proposals',], ['class' => 'btn btn-default']);?>
<div class="card card-success card-outline">
    <div class="card-body">

<div class="margin">
    <div class="btn-group">
        <button type="button" class="btn btn-default">MGF Reviewers</button>
        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu" style="width: 150%;">
            <?= Html::a('UNASSIGNED ('.$proposal->project_operations.')', ['reviewers','id'=>$_GET['id']]) ?><br/>
            <?= Html::a('UNASSIGNED (Other)', ['reviewers-other','id'=>$_GET['id']]) ?><br/>
            <?= Html::a('A S S I G N E D', ['assigned','id'=>$_GET['id']]) ?><br/>
        </div>
    </div>
</div>

<?php if($assigned=="NO") {?>
    <div class="card-body">
    <h4><?= "Assign " . $proposal->project_title.'('.$proposal->project_operations.')';?></h4>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Reviewer Type</th>
            <th scope="col">Area of Experties</th>
            <th scope="col">Window 1 Assigned</th>
            <th scope="col">Window 2 Assigned</th>
            
            <th scope="col">
            <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-reviewer/assign-reviewers&id='.$proposal->id]) ?>
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
            <td><?=$post->reviewer_type; ?></td>
            <td><?=$post->area_of_expertise; ?></td>
            <td><?=$post->total_assigned_1; ?></td>
            <td><?=$post->total_assigned_2; ?></td>
            <td>
              <input type="checkbox" name="reviewers[]" value="<?= $post->id?>">
            </td>
          </tr>
          <?php  $i=$i+1; ?>
          <?php endforeach; ?>
            
        </tbody>
        <?php $model = MgfProposal::findOne($proposal->id); if(count($reviewers)>0){?>
        <div class="modal-footer">
            <?= Html::submitButton('<i class="fa fa-check"></i>Assign to Selected Reviewers ', ['class' => 'btn btn-success btn-sm']) ?>
        </div> 
        <?php } ?> 
        <?php ActiveForm::end() ?>
      </table>
    </div>
</div>
</div>

<?php }else{?>
    <div class="card-body">
    <h3><?= "Reviewers Assigned to " . $proposal->project_title;?></h3>
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Reviewer Type</th>
            <th scope="col">Project Operations</th>
            <th scope="col">Window 1 Assigned</th>
            <th scope="col">Window 2 Assigned</th>
            <th scope="col">
              <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-reviewer/remove-reviewers&id='.$proposal->id]) ?>
            </th>  
          </tr>
        </thead>
        <tbody>
          <?php  $i=1; ?>
          <?php foreach($reviewers as $rev):?>
          <?php $post = MgfReviewer::findOne(['user_id'=>$rev->reviewedby]); ?>
          <tr class="table-active">
            <th scope="row"><?=$i; ?></th>
            <td><?=$post->first_name; ?></td>
            <td><?=$post->last_name; ?></td>
            <td><?=$post->reviewer_type; ?></td>
            <td><?=$post->area_of_expertise; ?></td>
            <td><?=$post->total_assigned_1; ?></td>
            <td><?=$post->total_assigned_2; ?></td>
            <td>
              <input type="checkbox" name="reviewers[]" value="<?= $rev->id?>">
            </td>
          </tr>
          <?php  $i=$i+1; ?>
          <?php endforeach; ?>
            
        </tbody>
        <?php $model = MgfProposal::findOne($proposal->id); if(count($reviewers)>0){?>
        <div class="modal-footer">
            <?= Html::submitButton('<i class="fa fa-times"></i>Remove Selected Reviewers ', ['class' => 'btn btn-danger btn-sm']) ?>
        </div>  
        <?php } ?>
        <?php ActiveForm::end() ?>
      </table>
    </div>
</div>
</div>

<?php } ?>





