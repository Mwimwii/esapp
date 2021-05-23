<?php
use yii\helpers\Html;
use frontend\models\MgfApplicant;
use frontend\models\MgfOrganisation;
use frontend\models\MgfProposal;

$userid=Yii::$app->user->identity->id;
$count=MgfApplicant::find()->where(['user_id'=>$userid])->count();

?>
    <div class="list-group">
    <ul>
<?php if($count>0){?>
    
 
<?php }else{ ?>

    
        <li>
            <?= Html::a('Applicants', ['/mgf-applicant/index'], ['class' => 'btn btn-link']) ?>
        </li>
  

   
        <li>
            <?= Html::a('Organistions', ['/mgf-organisation/index'], ['class' => 'btn btn-link']) ?>
        </li>
   

        <li>
            <?= Html::a('Contact People', ['/mgf-contact/index'], ['class' => 'btn btn-link']) ?>
        </li>

        <li>
            <?= Html::a('MGF Concepte Notes', ['/mgf-concept-note/index'], ['class' => 'btn btn-link']) ?>
        </li>

        <li>
            <?= Html::a('Applications', ['/mgf-application/index','status'=>4], ['class' => 'btn btn-link']) ?>
        </li>

        <li>
            <?= Html::a('MGF Application Screening', ['/mgf-screening/index'], ['class' => 'btn btn-link']) ?>
        </li>


        <li>
            <?= Html::a('MGF Approvals', ['/mgf-approval/index'], ['class' => 'btn btn-link']) ?>
        </li>

        <li>
            <?= Html::a('MGF Proposals', ['/mgf-proposal/index'], ['class' => 'btn btn-link']) ?>
        </li>

        <li>
            <?= Html::a('Project Evaluation', ['/mgf-final-evaluation/index','status'=>0], ['class' => 'btn btn-link']) ?>
        </li>

<?php }?>
    </ul>
</div>





