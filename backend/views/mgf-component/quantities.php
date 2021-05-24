<?php

use yii\helpers\Html;
use frontend\models\MgfInputItem;
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfComponent */
$this->title = $model->component_name;
?>
<div class="mgf-component-view">
<h2><?='Manage '.Html::encode($this->title) ?><?=': Cost = ZMW '.Html::encode($model->subtotal) ?></h2>
  <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['components'],['class' => 'btn btn-default'])?>
  <?php include('comptab.php');?>
  <div class="card-body"> 
    
    <?php if($proposal->project_length==1){ ?>
      <table class="table table-hover">
          <thead>
          <tr>
              <th scope="col">Activvity</th>
              <th scope="col">Input Item</th>
              <th scope="col">Unit of Measure</th>
              <th scope="col">Year 1</th>
              <th scope="col">Unit Cost(ZMK)</th>
          </tr>
          </thead>
          <tbody>
          
          <?php foreach($activities as $act):?>
          <?php $items=MgfInputItem::find()->where(['activity_id'=>$act->id])->all();?>

          <?php foreach($items as $post): ?>
              <tr class="table-active">                     
                  <td><?=$post->activity->activity_name; ?></td>
                  <td><?=$post->input_name; ?></td>
                  <td><?=$post->unit_of_measure; ?></td>
                  <td><?=$post->project_year_1; ?></td>
                  <td><?=$post->unit_cost; ?></td>
                  <td>
                    <span><?=Html::a('<i class="glyphicon glyphicon-edit"></i>Edit',['mgf-input-item/update','id'=>$post->id],['class'=>'label label-primary'])?></span> 
                    <?= Html::a('<i class="glyphicon glyphicon-trash"></i>Delete', ['mgf-input-item/delete', 'id' => $post->id], ['class' => 'label label-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
                  </td>
              </tr>
          </tbody>
          <?php endforeach;?>
          <?php endforeach;?>
      </table> 
          <?php }elseif($proposal->project_length==2){ ?>

            <table class="table table-hover">
          <thead>
          <tr>
              <th scope="col">Activvity</th>
              <th scope="col">Input Item</th>
              <th scope="col">Unit of Measure</th>
              <th scope="col">Year 1</th>
              <th scope="col">Year 2</th>
              <th scope="col">Unit Cost(ZMK)</th>
          </tr>
          </thead>
          <tbody>
          
          <?php foreach($activities as $act):?>
          <?php $items=MgfInputItem::find()->where(['activity_id'=>$act->id])->all();?>

          <?php foreach($items as $post): ?>
              <tr class="table-active">                     
                  <td><?=$post->activity->activity_name; ?></td>
                  <td><?=$post->input_name; ?></td>
                  <td><?=$post->unit_of_measure; ?></td>
                  <td><?=$post->project_year_1; ?></td>
                  <td><?=$post->project_year_2; ?></td>
                  <td><?=$post->unit_cost; ?></td>
                  <td>
                    <span><?=Html::a('<i class="glyphicon glyphicon-edit"></i>Edit',['mgf-input-item/update','id'=>$post->id],['class'=>'label label-primary'])?></span> 
                    <?= Html::a('<i class="glyphicon glyphicon-trash"></i>Delete', ['mgf-input-item/delete', 'id' => $post->id], ['class' => 'label label-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
                  </td>
              </tr>
          </tbody>
          <?php endforeach;?>
          <?php endforeach;?>
          </table>
        <?php }elseif($proposal->project_length==3){ ?>

            <table class="table table-hover">
          <thead>
          <tr>
              <th scope="col">Activvity</th>
              <th scope="col">Input Item</th>
              <th scope="col">Unit of Measure</th>
              <th scope="col">Year 1</th>
              <th scope="col">Year 2</th>
              <th scope="col">Year 3</th>
              <th scope="col">Unit Cost(ZMK)</th>
          </tr>
          </thead>
          <tbody>
          
          <?php foreach($activities as $act):?>
          <?php $items=MgfInputItem::find()->where(['activity_id'=>$act->id])->all();?>

          <?php foreach($items as $post): ?>
              <tr class="table-active">                     
                  <td><?=$post->activity->activity_name; ?></td>
                  <td><?=$post->input_name; ?></td>
                  <td><?=$post->unit_of_measure; ?></td>
                  <td><?=$post->project_year_1; ?></td>
                  <td><?=$post->project_year_2; ?></td>
                  <td><?=$post->project_year_3; ?></td>
                  <td><?=$post->unit_cost; ?></td>
                  <td>
                    <span><?=Html::a('<i class="glyphicon glyphicon-edit"></i>Edit',['mgf-input-item/update','id'=>$post->id],['class'=>'label label-primary'])?></span> 
                    <?= Html::a('<i class="glyphicon glyphicon-trash"></i>Delete', ['mgf-input-item/delete', 'id' => $post->id], ['class' => 'label label-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
                  </td>
              </tr>
          </tbody>
          <?php endforeach;?>
          <?php endforeach;?>
          </table>
          <?php }elseif($proposal->project_length==4){ ?>

            <table class="table table-hover">
            <thead>
            <tr>
              <th scope="col">Activvity</th>
              <th scope="col">Input Item</th>
              <th scope="col">Unit of Measure</th>
              <th scope="col">Year 1</th>
              <th scope="col">Year 2</th>
              <th scope="col">Year 3</th>
              <th scope="col">Year 4</th>
              <th scope="col">Unit Cost(ZMK)</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($activities as $act):?>
            <?php $items=MgfInputItem::find()->where(['activity_id'=>$act->id])->all();?>

            <?php foreach($items as $post): ?>
              <tr class="table-active">                     
                  <td><?=$post->activity->activity_name; ?></td>
                  <td><?=$post->input_name; ?></td>
                  <td><?=$post->unit_of_measure; ?></td>
                  <td><?=$post->project_year_1; ?></td>
                  <td><?=$post->project_year_2; ?></td>
                  <td><?=$post->project_year_3; ?></td>
                  <td><?=$post->project_year_4; ?></td>
                  <td><?=$post->unit_cost; ?></td>
                  <td>
                    <span><?=Html::a('<i class="glyphicon glyphicon-edit"></i>Edit',['mgf-input-item/update','id'=>$post->id],['class'=>'label label-primary'])?></span> 
                    <?= Html::a('<i class="glyphicon glyphicon-trash"></i>Delete', ['mgf-input-item/delete', 'id' => $post->id], ['class' => 'label label-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
                  </td>
              </tr>
            </tbody>
            <?php endforeach;?>
            <?php endforeach;?>
            </table>
            <?php }elseif($proposal->project_length==5){ ?>

            <table class="table table-hover">
            <thead>
            <tr>
              <th scope="col">Activvity</th>
              <th scope="col">Input Item</th>
              <th scope="col">Unit of Measure</th>
              <th scope="col">Year 1</th>
              <th scope="col">Year 2</th>
              <th scope="col">Year 3</th>
              <th scope="col">Year 4</th>
              <th scope="col">Year 5</th>
              <th scope="col">Unit Cost(ZMK)</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($activities as $act):?>
            <?php $items=MgfInputItem::find()->where(['activity_id'=>$act->id])->all();?>

            <?php foreach($items as $post): ?>
              <tr class="table-active">                     
                  <td><?=$post->activity->activity_name; ?></td>
                  <td><?=$post->input_name; ?></td>
                  <td><?=$post->unit_of_measure; ?></td>
                  <td><?=$post->project_year_1; ?></td>
                  <td><?=$post->project_year_2; ?></td>
                  <td><?=$post->project_year_3; ?></td>
                  <td><?=$post->project_year_4; ?></td>
                  <td><?=$post->project_year_5; ?></td>
                  <td><?=$post->unit_cost; ?></td>
                  <td>
                    <span><?=Html::a('<i class="glyphicon glyphicon-edit"></i>Edit',['mgf-input-item/update','id'=>$post->id],['class'=>'label label-primary'])?></span> 
                    <?= Html::a('<i class="glyphicon glyphicon-trash"></i>Delete', ['mgf-input-item/delete', 'id' => $post->id], ['class' => 'label label-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
                  </td>
              </tr>
            </tbody>
            <?php endforeach;?>
            <?php endforeach;?>
            </table>
            <?php }elseif($proposal->project_length==6){ ?>

            <table class="table table-hover">
            <thead>
            <tr>
              <th scope="col">Activvity</th>
              <th scope="col">Input Item</th>
              <th scope="col">Unit of Measure</th>
              <th scope="col">Year 1</th>
              <th scope="col">Year 2</th>
              <th scope="col">Year 3</th>
              <th scope="col">Year 4</th>
              <th scope="col">Year 5</th>
              <th scope="col">Year 6</th>
              <th scope="col">Unit Cost(ZMK)</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($activities as $act):?>
            <?php $items=MgfInputItem::find()->where(['activity_id'=>$act->id])->all();?>

            <?php foreach($items as $post): ?>
              <tr class="table-active">                     
                  <td><?=$post->activity->activity_name; ?></td>
                  <td><?=$post->input_name; ?></td>
                  <td><?=$post->unit_of_measure; ?></td>
                  <td><?=$post->project_year_1; ?></td>
                  <td><?=$post->project_year_2; ?></td>
                  <td><?=$post->project_year_3; ?></td>
                  <td><?=$post->project_year_4; ?></td>
                  <td><?=$post->project_year_5; ?></td>
                  <td><?=$post->project_year_6; ?></td>
                  <td><?=$post->unit_cost; ?></td>
                  <td>
                    <span><?=Html::a('<i class="glyphicon glyphicon-edit"></i>Edit',['mgf-input-item/update','id'=>$post->id],['class'=>'label label-primary'])?></span> 
                    <?= Html::a('<i class="glyphicon glyphicon-trash"></i>Delete', ['mgf-input-item/delete', 'id' => $post->id], ['class' => 'label label-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
                  </td>
              </tr>
            </tbody>
            <?php endforeach;?>
            <?php endforeach;?>
            </table>
            <?php }elseif($proposal->project_length==7){ ?>

            <table class="table table-hover">
            <thead>
            <tr>
              <th scope="col">Activvity</th>
              <th scope="col">Input Item</th>
              <th scope="col">Unit of Measure</th>
              <th scope="col">Year 1</th>
              <th scope="col">Year 2</th>
              <th scope="col">Year 4</th>
              <th scope="col">Year 5</th>
              <th scope="col">Year 6</th>
              <th scope="col">Year 7</th>
              <th scope="col">Year 8</th>
              <th scope="col">Unit Cost(ZMK)</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($activities as $act):?>
            <?php $items=MgfInputItem::find()->where(['activity_id'=>$act->id])->all();?>

            <?php foreach($items as $post): ?>
              <tr class="table-active">                     
                  <td><?=$post->activity->activity_name; ?></td>
                  <td><?=$post->input_name; ?></td>
                  <td><?=$post->unit_of_measure; ?></td>
                  <td><?=$post->project_year_1; ?></td>
                  <td><?=$post->project_year_2; ?></td>
                  <td><?=$post->project_year_3; ?></td>
                  <td><?=$post->project_year_4; ?></td>
                  <td><?=$post->project_year_5; ?></td>
                  <td><?=$post->project_year_6; ?></td>
                  <td><?=$post->project_year_7; ?></td>
                  <td><?=$post->unit_cost; ?></td>
                  <td>
                    <span><?=Html::a('<i class="glyphicon glyphicon-edit"></i>Edit',['mgf-input-item/update','id'=>$post->id],['class'=>'label label-primary'])?></span> 
                    <?= Html::a('<i class="glyphicon glyphicon-trash"></i>Delete', ['mgf-input-item/delete', 'id' => $post->id], ['class' => 'label label-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
                  </td>
              </tr>
            </tbody>
            <?php endforeach;?>
            <?php endforeach;?>
            </table>
        <?php }else{ ?>

            <table class="table table-hover">
          <thead>
          <tr>
              <th scope="col">Activvity</th>
              <th scope="col">Input Item</th>
              <th scope="col">Unit of Measure</th>
              <th scope="col">Year 1</th>
              <th scope="col">Year 2</th>
              <th scope="col">Year 3</th>
              <th scope="col">Year 4</th>
              <th scope="col">Year 5</th>
              <th scope="col">Year 6</th>
              <th scope="col">Year 7</th>
              <th scope="col">Year 8</th>
              <th scope="col">Unit Cost(ZMK)</th>
          </tr>
          </thead>
          <tbody>
          
          <?php foreach($activities as $act):?>
          <?php $items=MgfInputItem::find()->where(['activity_id'=>$act->id])->all();?>

          <?php foreach($items as $post): ?>
              <tr class="table-active">                     
                  <td><?=$post->activity->activity_name; ?></td>
                  <td><?=$post->input_name; ?></td>
                  <td><?=$post->unit_of_measure; ?></td>
                  <td><?=$post->project_year_1; ?></td>
                  <td><?=$post->project_year_2; ?></td>
                  <td><?=$post->project_year_3; ?></td>
                  <td><?=$post->project_year_4; ?></td>
                  <td><?=$post->project_year_5; ?></td>
                  <td><?=$post->project_year_6; ?></td>
                  <td><?=$post->project_year_7; ?></td>
                  <td><?=$post->project_year_8; ?></td>
                  <td><?=$post->unit_cost; ?></td>
                  <td>
                    <span><?=Html::a('<i class="glyphicon glyphicon-edit"></i>Edit',['mgf-input-item/update','id'=>$post->id],['class'=>'label label-primary'])?></span> 
                    <?= Html::a('<i class="glyphicon glyphicon-trash"></i>Delete', ['mgf-input-item/delete', 'id' => $post->id], ['class' => 'label label-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
                  </td>
              </tr>
          </tbody>
          <?php endforeach;?>
          <?php endforeach;?>
        </table>
          <?php } ?>

    </div>
  </div>
  