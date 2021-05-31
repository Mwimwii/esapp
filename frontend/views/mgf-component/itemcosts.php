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
<h2><?='Manage '.Html::encode($this->title) ?><?=': Cost = ZMW '.Html::encode($model->subtotal) ?></h2>
    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['components'],['class' => 'btn btn-default'])?>
    <?php include('comptab.php');?>
    <div class="card-body">  
        <?php if($proposal->project_length==1){ ?>
          <table class="table table-hover">
              <thead>
                <tr>
                    <th scope="col">Activity</th>
                    <th scope="col">Input Item</th>
                    <th scope="col">Year 1</th>
                    <th scope="col">Total Cost(ZMK)</th>
                    <th scope="col">Comment</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($activities as $act):?>
                <?php $costs=MgfInputCost::find()->where(['activity_id'=>$act->id])->all();?>
                <?php foreach($costs as $post):?>
                <tr class="table-active">
                    <td><?=$post->input_name; ?></td>
                    <td><?=$post->activity->activity_name; ?></td>
                    <td><?=$post->project_year_1; ?></td>                  
                    <td><?=$post->total_cost; ?></td>
                    <td><?=$post->comment; ?></td>
                </tr>                
              </tbody>
              <?php endforeach; ?>
              <?php endforeach; ?>
          </table>
          <?php }elseif($proposal->project_length==2){ ?>
            <table class="table table-hover">
              <thead>
                <tr>
                    <th scope="col">Activity</th>
                    <th scope="col">Input Item</th>
                    <th scope="col">Year 1</th>
                    <th scope="col">Year 2</th>
                    <th scope="col">Total Cost(ZMK)</th>
                    <th scope="col">Comment</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($activities as $act):?>
                <?php $costs=MgfInputCost::find()->where(['activity_id'=>$act->id])->all();?>
                <?php foreach($costs as $post):?>
                <tr class="table-active">
                    <td><?=$post->input_name; ?></td>
                    <td><?=$post->activity->activity_name; ?></td>
                    <td><?=$post->project_year_1; ?></td>
                    <td><?=$post->project_year_2; ?></td>
                    <td><?=$post->total_cost; ?></td>
                    <td><?=$post->comment; ?></td>
                </tr>                
              </tbody>
              <?php endforeach; ?>
              <?php endforeach; ?>
          </table>
          <?php }elseif($proposal->project_length==3){ ?>
            <table class="table table-hover">
              <thead>
                <tr>
                    <th scope="col">Activity</th>
                    <th scope="col">Input Item</th>
                    <th scope="col">Year 1</th>
                    <th scope="col">Year 2</th>
                    <th scope="col">Year 3</th>
                    <th scope="col">Total Cost(ZMK)</th>
                    <th scope="col">Comment</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($activities as $act):?>
                <?php $costs=MgfInputCost::find()->where(['activity_id'=>$act->id])->all();?>
                <?php foreach($costs as $post):?>
                <tr class="table-active">
                    <td><?=$post->input_name; ?></td>
                    <td><?=$post->activity->activity_name; ?></td>
                    <td><?=$post->project_year_1; ?></td>
                    <td><?=$post->project_year_2; ?></td>
                    <td><?=$post->project_year_3; ?></td>
                    <td><?=$post->total_cost; ?></td>
                    <td><?=$post->comment; ?></td>
                </tr>                
              </tbody>
              <?php endforeach; ?>
              <?php endforeach; ?>
          </table>
          <?php }elseif($proposal->project_length==4){ ?>
            <table class="table table-hover">
              <thead>
                <tr>
                    <th scope="col">Activity</th>
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
              <?php foreach($activities as $act):?>
                <?php $costs=MgfInputCost::find()->where(['activity_id'=>$act->id])->all();?>
                <?php foreach($costs as $post):?>
                <tr class="table-active">
                    <td><?=$post->input_name; ?></td>
                    <td><?=$post->activity->activity_name; ?></td>
                    <td><?=$post->project_year_1; ?></td>
                    <td><?=$post->project_year_2; ?></td>
                    <td><?=$post->project_year_3; ?></td>
                    <td><?=$post->project_year_4; ?></td>
                    <td><?=$post->total_cost; ?></td>
                    <td><?=$post->comment; ?></td>
                </tr>                
              </tbody>
              <?php endforeach; ?>
              <?php endforeach; ?>
          </table>
          <?php }elseif($proposal->project_length==5){ ?>
            <table class="table table-hover">
              <thead>
                <tr>
                    <th scope="col">Activity</th>
                    <th scope="col">Input Item</th>
                    <th scope="col">Year 1</th>
                    <th scope="col">Year 2</th>
                    <th scope="col">Year 3</th>
                    <th scope="col">Year 4</th>
                    <th scope="col">Year 5</th>
                    <th scope="col">Total Cost(ZMK)</th>
                    <th scope="col">Comment</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($activities as $act):?>
                <?php $costs=MgfInputCost::find()->where(['activity_id'=>$act->id])->all();?>
                <?php foreach($costs as $post):?>
                <tr class="table-active">
                    <td><?=$post->input_name; ?></td>
                    <td><?=$post->activity->activity_name; ?></td>
                    <td><?=$post->project_year_1; ?></td>
                    <td><?=$post->project_year_2; ?></td>
                    <td><?=$post->project_year_3; ?></td>
                    <td><?=$post->project_year_4; ?></td>
                    <td><?=$post->project_year_5; ?></td>
                    <td><?=$post->total_cost; ?></td>
                    <td><?=$post->comment; ?></td>
                </tr>                
              </tbody>
              <?php endforeach; ?>
              <?php endforeach; ?>
          </table>
          <?php }elseif($proposal->project_length==6){ ?>
            <table class="table table-hover">
              <thead>
                <tr>
                    <th scope="col">Activity</th>
                    <th scope="col">Input Item</th>
                    <th scope="col">Year 1</th>
                    <th scope="col">Year 2</th>
                    <th scope="col">Year 3</th>
                    <th scope="col">Year 4</th>
                    <th scope="col">Year 5</th>
                    <th scope="col">Year 6</th>
                    <th scope="col">Total Cost(ZMK)</th>
                    <th scope="col">Comment</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($activities as $act):?>
                <?php $costs=MgfInputCost::find()->where(['activity_id'=>$act->id])->all();?>
                <?php foreach($costs as $post):?>
                <tr class="table-active">
                    <td><?=$post->input_name; ?></td>
                    <td><?=$post->activity->activity_name; ?></td>
                    <td><?=$post->project_year_1; ?></td>
                    <td><?=$post->project_year_2; ?></td>
                    <td><?=$post->project_year_3; ?></td>
                    <td><?=$post->project_year_4; ?></td>
                    <td><?=$post->project_year_5; ?></td>
                    <td><?=$post->project_year_6; ?></td>
                    <td><?=$post->total_cost; ?></td>
                    <td><?=$post->comment; ?></td>
                </tr>                
              </tbody>
              <?php endforeach; ?>
              <?php endforeach; ?>
          </table>
          <?php }elseif($proposal->project_length==7){ ?>
            <table class="table table-hover">
              <thead>
                <tr>
                    <th scope="col">Activity</th>
                    <th scope="col">Input Item</th>
                    <th scope="col">Year 1</th>
                    <th scope="col">Year 2</th>
                    <th scope="col">Year 3</th>
                    <th scope="col">Year 4</th>
                    <th scope="col">Year 5</th>
                    <th scope="col">Year 6</th>
                    <th scope="col">Year 7</th>
                    <th scope="col">Total Cost(ZMK)</th>
                    <th scope="col">Comment</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($activities as $act):?>
                <?php $costs=MgfInputCost::find()->where(['activity_id'=>$act->id])->all();?>
                <?php foreach($costs as $post):?>
                <tr class="table-active">
                    <td><?=$post->input_name; ?></td>
                    <td><?=$post->activity->activity_name; ?></td>
                    <td><?=$post->project_year_1; ?></td>
                    <td><?=$post->project_year_2; ?></td>
                    <td><?=$post->project_year_3; ?></td>
                    <td><?=$post->project_year_4; ?></td>
                    <td><?=$post->project_year_5; ?></td>
                    <td><?=$post->project_year_6; ?></td>
                    <td><?=$post->project_year_7; ?></td>
                    <td><?=$post->total_cost; ?></td>
                    <td><?=$post->comment; ?></td>
                </tr>                
              </tbody>
              <?php endforeach; ?>
              <?php endforeach; ?>
          </table>
          <?php }else{ ?>
            <table class="table table-hover">
              <thead>
                <tr>
                    <th scope="col">Activity</th>
                    <th scope="col">Input Item</th>
                    <th scope="col">Year 1</th>
                    <th scope="col">Year 2</th>
                    <th scope="col">Year 3</th>
                    <th scope="col">Year 4</th>
                    <th scope="col">Year 5</th>
                    <th scope="col">Year 6</th>
                    <th scope="col">Year 7</th>
                    <th scope="col">Year 8</th>
                    <th scope="col">Total Cost(ZMK)</th>
                    <th scope="col">Comment</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($activities as $act):?>
                <?php $costs=MgfInputCost::find()->where(['activity_id'=>$act->id])->all();?>
                <?php foreach($costs as $post):?>
                <tr class="table-active">
                    <td><?=$post->input_name; ?></td>
                    <td><?=$post->activity->activity_name; ?></td>
                    <td><?=$post->project_year_1; ?></td>
                    <td><?=$post->project_year_2; ?></td>
                    <td><?=$post->project_year_3; ?></td>
                    <td><?=$post->project_year_4; ?></td>
                    <td><?=$post->project_year_5; ?></td>
                    <td><?=$post->project_year_6; ?></td>
                    <td><?=$post->project_year_7; ?></td>
                    <td><?=$post->project_year_8; ?></td>
                    <td><?=$post->total_cost; ?></td>
                    <td><?=$post->comment; ?></td>
                </tr>                
              </tbody>
              <?php endforeach; ?>
              <?php endforeach; ?>
          </table>
          <?php }?>
    </div>
  </div>
  