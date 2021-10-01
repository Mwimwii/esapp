<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\MgfProposalEvaluation;
use frontend\models\MgfSelectionGrade;
use frontend\models\MgfSelectionCriteria;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProposal */
//$activities=MgfActivity::find()->all();
$this->title = 'UNMARKED';
\yii\web\YiiAsset::register($this);
?>
<?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'],['class' => 'btn btn-default'])?>
<h2><?= Html::encode($model->organisation->cooperative.": ".$model->project_title) ?></h2>
<?php include('proposaltab.php');?>
<div>
    <strong>TOTAL SCORE</strong>
    <div class="progress">
        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $project->totalscore.'%'; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">(<?= $project->totalscore.'%'; ?>)</div>
    </div>    

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Evaluation Criteria</th> 
        </tr>
    </thead>
    <tbody>
        <?php  $i=1; ?>
        <?php foreach($categories as $post):?>
            <tr class="table-active">
            <th scope="row"><?=$i.'.';?></th>
            <?php $subtotal=MgfProposalEvaluation::find()->joinWith('criterion')->where(['proposal_id'=>$model->id,'category_id'=>$post->id,'mgf_proposal_evaluation.createdby'=>$userid])->sum('awardedscore');?>
            <?php $count=MgfProposalEvaluation::find()->joinWith('criterion')->where(['proposal_id'=>$model->id,'category_id'=>$post->id,'mgf_proposal_evaluation.createdby'=>$userid,'grade'=>NULL])->count();?>
        <td><strong><?=$post->category;?></strong> <label class="class label-info"> <?php if($subtotal!=NULL){ ?> <?=$subtotal.'%';?><?php } ?> </label>
                <?php if($count>0){ ?>
                    <table class="table table-hover">
                        <tbody>
                            <?php  $ic=1; $criteria=MgfSelectionCriteria::find()->where(['category_id'=>$post->id])->all();?>
                            <?php $ppe=MgfProposalEvaluation::find()->joinWith('criterion')->where(['proposal_id'=>$model->id,'category_id'=>$post->id,'mgf_proposal_evaluation.createdby'=>$userid,'grade'=>NULL])->all();?>
                            <?php foreach($ppe as $post):?>
                            <tr class="table-active">
                                <th scope="row"><?=$ic.'.';?></th>
                                <?php $grades=MgfSelectionGrade::find()->where(['criterion_id'=>$post->criterion_id])->all();?>
                                <td><?=$post->criterion->criterion; ?>
                                    <ul class="nav nav-tabs">
                                        <?php foreach($grades as $grd):?>
                                            <li>
                                                <?php if($post->grade==$grd->grade){ ?>
                                                    <label class="btn btn-success btn-sm"><?=$grd->grade;?><i class="glyphicon glyphicon-ok"></i></label>
                                                <?php }else{ ?>
                                                    <?php if($post->comment==NULL){ ?>
                                                        <?= Html::a($grd->grade, ['mgf-project-evaluation/grading', 'ppe' =>$post->id,'awardedscore' =>$grd->awardedscore,'grade' =>$grd->grade,'proposal'=>$model->id], ['class' => 'btn btn-link']);?>
                                                    <?php } ?>
                                                <?php } ?> 
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>                               
                                </td>
                            </tr>
                            <?php  $ic=$ic+1; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </td>
            </tr>
        <?php  $i=$i+1; ?>
        <?php endforeach; ?>
    </tbody>
</table>
</div>