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
    <a href="#" class="list-group-item list-group-item-action active" style="width:15%; color:white; background-color: darkgreen;font-size: 1.2em;"><h4><b>MGF</b></h4></a>
    <ul>
<?php if($count>0){?>
    <?php $applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one(); ?>
    <?php if(allowed_to("mgf_view_profile")){?>
        <li>
            <?= Html::a('Profile', ['/mgf-applicant/profile'], ['class' => 'btn btn-link']) ?>
        </li>
    <?php } ?>

    <?php if($applicant->district_id>0){?>  
        <?php if(allowed_to("mgf_view_organisation")){?>
            <li>
                <?= Html::a('Organistions', ['/mgf-organisation/index'], ['class' => 'btn btn-link']) ?>
            </li>
        <?php } ?>

        <?php if($applicant->applicant_type=="Subsistence Farmer"){?>
        <?php }else{ ?>
            <?php if(allowed_to("mgf_view_concept_note")){?>
                <li>
                    <?= Html::a('MGF Concepte Notes', ['/mgf-concept-note/index'], ['class' => 'btn btn-link']) ?>
                </li>
            <?php } ?>

            <?php if(allowed_to("mgf_view_application")){?>
                <li>
                    <?= Html::a('My Applications', ['/mgf-application/index'], ['class' => 'btn btn-link']) ?>
                </li>
            <?php } ?>
        <?php } ?>

        <?php $organisations=MgfOrganisation::find()->where(['id'=>$applicant->organisation_id])->count(); ?>
        <?php //$proposals=MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id])->count(); ?>
        <?php $proposals=MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1])->count();?>

        <?php if($organisations>0){?>
            <?php if(allowed_to("mgf_view_application")){?>
                <li>
                    <?= Html::a('MGF Proposals', ['/mgf-proposal/index'], ['class' => 'btn btn-link']) ?>
                </li>
            <?php } ?>
        <?php } ?>

            <?php if($proposals>0){?>
                <?php if(allowed_to("mgf_view_application")){?>
                    <li>
                        <?= Html::a('Proposal Components', ['/mgf-component/index'], ['class' => 'btn btn-link']) ?>
                    </li>
                <?php } ?>
            <?php } ?>
    <?php } ?>
 

<?php }else{ ?>


    <?php if(allowed_to("mgf_view_profile")){?>
        <li>
            <?= Html::a('Profile', ['/mgf-applicant/profile'], ['class' => 'btn btn-link']) ?>
        </li>
    <?php } ?>

    <?php if(allowed_to("mgf_view_applicants")){?>
        <li>
            <?= Html::a('Applicants', ['/mgf-applicant/index'], ['class' => 'btn btn-link']) ?>
        </li>
    <?php } ?>

    <?php if(allowed_to("mgf_view_organisation")){?>
        <li>
            <?= Html::a('Organistions', ['/mgf-organisation/index'], ['class' => 'btn btn-link']) ?>
        </li>
    <?php } ?>

    <?php if(allowed_to("mgf_view_organisation")){?>
        <li>
            <?= Html::a('Contact People', ['/mgf-contact/index'], ['class' => 'btn btn-link']) ?>
        </li>
    <?php } ?>

    <?php if(allowed_to("mgf_view_concept_note")){?>
        <li>
            <?= Html::a('MGF Concepte Notes', ['/mgf-concept-note/index'], ['class' => 'btn btn-link']) ?>
        </li>
    <?php } ?>

    <?php if(allowed_to("mgf_view_application")){?>
        <li>
            <?= Html::a('All Applications', ['/mgf-application/index'], ['class' => 'btn btn-link']) ?>
        </li>
    <?php } ?>

    <?php if(allowed_to("mgf_view_application")){?>
        <li>
            <?= Html::a('Submitted Applications', ['/mgf-organisation/applications'], ['class' => 'btn btn-link']) ?>
        </li>
    <?php } ?>

    <?php if(allowed_to("mgf_view_concept_note")){?>
        <li>
            <?= Html::a('MGF Application Screening', ['/mgf-screening/index'], ['class' => 'btn btn-link']) ?>
        </li>
    <?php } ?>

    <?php if(allowed_to("mgf_view_application")){?>
        <li>
            <?= Html::a('MGF Proposals', ['/mgf-proposal/index'], ['class' => 'btn btn-link']) ?>
        </li>
    <?php } ?>

    <?php if(allowed_to("mgf_view_application")){?>
        <li>
            <?= Html::a('Project Evaluation', ['/mgf-final-evaluation/index','status'=>0], ['class' => 'btn btn-link']) ?>
        </li>
    <?php } ?>

<?php }?>
    </ul>
</div>





