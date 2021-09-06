<?php
use yii\helpers\Html;
use frontend\models\MgfProposalEvaluation;
use frontend\models\MgfSelectionGrade;
use frontend\models\MgfSelectionCriteria;
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfFinalEvaluation */
$this->title = $model->organisation->cooperative.": ".$model->proposal->project_title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-final-evaluation-view">
<h2><?= Html::encode($this->title) ?></h2>

<?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index','status'=>0], ['class' => 'btn btn-default']) ?>
<?php if ($model->status==2){ ?>
    <?php Html::a('<i class="glyphicon glyphicon-folder-close"></i>Differe', ['index','status'=>0], ['class' => 'btn btn-success']) ?>
<?php }elseif ($model->status==4){ ?>
    <?php Html::a('<i class="glyphicon glyphicon-folder-close"></i>Differe', ['index','status'=>0], ['class' => 'btn btn-danger']) ?>
<?php }else{ ?>
<?php } ?>

<div class="panel with-nav-tabs panel-primary">
<div class="panel-body">

<?php  $r=1;?>
<?php foreach($reviewers as $rev):?>
    <div style="text-align:center">
        <h3><?=$r.'. Reviewed By:'?><strong><?= $rev->reviewedby0->first_name.' '.$rev->reviewedby0->last_name; ?></strong> <label class="label label-info"> <?= $rev->totalscore.'%';?></label></h3>
    <?php  $r=$r+1; ?>
    </div> 

    <table class="table table-hover">
    <tbody>
        <?php  $i=1;?>
        <?php foreach($categories as $post):?>
            <tr class="table-active">
            <th scope="row"><?=$i.'.';?></th>
            <?php $subtotal=MgfProposalEvaluation::find()->joinWith('criterion')->where(['proposal_id'=>$model->proposal_id,'category_id'=>$post->id,'mgf_proposal_evaluation.createdby'=>$rev->reviewedby])->sum('awardedscore');?>
            <td><strong><?=$post->category;?></strong> <label class="class label-info"> <?php if($subtotal!=NULL){ ?> <?=$subtotal.'%';?><?php } ?> </label>
                    <table class="table table-hover">
                        <tbody>
                            <?php  $ic=1; $criteria=MgfSelectionCriteria::find()->where(['category_id'=>$post->id])->all();?>
                            <?php $ppe=MgfProposalEvaluation::find()->joinWith('criterion')->where(['proposal_id'=>$model->proposal_id,'category_id'=>$post->id,'mgf_proposal_evaluation.createdby'=>$rev->reviewedby])->andWhere(['NOT',['grade'=>NULL]])->all();?>
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
</div>
</div>
</div> 