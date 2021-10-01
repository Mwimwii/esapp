<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\MgfInputItem;
use frontend\models\MgfInputCost;
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfComponent */
$this->title = $model->component_name;
?>
<div class="mgf-component-view">
<h1><?='Manage '.Html::encode($this->title) ?></h1>
<?php include('comptab.php');?>
<h3><?='Cost: ZMK '.Html::encode($model->subtotal) ?></h3>
    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['components'],['class' => 'btn btn-default'])?>
<div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Activity Name</th>
            <th scope="col"><span><?=Html::a('<i class="glyphicon glyphicon-plus"></i>New Activity',['mgf-activity/create','id'=>$model->id],['class'=>'btn btn-success btn-sm'])?></th>
        </tr>
        </thead>
        <tbody>
          <?php if(count($activities)>0): ?>
          <?php  $ia=1; ?>
          <?php foreach($activities as $act):?>
          <tr class="table-active">
            <th scope="row"><?=$ia; ?></th>
            <td><?=$act->activity_name; ?>: Quantity of Required Inputs
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Input Item</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Year 1</th>
                        <th scope="col">Year 2</th>
                        <th scope="col">Year 3</th>
                        <th scope="col">Year 4</th>
                        <th scope="col">Unit Cost(ZMK)</th>
                        <th scope="col"><span><?=Html::a('<i class="glyphicon glyphicon-plus"></i>New Item',['mgf-input-item/create','id'=>$act->id],['class'=>'btn btn-success btn-sm'])?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $items=MgfInputItem::find()->where(['activity_id'=>$act->id])->all();?>

                    <?php if(count($items)>0): ?>
                    <?php  $ii=1; ?>
                    <?php foreach($items as $post):?>
                        <tr class="table-active">
                        <th scope="row"><?=$ii; ?></th>
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
                    <?php  $ii=$ii+1; ?>
                    <?php endforeach; ?>
                        <?php else:?>
                        <tr>
                            <td>No Input Items Added <?=$act->activity_name; ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <?=$act->activity_name; ?>: <b>ZMK<div class="label label-info"><?=$act->subtotal; ?></div></b>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Input Item</th>
                        <th scope="col">Year 1</th>
                        <th scope="col">Year 2</th>
                        <th scope="col">Year 3</th>
                        <th scope="col">Year 4</th>
                        <th scope="col">Total Cost(ZMK)</th>
                        <th scope="col">Comment</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $costs=MgfInputCost::find()->where(['activity_id'=>$act->id])->all();?>
                    <?php  $i=1; ?>
                    <?php foreach($costs as $post):?>
                    <tr class="table-active">
                        <th scope="row"><?=$i; ?></th>
                        <td><?=$post->input_name; ?></td>
                        <td><?=$post->project_year_1; ?></td>
                        <td><?=$post->project_year_2; ?></td>
                        <td><?=$post->project_year_3; ?></td>
                        <td><?=$post->project_year_4; ?></td>
                        <td><?=$post->total_cost; ?></td>
                        <td><?=$post->comment; ?></td>
                    </tr>
                    <?php  $i=$i+1; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </td>
            
            <td>
              <span><?=Html::a('<i class="glyphicon glyphicon-edit"></i>Edit',['mgf-activity/update','id'=>$act->id],['class'=>'label label-primary'])?></span> 
              <?php if(count($items)==0): ?>
                <?= Html::a('<i class="glyphicon glyphicon-trash"></i>Delete', ['mgf-activity/delete', 'id' => $act->id], ['class' => 'label label-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
              <?php endif; ?>
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
  </div>
