<?php
use yii\helpers\Html;
use frontend\models\MgfApplicant;
use frontend\models\MgfOrganisation;
use frontend\models\MgfProposal;

$userid=Yii::$app->user->identity->id;
$count=MgfApplicant::find()->where(['user_id'=>$userid])->count();
include("check.php");

?>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active" style="width:25%; color:white; background-color: darkgreen;font-size: 1.2em;"><h4><b>MGF Application Documents</b></h4></a>
        <ul>
        <li>
            <?= Html::a('Application for Participation in the E-SAPP-MGF', ['/mgf-proposal/download'], ['class' => 'btn btn-link']) ?>
        </li>

        <li>
            <?= Html::a('Project Concept Note - Summary Sheet', ['/mgf-proposal/download'], ['class' => 'btn btn-link']) ?>
        </li>

        <li>
            <?= Html::a('MGF – Project Concept Note (Template)', ['/mgf-proposal/download'], ['class' => 'btn btn-link']) ?>
        </li>

        <li>
            <?= Html::a('Project Concept Note Screening Form', ['/mgf-proposal/download'], ['class' => 'btn btn-link']) ?>
        </li>

        <li>
            <?= Html::a('Call for Full Project Proposal', ['/mgf-proposal/download'], ['class' => 'btn btn-link']) ?>
        </li>

    </ul>
</div>
<?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile'], ['class' => 'btn btn-default']) ?>






