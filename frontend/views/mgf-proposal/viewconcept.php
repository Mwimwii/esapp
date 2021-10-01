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
$this->title = $model->organisation->cooperative." Concept Note";
$usertype=Yii::$app->user->identity->type_of_user;
\yii\web\YiiAsset::register($this);
?>

<div class="mgf-proposal-view">
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

<?php if($usertype=="Applicant"){ ?>
    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile'],['class' => 'btn btn-default']),
    Html::a('<i class="glyphicon glyphicon-edit"></i> Update', ['update-concept', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
<?php }else{ ?>
    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'],['class' => 'btn btn-default'])?>
<?php } ?>

</div>