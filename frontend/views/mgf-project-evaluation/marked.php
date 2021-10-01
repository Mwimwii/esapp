<?php

use frontend\models\MgfProjectEvaluation;
use yii\helpers\Html;
use frontend\models\MgfProposalEvaluation;
use frontend\models\MgfSelectionGrade;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProposal */
//$activities=MgfActivity::find()->all();
$this->title = $model->organisation->cooperative.": ".$model->project_title;
\yii\web\YiiAsset::register($this);
?>
<?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'],['class' => 'btn btn-default'])?>
<h2><?= Html::encode($this->title) ?></h2>
<?php include('proposaltab.php');?>
    <strong>TOTAL SCORE</strong>
    <div class="progress">
        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $project->totalscore.'%'; ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">(<?= $project->totalscore.'%'; ?>)</div>
    </div>    

<table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Criterion</th> 
        <?php if($project->status==0){?>
        <th scope="col">Action &nbsp;&nbsp;&nbsp;&nbsp;<?php if ($unmarked==0) {
            echo Html::button('<i class="glyphicon glyphicon-plus"></i>Finalize', [ 'class' => 'btn btn-success', 'onclick' => '$(\'#finalize\').modal();']);

        }?> </th> 
        <?php }?>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; $ppe=MgfProposalEvaluation::find()->joinWith('criterion')->where(['proposal_id'=>$model->id,'mgf_proposal_evaluation.createdby'=>$userid])->andWhere(['NOT',['grade'=>NULL]])->orderBy(['comment' => SORT_ASC,'criterion_id'=>SORT_ASC])->all();?>
        <?php foreach($ppe as $post):?>
            <tr class="table-active">
                <th scope="row"><?=$i.'.';?></th>
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
                <?php if($project->status==0){?>
                <td style="width:15%">
                    <?php if($post->grade!=NULL){ ?>
                        <?php $form = ActiveForm::begin(['method' => 'GET','action' => Url::to(['mgf-project-evaluation/addcomment', 'ppe' =>$post->id,'proposal'=>$model->id])]); ?>
                        <input type="text" name="comment" class="form-control" placeholder="Add Comment" required/>
                        <?= Html::a('<i class="glyphicon glyphicon-refresh"></i>Reset', ['mgf-project-evaluation/resetgrade', 'ppe' =>$post->id,'proposal'=>$model->id], ['class' => 'btn btn-link']);?>        
                        <?= Html::submitButton('<i class="glyphicon glyphicon-comment"></i>Save', ['class' => 'label label-primary']) ?>
                    <?php ActiveForm::end(); ?>
                    <?php } ?>
                </td>
                <?php } ?>
            </tr>
        <?php  $i=$i+1; ?>
        <?php endforeach; ?>
    </tbody>
</table>


<div class="modal fade" id="finalize">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <?php $model = MgfProjectEvaluation::findOne($_GET['id']);?>
                <h3 class="modal-title"><?='Finalize MGF Grading ('.$model->totalscore.'%)'?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-project-evaluation/finalize&id='.$model->id]) ?>
                
                <?= $form->field($model, 'window')->dropDownList([ '1' => 'Window 1', '2' => 'Window 2', ], ['disabled' => true]) ?>

                <?= $form->field($model, 'observation')->textarea(['rows' => 4,'required'=>true]) ?>

                <?= $form->field($model, 'declaration')->textarea(['rows' => 4,'required'=>true]) ?>

                <?= $form->field($model, 'signature')->textarea(['rows' => 4,'required'=>true]) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>