<?php

use yii\helpers\Html;
use frontend\models\MgfInputItem;
use kartik\form\ActiveForm;
use frontend\models\MgfActivity;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfComponent */
$this->title = $model->component_name;
?>

<h2><?='Manage '.Html::encode($this->title) ?><?=': Cost = ZMW '.Html::encode($model->subtotal) ?></h2>
    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['components'],['class' => 'btn btn-default'])?>
<?php include('comptab.php');?>
<div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Activity Name</th>
            <th scope="col">Inputs Added</th>
            <th scope="col">Cost (ZMW)</th>
            <th scope="col"><?=Html::button('New Activity', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#newActivity\').modal();']);?></th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($activities)>0): ?>
          <?php  $ia=1; ?>
          <?php foreach($activities as $act):?>
          <tr class="table-active">
            <th scope="row"><?=$ia; ?></th>
            <td><?=$act->activity_name; ?></td>
            <td><?=$act->inputs; ?></td>
            <td><?=$act->subtotal; ?></td>
            <?php $items=MgfInputItem::find()->where(['activity_id'=>$act->id])->count();?>
            <td>
<<<<<<< HEAD
              <span><?=Html::a('<i class="fa fa-edit"></i>Edit',['mgf-activity/update','id'=>$act->id],['class'=>'btn btn-primary btn-sm'])?></span> 
              <?php if($items==0): ?>
                <?= Html::a('<i class="fa fa-trash"></i>Delete', ['mgf-activity/delete', 'id' => $act->id], ['class' => 'btn btn-danger btn-sm','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
              <?php endif; ?>
              <span><?=Html::a('<i class="fa fa-plus"></i>Add Input Item',['/mgf-input-item/create','id'=>$act->id],['class'=>'btn btn-success btn-sm'])?></span> 
=======
              <span><?=Html::a('<i class="glyphicon glyphicon-edit"></i>Edit',['mgf-activity/update','id'=>$act->id],['class'=>'label label-primary'])?></span> 
              <?php if($items==0): ?>
                <?= Html::a('<i class="glyphicon glyphicon-trash"></i>Delete', ['mgf-activity/delete', 'id' => $act->id], ['class' => 'label label-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
              <?php endif; ?>
              <span><?=Html::a('<i class="glyphicon glyphicon-plus"></i>Add Input Item',['/mgf-input-item/create','id'=>$act->id],['class'=>'label label-success'])?></span> 
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
            </td>
          </tr>
          <?php  $ia=$ia+1; ?>
          <?php endforeach; ?>
            <?php else:?>
              <tr>
                  <td>No Activity Added for <?=$model->component_name; ?></td>
              </tr>
            <?php endif; ?>
        </tbody>
      </table>
    </div>


<div class="modal fade" id="newActivity">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Activity for <?= $model->component_name; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                  $form = ActiveForm::begin(['action' => 'index.php?r=mgf-activity%2Fcreate&id='.$model->id,])
                ?>

                <?php $model = new MgfActivity();?>
                <?= $form->field($model, 'activity_name')->textInput() ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>




 