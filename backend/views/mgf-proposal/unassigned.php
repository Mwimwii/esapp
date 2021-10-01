<?php

use backend\models\User;
use frontend\models\MgfReviewer;
use yii\helpers\Html;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfProposalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if ($assigned=="NO") {
    $this->title = 'Unassigned Proposals';
}else{
    $this->title = 'Assigned Proposals';
}
?>
<h1><?= Html::encode($this->title) ?></h1>
<?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-proposal/reviewers',], ['class' => 'btn btn-default']);?>
<div class="panel with-nav-tabs panel-primary">
<div class="panel-body">
<div class="btn btn-default" style="color:black;background:lightgray;font-weight:bold">
<ul class="nav nav-tabs nav-justified">
<?php if($assigned=="NO") {?>
    <li class="active">
        <?= Html::a('U N A S S I G N E D', ['unassigned','id'=>$_GET['id']]) ?>
    </li>
    <li>
        <?= Html::a('A S S I G N E D', ['assigned','id'=>$_GET['id']]) ?>
    </li>
<?php }else{?>
    <li>
        <?= Html::a('U N A S S I G N E D', ['unassigned','id'=>$_GET['id']]) ?>
    </li>
    <li class="active">
        <?= Html::a('A S S I G N E D', ['assigned','id'=>$_GET['id']]) ?>
    </li>
<?php }?>
</ul>
</div>


<?php if($assigned=="NO") {?>


    <div class="card-body">
    <h3><?= "Assign Proposals to " . $reviewer->first_name .' '.$reviewer->last_name?></h3>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Project Name</th>
            <th scope="col">Organisation</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Province</th>
            <th scope="col">District</th>
            <th scope="col">Reviewers</th>
            <th scope="col">
            <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-proposal/assign-proposals&id='.$reviewer->id]) ?>

            </th>  
          </tr>
        </thead>
        <tbody>
          <?php  $i=1; ?>
          <?php foreach($submitted as $post):?>
          <tr class="table-active">
            <th scope="row"><?=$i; ?></th>
            <td><?=$post->project_title; ?></td>
            <td><?=$post->organisation->cooperative; ?></td>
            <td><?=$post->starting_date; ?></td>
            <td><?=$post->ending_date; ?></td>
            <td><?=$post->province->name; ?></td>
            <td><?=$post->district->name; ?></td>
            <td><?=$post->number_reviewers; ?></td>
            <td>
              <input type="checkbox" name="proposals[]" value="<?= $post->id?>">
            </td>
          </tr>
          <?php  $i=$i+1; ?>
          <?php endforeach; ?>
            
        </tbody>
        <?php $model = MgfReviewer::findOne($reviewer->id);?>
        <div class="modal-footer">
            <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Assign Selected Projects ', ['class' => 'btn btn-success btn-sm']) ?>
        </div>  
        <?php ActiveForm::end() ?>
      </table>
    </div>
</div>
</div>

<?php }else{?>


    <div class="card-body">
    <h3><?= "Proposals Assign to " . $reviewer->first_name .' '.$reviewer->last_name?></h3>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Project Name</th>
            <th scope="col">Organisation</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Province</th>
            <th scope="col">District</th>
            <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-proposal/remove-proposals&id='.$reviewer->id]) ?>
            <th scope="col">
            </th>  
          </tr>
        </thead>
        <tbody>
          <?php  $i=1; ?>
          <?php foreach($assignedto as $post):?>
          <tr class="table-active">
            <th scope="row"><?=$i; ?></th>
            <td><?=$post->proposal->project_title; ?></td>
            <td><?=$post->organisation->cooperative; ?></td>
            <td><?=$post->proposal->starting_date; ?></td>
            <td><?=$post->proposal->ending_date; ?></td>
            <td><?=$post->proposal->province->name; ?></td>
            <td><?=$post->proposal->district->name; ?></td>
            <td>
              <input type="hidden" name="proposals[]" value="<?= $post->id?>">
              <?= Html::a('<i class="glyphicon glyphicon-remove"></i>Remove', ['mgf-proposal/remove-proposals', 'id' => $post->id], ['class' => 'label label-danger','data' => ['confirm' => 'Remove this project from this Reviewer?','method' => 'post',],]) ?>
            </td>
          </tr>
          <?php  $i=$i+1; ?>
          <?php endforeach; ?>
            
        </tbody>
        <?php $model = MgfReviewer::findOne($reviewer->id);?>
        <div class="modal-footer">
            <?= '`'//Html::submitButton('<i class="glyphicon glyphicon-remove"></i>Remove Selected Projects ', ['class' => 'btn btn-danger btn-sm']) ?>
        </div>  
        <?php ActiveForm::end() ?>
      </table>
    </div>
</div>
</div>

<?php } ?>





