<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\MgfPastproject;
use frontend\models\MgfPartnership;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfExperience */
$this->title = 'Previous Experience with External Project Financing';
\yii\web\YiiAsset::register($this);
$partnerships=MgfPartnership::find()->where(['experience_id'=>$_GET['id']])->all();
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

    Html::a('<i class="fa fa-home"></i>Home', ['/mgf-applicant/profile'], ['class' => 'btn btn-default']),
    Html::a('<i class="fa fa-edit"></i>Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])
     ?>
<?php include('exptab.php'); ?>
<?php if(count($partnerships)>0): ?>
    <h3>Partnerships</h3>
<div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Partner Name</th>
            <th scope="col">Aim of Partnership</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php  $ia=1; ?>
          <?php foreach($partnerships as $act):?>
          <tr class="table-active">
            <th scope="row"><?=$ia; ?></th>
            <td><?=$act->partner_name; ?></td>
            <td><?=$act->partnership_aim; ?></td>
            <td><?=$act->start_date; ?></td>
            <td><?=$act->end_date; ?></td>
            <td><?=$act->partnership_status; ?></td>
            <td>
                <?= Html::a('<i class="glyphicon glyphicon-trash"></i>Delete', ['mgf-experience/partnership-delete', 'id' => $act->id], ['class' => 'label label-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
            </td>
          </tr>
          <?php  $ia=$ia+1; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>

</div>
