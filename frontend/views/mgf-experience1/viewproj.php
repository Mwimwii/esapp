<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\MgfPastproject;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfExperience */
$this->title = 'Previous Experience with External Project Financing';
\yii\web\YiiAsset::register($this);
$pastprojects=MgfPastproject::find()->where(['experience_id'=>$model->id])->all();
?>
<div class="mgf-experience-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'financed_before',
            'any_collaboration',
            'collaboration_will',
            'collaboration_ready',
        ],
    ]),
    Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile'], ['class' => 'btn btn-default']),
    Html::a('<i class="glyphicon glyphicon-edit"></i>Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])
     ?>
<?php include('exptab.php'); ?>
<?php if(count($pastprojects)>0): ?>
    <h3>MGF-ESSAP Past Projects</h3>
<div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Project Name</th>
            <th scope="col">Amount Assisted</th>
            <th scope="col">Period (Years)</th>
            <th scope="col">Perfomance/Result</th>
            <th scope="col">Comment</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php  $ia=1; ?>
          <?php foreach($pastprojects as $act):?>
          <tr class="table-active">
            <th scope="row"><?=$ia; ?></th>
            <td><?=$act->project_name; ?></td>
            <td><?=$act->amount_assisted; ?></td>
            <td><?=$act->years_assisted; ?></td>
            <td><?php if($act->obligations_met=="YES"){echo '<lable class="label label-success">Success</lable>';}else{echo '<lable class="label label-danger">Fail</lable>';} ?></td>
            <td><?=$act->outcome_response; ?></td>
            <td>
                <?= Html::a('<i class="glyphicon glyphicon-trash"></i>Delete', ['mgf-experience/project-delete', 'id' => $act->id], ['class' => 'label label-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
            </td>
          </tr>
          <?php  $ia=$ia+1; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>

</div>
