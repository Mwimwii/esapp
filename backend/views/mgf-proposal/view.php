<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\MgfInputItem;
use frontend\models\MgfInputCost;
use frontend\models\MgfActivity;
use frontend\models\MgfProposalEvaluation;
use frontend\models\MgfSelectionGrade;
use frontend\models\MgfSelectionCriteria;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProposal */
//$activities=MgfActivity::find()->all();
$this->title = $model->organisation->cooperative." Project Proposal";
$usertype=Yii::$app->user->identity->type_of_user;
\yii\web\YiiAsset::register($this);
?>


<div class="card card-success card-outline">
    <div class="card-body">
<h3><?= Html::encode($this->title)?></h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'project_title',
            'mgf_no',
            'organisation.cooperative',
            'proposal_status',
            'totalcost',
            'date_created',
            'starting_date',
            'ending_date',
            'date_submitted',
            'experience_response:ntext',
            'problem_statement:ntext',
            'overall_objective:ntext',
            'province.name',
            'district.name',
        ],
    ])?>
    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['submitted-concept-notes'],['class' => 'btn btn-default'])?>


    <div class="card-body">
<table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Component Name</th>
        </tr>
        </thead>
        <tbody>
          <?php if(count($components)>0): ?>
          <?php  $ic=1; ?>
          <?php foreach($components as $comp):?>
          <tr class="table-active">
            <th scope="row"><?=$ic; ?></th>
            <td><b><?=$comp->component_name; ?></b>: ZMK <?=$comp->subtotal; ?>
                <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Activity Name</th>
                </tr>
                </thead>
                <tbody>
                <?php $activities=MgfActivity::find()->where(['componet_id'=>$comp->id])->all();?>
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
                                <th scope="col">Item Name</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Year 1</th>
                                <th scope="col">Year 2</th>
                                <th scope="col">Year 3</th>
                                <th scope="col">Year 4</th>
                                <th scope="col">Unit Cost(ZMK)</th>   
                                <th scope="col">Date Created</th>
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
                                <td><?=$post->date_created; ?></></td>
                            </tr>
                            <?php  $ii=$ii+1; ?>
                            <?php endforeach; ?>
                                <?php else:?>
                                <tr>
                                    <td>No Input Items Added to <?=$act->activity_name; ?></td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                <?=$act->activity_name; ?>: ZMK <?=$act->subtotal; ?>
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
                </tr>
                <?php  $ia=$ia+1; ?>
                <?php endforeach; ?>
                    <?php else:?>
                    <tr>
                        <td>No Activities added to <?=$comp->component_name; ?></td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            </td>
          </tr>
          <?php  $ic=$ic+1; ?>
          <?php endforeach; ?>
            <?php else:?>
              <tr>
                  <td>No Components created for <?=$model->project_title; ?></td>
              </tr>
            <?php endif; ?>
        </tbody>
      </table>
    </div>
</div>
</div>