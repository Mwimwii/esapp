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
\yii\web\YiiAsset::register($this);
?>
<h1><?= Html::encode($this->title) ?></h1>
    
<div class="mgf-proposal-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'project_title',
            'mgf_no',
            'organisation.cooperative',
            'proposal_status',
            'totalcost',
            'date_created',
            'date_submitted',
            'project_background:ntext',
            'problem_statement:ntext',
            'overall_objective:ntext',
            'summary_description:ntext',
            'province.name',
            'district.name',
        ],
    ]) ?>

<?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'],['class' => 'btn btn-default'])?>

<div class="panel with-nav-tabs panel-primary">
<div class="panel-body">
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

<?php if($count>0):?>
<?php foreach($reviewers as $rev):?>
<div class="btn btn-default">
Reviewed By: <strong><?=  $rev->reviewedby0->first_name.' '.$rev->reviewedby0->last_name; ?></strong> <label class="label label-info"> <?= $rev->totalscore.'%';?></label>
</div> 

<table class="table table-hover">
<tbody>
    <?php  $i=1;?>
    <?php foreach($categories as $post):?>
        <tr class="table-active">
        <th scope="row"><?=$i.'.';?></th>
        <?php $subtotal=MgfProposalEvaluation::find()->joinWith('criterion')->where(['proposal_id'=>$model->id,'category_id'=>$post->id,'mgf_proposal_evaluation.createdby'=>$rev->reviewedby])->sum('awardedscore');?>
        <td><strong><?=$post->category;?></strong> <label class="class label-info"> <?php if($subtotal!=NULL){ ?> <?=$subtotal.'%';?><?php } ?> </label>
                <table class="table table-hover">
                    <tbody>
                        <?php  $ic=1; $criteria=MgfSelectionCriteria::find()->where(['category_id'=>$post->id])->all();?>
                        <?php $ppe=MgfProposalEvaluation::find()->joinWith('criterion')->where(['proposal_id'=>$model->id,'category_id'=>$post->id,'mgf_proposal_evaluation.createdby'=>$rev->reviewedby])->andWhere(['NOT',['grade'=>NULL]])->all();?>
                        <?php foreach($ppe as $post):?>
                        <tr class="table-active">
                            <th scope="row"><?=$ic.'.';?></th>
                            <?php $grades=MgfSelectionGrade::find()->where(['criterion_id'=>$post->criterion_id])->all();?>
                            <td><?=$post->criterion->criterion; ?>
                            <label type="button" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title=<?=$post->awardedscore.'%score'?>>
                                <?=$post->grade;?><i class="glyphicon glyphicon-ok"></i>
                            </label>
                            <p><strong>Comment:</strong>
                                <?php if($post->grade!=NULL){ ?>
                                    <?php if($post->comment!=NULL){ ?>
                                        <?=$post->comment; ?>
                                    <?php }else{ ?>
                                        <label class="label label-warning">None</label>
                                    <?php } ?>
                                <?php } ?>
                            </p>
                            </td>
                        </tr>
                        <?php  $ic=$ic+1; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </td>
        </tr>
    <?php  $i=$i+1; ?>
    <?php endforeach; ?>
</tbody>
</table>
<?php endforeach; ?>
<?php endif;?>
</div>
</div>
</div>
