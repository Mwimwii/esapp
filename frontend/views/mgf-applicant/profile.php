<?php

use backend\models\MgfContact;
use backend\models\MgfWindow;
use backend\models\MgfYear;
use frontend\models\MgfChecklist;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use frontend\models\MgfOrganisation;
use frontend\models\MgfProposal;
use frontend\models\MgfApplicant;
use frontend\models\MgfApplication;
use frontend\models\MgfAttachements;
use frontend\models\MgfComponent;
use frontend\models\MgfExperience;
use kartik\widgets\DatePicker;
use frontend\models\MgfConceptNote;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\MgfOperation;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfApplicantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = ' E-SAPP - Matching Grant Facility (MGF)';
$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::findOne(['user_id'=>$userid]);
$checlist=MgfChecklist::findOne(['applicant_id'=>$applicant->id]);
if($applicant->applicant_type=="Category-A"){
    $window=1;
}else{
    $window=2;
}

$year=MgfYear::findOne(['is_active'=>1]);
$mgfWindow=MgfWindow::findOne(['window'=>$window,'year_id'=>$year->id]);

$deadline = new DateTime($mgfWindow->closing_date);
$later=date("Y-m-d");
$today = new DateTime($later);
$days_remaining = $today->diff($deadline)->format("%r%a");

if($days_remaining>0){

    if ($checlist->organisation_created==1) {
        if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1])->exists()) {
            $application=MgfApplication::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
            $attachement = MgfAttachements::find()->where(['application_id'=>$application->id])->one();

            if (MgfContact::find()->where(['organisation_id'=>$applicant->organisation_id])->count()==2) {
                MgfChecklist::updateAll(['contacts_added'=>1], 'applicant_id='.$applicant->id);
            }
        } else {
            $application=new MgfApplication();
            $application->organisation_id=$applicant->organisation_id;
            $application->applicant_id=$applicant->id;
            $application->is_active=1;
            $application->save();
            $application=MgfApplication::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
            $attachement = MgfAttachements::findOne(['application_id'=>$application->id]);
        }

        MgfApplication::updateAll(['is_active' => 0], 'organisation_id='.$applicant->organisation_id);
        MgfApplication::updateAll(['is_active' => 1], 'id='.$application->id);
    
        if (!MgfExperience::find()->where(['organisation_id'=>$applicant->organisation_id])->exists()) {
            $experience=new MgfExperience();
            $experience->organisation_id=$applicant->organisation_id;
            $experience->save();
        }
        $experience=MgfExperience::find()->where(['organisation_id'=>$applicant->organisation_id])->one();
    }
    
}

?>

<?php if($days_remaining>0){ ?>

    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Submitted'])->exists()) { ?>
        <div role="alert" style="text-align: center;border-style: outset;">
            <hr><p style="font-weight: bold; color:blue">Your Application has been Submitted to the District for Review</p><hr>
        </div>
    <?php }?>

    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Under_Review'])->exists()) { ?>
        <div role="alert" style="text-align: center;border-style: outset;">
            <hr><p style="font-weight: bold; color:blue">Your Application is Under Review at District Level</p><hr>
        </div>
    <?php }?>

    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Compliant'])->exists()) { ?>
        <div role="alert" style="text-align: center;border-style: outset;">
            <hr><p style="font-weight: bold; color:blue">Your Application is Under Review at Provincial Level</p><hr>
        </div>
        
    <?php }?>

    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Non-Compliant'])->exists()) { ?>
        <div role="alert" style="text-align: center;border-style: outset;">
            <hr><p style="font-weight: bold; color:red">Your Application is Under Review at Provincial Level</p><hr>
        </div>
    <?php }?>

    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Confirmed'])->exists()) { ?>
        <div role="alert" style="text-align: center;border-style: outset;">
            <hr><p style="font-weight: bold; color:blue">Your Application is Under Review at National Level</p><hr>
        </div>
    <?php }?>

    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Not-Confirmed'])->exists()) { ?>
        <div role="alert" style="text-align: center;border-style: outset;">
            <hr><p style="font-weight: bold; color:red">Your Application is Under Review at National Level</p><hr>
        </div>
    <?php }?>


    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Approved'])->exists()) { ?>
        <div role="alert" style="text-align: center;border-style: outset;">
            <hr><p style="font-weight: bold; color:blue">Your Application is Has been Approved at National Level</p><hr>
        </div>
    <?php }?>

    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Not-Approved'])->exists()) { ?>
        <div role="alert" style="text-align: center;border-style: outset;">
            <hr><p style="font-weight: bold; color:red">Your Application has been Rejected at National Level</p><hr>
        </div>
    <?php }?>

    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Sent-Back'])->exists()) { ?>
        <div role="alert" style="text-align: center;border-style: outset;">
            <hr><p style="font-weight: bold; color:red">Your Application has been Sent Back to the District for further Review</p><hr>
        </div>
    <?php }?>


    <?php if(MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id, 'is_active'=>1])->exists()) { ?>
        <?php $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id, 'is_active'=>1]);?>
        <div role="alert" style="text-align: center;border-style: outset;">
            <hr><p style="font-weight: bold; color:green">Project Proposal Status: <?= $proposal->proposal_status;?></p><hr>
        </div>
    <?php }?>


<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h3><?= Html::encode($this->title) ?></h3>
        <hr>
    </div>

    <div class="col-md-3">
    
    </div>
</div>

<div class="row">
    <div class="col-md-3">
    <?php if($mgfWindow->is_active){ ?>
    <?= Html::a('<i class="fa fa-home"></i> Home', ['/mgf-applicant/profile'], ['class' => 'btn btn-link']) ?><br/>
        <div id="accordionOrg">
            <div class="card">
                <div clas s="card-header" id="headingOrganisation">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOrg" aria-expanded="true" aria-controls="collapseOrg">
                            <i class="fa fa-thumb-tack"></i> Background of Applicant
                        </button>
                    </h5>
                </div>
                <div id="collapseOrg" class="collapse" aria-labelledby="collapseOrg" data-parent="#accordionOrg">
                    <div class="row">
                        <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <div class="card-body">
                                    <?php if (MgfOrganisation::find()->where(['applicant_id'=>$applicant->id])->exists()) { ?>
                                        <?php $usertype=Yii::$app->user->identity->type_of_user;?>
                                        <?= Html::a('Organisation', ['/mgf-organisation/view','id'=>$applicant->organisation_id], ['class' => 'btn btn-link']) ?><br/>
                                        <?= Html::a('Business_Management', ['/mgf-organisational-detail/create'], ['class' => 'btn btn-link']) ?><br/>
                                        <?= Html::a('Previous_Experience', ['/mgf-experience/view','id'=>$experience->id,'status'=>0], ['class' => 'btn btn-link']) ?><br/>
                                        <?= Html::a('Attachments', ['/mgf-attachements/attachements','id'=>$attachement->id], ['class' => 'btn btn-link']) ?><br/>
                                        <?= Html::a('Confirmation', ['/mgf-applicant/confirm','id'=>$applicant->id], ['class' => 'btn btn-link']) ?><br/>
                                    <?php } else { ?>
                                        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Profile of the Organisation', ['/mgf-organisation/create'], ['class' => 'btn btn-link']) ?> <br/>
                                    <?php }?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
         
        <?php if ($window==2) { ?>


        <div id="accordionCN">
            <div class="card">
                <div class="card-header" id="headingOrganisation">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseCN" aria-expanded="false" aria-controls="collapseCN">
                            <i class="glyphicon glyphicon-copyright-mark"></i> Application for Participation
                        </button>
                    </h5>
                </div>
                <div id="collapseCN" class="collapse" aria-labelledby="collapseCN" data-parent="#accordionCN">
                    <div class="row">
                        <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <div class="card-body">
    
                                    <!--CONCEPT NOTE-->

                                    <?php if($applicant->confirmed==1){ ?>
                                    <?php if (MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'is_concept'=>1, 'is_active'=>1])->exists()) { ?>
                                        <?php $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_concept'=>1, 'is_active'=>1]);?>
                                            <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Concept_Note_Details', ['/mgf-proposal/view-concept','id'=>$proposal->id], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Concept_Description', ['/mgf-component/components',], ['class' => 'btn btn-link']) ?> <br/>
                                            <!--<?= Html::a('<i class="glyphicon glyphicon-pushpin"></i> Concept_Activites', ['/mgf-activity/activities',], ['class' => 'btn btn-link']) ?> <br/>-->
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Existing_Facilities', ['/mgf-existing-facilities/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Expected_Outputs_GrossRevenue', ['/mgf-expected-outputs-and-gross-revenue/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Implementation_Arrangement', ['/mgf-implementation-arrangements-cooperating-partners/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Product_Marketing', ['/mgf-product-market-marketing1/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Profit_Loss', ['/mgf-value-of-product/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Environmental_Consideration', ['/mgf-environmental-consideration/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Project_Risks', ['/mgf-project-risks-and-mitigation-measures/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Sustainability_Scalability', ['/mgf-sustainability-scalability/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Implementation_Schedule', ['/mgf-implementation-schedule/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>BP_Indicators', ['/mgf-business-perfomance-indicator/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('Declaration', ['/mgf-applicant/declaration','id'=>$applicant->id], ['class' => 'btn btn-link']) ?><br/>
                                        <?php } else {?>
                                            <?= Html::a('<i class="fa fa-plus1"></i>MGF_Project_Concept_Note', ['/mgf-proposal/create-concept'], ['class' => 'btn btn-link']) ?>
                                    <?php }?>
                                <?php }?>

                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    
        <?php } ?>

        <div id="accordionProj">
            <div class="card">
                <div class="card-header" id="headingProj">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseProj" aria-expanded="false" aria-controls="collapseProj">
                            <i class="glyphicon glyphicon-tower"></i> Full Project Proposal
                        </button>
                    </h5>
                </div>
                <div id="collapseProj" class="collapse" aria-labelledby="collapseProj" data-parent="#accordionProj">
                <div class="row">
                    <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <?php if($applicant->confirmed==1){ ?>
                                    <?php if (MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'is_concept'=>0, 'is_active'=>1])->exists()) { ?>
                                        <?php $proposal=MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'is_concept'=>0, 'is_active'=>1])->one();?>
                                            <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Project_Details', ['/mgf-proposal/view','id'=>$proposal->id], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Project_Description', ['/mgf-component/components',], ['class' => 'btn btn-link']) ?> <br/>
                                            <!--<?= Html::a('<i class="glyphicon glyphicon-pushpin"></i> Project_Activites', ['/mgf-activity/activities',], ['class' => 'btn btn-link']) ?> <br/>-->
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Existing_Facilities', ['/mgf-existing-facilities/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Expected_Outputs_GrossRevenue', ['/mgf-expected-outputs-and-gross-revenue/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Implementation_Arrangement', ['/mgf-implementation-arrangements-cooperating-partners/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Product_Marketing', ['/mgf-product-market-marketing/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Profit_Loss', ['/mgf-value-of-product/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Environmental_Consideration', ['/mgf-environmental-consideration/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Project_Risks', ['/mgf-project-risks-and-mitigation-measures/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Sustainability_Scalability', ['/mgf-sustainability-scalability/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>Implementation_Schedule', ['/mgf-implementation-schedule/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="fa fa-pushpin"></i>BP_Indicators', ['/mgf-business-perfomance-indicator/index',], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('Declaration', ['/mgf-applicant/declaration2','id'=>$applicant->id], ['class' => 'btn btn-link']) ?><br/>
                                        <?php } else {?>
                                            <?php if ($window==1) { ?>
                                                <?= Html::a('<i class="glyphicon glyphicon-plus"></i>Profile of the Project', ['/mgf-proposal/create'], ['class' => 'btn btn-link']) ?>
                                            <?php } ?>
                                    <?php }?>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
    <div class="col-md-7">
        <strong>FULL PROJECT PROPOSAL (FPP) - Window <?= $window; ?></strong><br/>
            <?php if($mgfWindow->is_active){ ?>
                <h6 style="color:blue">Application Period: From <?= $mgfWindow->open_from." to ".$mgfWindow->closing_date; ?><br/></h6>
            <?php }else{ ?>
                <h6 style="color:red">MGF Applications Closed<br/></h6>
            <?php } ?>
        <div style="text-align: center; font-weight:bold">Use of FPP</div>
            <p>
                The FPP should provide full details of the proposed project that will enable a decision on whether to 
                provide grant financing under a specified MGF window. Please note that project implementation 
                period should be realistic and not limited to the 2-year financing period of MGF. Costs should be 
                fully estimated and not tailored to MGF grant allocation and applicant contribution only. If these 
                sources are inadequate, applicant should seek additional financial support, as necessary, finance can 
                be sought from MGF in two phases as long as the ceiling is not exceeded, and project completion 
                date does not go beyond December 2023.
            </p>

            <?php if($mgfWindow->is_active){ ?>
            <b>Application Steps:</b><br/>
            <?php if ($window==1) { ?>
            (i) Register Your Organisation
            <?php if ($checlist->organisation_created==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (ii) Add Organisational Contact People
            <?php if ($checlist->contacts_added==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (iii) Update Business Management Capacity, Governance and Financial Status
            <?php if ($checlist->management_updated==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (iv) Indicate Previous Experience with External Project Financing
            <?php if ($checlist->experience_updated==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (v) Upload Organisation Attachments
            <?php if ($checlist->attachements_uploaded==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (vi) Cornfirm your User Details
            <?php if ($checlist->profile_confirmed==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (vii) Create Full Project Proposal
            <?php if ($checlist->proposal_created==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (viii) Project Fully Managed
            <?php if ($checlist->activities_created) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>

            (ix) Submit Proposal
            <?php if ($checlist->project_submitted==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>

            <?php } else { ?>

            (i) Register Your Organisation
            <?php if ($checlist->organisation_created==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (ii) Add Organisational Contact People
            <?php if ($checlist->contacts_added==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (iii) Update Business Management Capacity, Governance and Financial Status
            <?php if ($checlist->management_updated==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (iv) Indicate Previous Experience with External Project Financing
            <?php if ($checlist->experience_updated==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (v) Upload Organisation Attachments
            <?php if ($checlist->attachements_uploaded==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (vi) Cornfirm your User Details
            <?php if ($checlist->profile_confirmed==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (vii) Create Project Concept Note
            <?php if ($checlist->concept_created==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>

            (viii) Submit Concept Note for Approval
            <?php if ($checlist->concept_submitted==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>

            (ix) Create Full Project Proposal
            <?php if ($checlist->proposal_created==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>
            (x) Project Fully Managed
            <?php if ($checlist->activities_created) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>

            (xi) Submit Proposal
            <?php if ($checlist->project_submitted==1) { ?>
                <b style="color:green"><i class="fa fa-check"></i></b>
            <?php } else { ?>
                <b style="color:red"><i class="fa fa-times"></i></b>
            <?php } ?><br/>

            <?php } ?>

            <p style="color:red"><b>This application should be fully completed.</b></p>
            
            <?php if ($window==1) { ?>
                                         
                <?php if (MgfOrganisation::find()->where(['applicant_id'=>$applicant->id])->exists()) { ?>
                    <?php if (MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'is_concept'=>0, 'is_active'=>1])->andWhere(['NOT',['totalcost'=>0]])->exists()) { ?>
                        <?php $proposal=MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'is_concept'=>0, 'is_active'=>1])->andWhere(['NOT',['totalcost'=>0]])->one() ?>
                        <?php $components=MgfComponent::find()->where(['proposal_id'=>$proposal->id])->count() ?>
                            <?php if (($proposal->proposal_status=="Prepared" || $proposal->proposal_status=="Cancelled")) { ?>
                                <?php if ($checlist->activities_created==1) { ?>
                                    <?= Html::a('<i class="fa fa-check"></i>Submit Proposal', ['/mgf-proposal/submit','id'=>$proposal->id], ['class' => 'btn btn-success']) ?>
                                <?php } ?>
                            <?php } elseif ($proposal->proposal_status=="Submitted") { ?>
                                <?= Html::a('<i class="fa fa-times"></i>Cancel Submission', ['/mgf-proposal/cancel','id'=>$proposal->id], ['class' => 'btn btn-danger']) ?>
                            <?php } else { ?>
                            <?php } ?>
                        
                    <?php } ?>
                <?php }?>
                
            <?php }?>


            <?php if ($window==2) { ?>
                                         
                <?php if (MgfOrganisation::find()->where(['applicant_id'=>$applicant->id])->exists()) { ?>
                    <?php if (MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'is_concept'=>0, 'is_active'=>1])->andWhere(['NOT',['totalcost'=>0]])->exists()) { ?>
                        <?php $proposal=MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'is_concept'=>0, 'is_active'=>1])->andWhere(['NOT',['totalcost'=>0]])->one() ?>
                        <?php $components=MgfComponent::find()->where(['proposal_id'=>$proposal->id])->count() ?>
                            <?php if (($proposal->proposal_status=="Prepared" || $proposal->proposal_status=="Accepted" || $proposal->proposal_status=="Cancelled") && $components>0) { ?>
                                <?php if ($checlist->activities_created==1) { ?>
                                    <?= Html::a('<i class="fa fa-check"></i>Submit Proposal', ['/mgf-proposal/submit','id'=>$proposal->id], ['class' => 'btn btn-success']) ?>
                                <?php } ?>
                            <?php } elseif ($proposal->proposal_status=="Submitted") { ?>
                                <?= Html::a('<i class="fa fa-times"></i>Cancel Submission', ['/mgf-proposal/cancel','id'=>$proposal->id], ['class' => 'btn btn-danger']) ?>
                            <?php } else { ?>
                            <?php } ?>
                        
                    <?php } ?>
                <?php }?>


                <?php if (MgfOrganisation::find()->where(['applicant_id'=>$applicant->id])->exists()) { ?>
                    <?php if (MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'is_concept'=>1, 'is_active'=>1])->andWhere(['NOT',['totalcost'=>0]])->exists()) { ?>
                        <?php $proposal=MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id,'is_concept'=>1, 'is_active'=>1])->one() ?>
                            <?php if (($proposal->proposal_status=="Prepared" || $proposal->proposal_status=="Cancelled") && $checlist->items_created==1) { ?>
                                <?= Html::a('<i class="fa fa-check"></i>Submit Concept Note', ['/mgf-proposal/submit-concept','id'=>$proposal->id], ['class' => 'btn btn-success']) ?>                      
                            <?php } elseif ($proposal->proposal_status=="Submitted") { ?>
                                <?= Html::a('<i class="fa fa-times"></i>Cancel Submission', ['/mgf-proposal/cancel','id'=>$proposal->id], ['class' => 'btn btn-danger']) ?>
                            <?php } else { ?>
                        <?php } ?>
                        
                    <?php } ?>
                <?php }?>
            <?php }?>
        <hr>
    </div>

    
    <div class="col-md-2">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Documents
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                    <li>
                        <?php
                        echo Html::a('<div  class="icheck-primary d-inline ml-2"><i class="fa fa-file-pdf fa-2x"></i></div>
                        <span class="text">Form 1</span>
                        <div class="tools"><i class="fas fa-download fa-2x"></i></div>',
                                ['',],
                                ['title' => 'Download Form 1','target' => '_blank','data-toggle' => 'tooltip',
                            'data-placement' => 'top','data-pjax' => '0','style' => "padding:5px;",]);
                        ?>
                    </li>

                    <li>
                        <?php
                        echo Html::a('<div  class="icheck-primary d-inline ml-2"><i class="fa fa-file-pdf fa-2x"></i></div>
                        <span class="text">Form 2</span>
                        <div class="tools"><i class="fas fa-download fa-2x"></i></div>',
                            ['',],
                            ['title' => 'Download Form 2','target' => '_blank','data-toggle' => 'tooltip',
                            'data-placement' => 'top','data-pjax' => '0','style' => "padding:5px;",]);
                        ?>
                    </li>
                    
                    <li>
                        <?php
                            echo Html::a(
                                    '<div  class="icheck-primary d-inline ml-2">
                          <i class="fa fa-file-pdf fa-2x"></i>
                          </div>
                          <!-- todo text -->
                          <span class="text">Form 3</span>
                          <div class="tools">
                          <i class="fas fa-download fa-2x"></i>
                          </div>',
                                ['',],
                                [
                                'title' => 'Download Form 3',
                                'target' => '_blank',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-pjax' => '0',
                                'style' => "padding:5px;",
                                    ]
                            );
                        ?>
                    </li>
                </ul>
            </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <?php if (MgfOrganisation::find()->where(['applicant_id'=>$applicant->id])->exists()) { ?>
            <?php if(MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id, 'is_active'=>1])->exists()){ ?>
                <strong>PROJECT SUMMARY SHEET</strong><br/>
                <?= DetailView::widget([
                    'model' => MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id, 'is_active'=>1])->one(),
                    'attributes' => [
                        'organisation.cooperative',
                        'project_title',   
                        'proposal_status',         
                        'province.name',
                        'district.name',
                        'organisation.email_address',
                        'project_operations',
                        'project_length',
                        'starting_date',
                        'ending_date',
                        'totalcost',
                    ],
                ]) ?>

            <?= DetailView::widget([
                    'model' => MgfOrganisation::find()->where(['id'=>$applicant->organisation_id])->one(),
                    'attributes' => [
                        //'organisation.cooperative',
                        //'project_title',            
                        //'proposal_status',
                        //'province.name',
                        //'district.name',
                        //'date_submitted',
                    ],
                ]) ?>
            <?php }?>
        <?php }?>
    </div>

    <?php } ?>
</div>

<?php if ($applicant->organisation_id>0) { ?>

<div class="modal fade" id="newConceptNote">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Create Project Concept Note</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-concept-note/create',]) ?>
                <?php $model = new MgfConceptNote();?>
               
                    <?= $form->field($model, 'project_title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'application_id')->textInput(['maxlength' => true,'value'=>$application->id,'hidden'=>true])->label(false) ?>

                    <?= $form->field($model, 'organisation_id')->textInput(['maxlength' => true,'value'=>$applicant->organisation_id,'hidden'=>true])->label(false) ?>
                              
                    <?= $form->field($model, 'estimated_cost')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'starting_date')->widget(
                    DatePicker::className(),['pluginOptions' => ['autoclose'=>true,'format' => 'yyyy-mm-dd']]);?>

                    <?= $form->field($model, 'implimentation_period')->dropDownList([ '1' => '1 Year', '2' => '2 Years','3' => '3 Years', '4' => '4 Years','5' => '5 Years', '6' => '6 Years','7' => '7 Years', '8' => '8 Years' ], ['prompt' => 'SELECT','required'=>true]) ?>
                     
                <?= $form->field($model, 'operation_id')->dropDownList(ArrayHelper::map(MgfOperation::find()->all(), 'id', 'operation_type'), ['prompt'=>'Operational Type']) ?>

            </div>
            <div class="modal-footer">
                <?= Html::submitButton('Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>

<?php } ?>


<?php if ($applicant->organisation_id>0) { ?>

<div class="modal fade" id="operationalType">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><h3>Select Type of Operations for yor Organisation</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Type of Operation</th>
                                <th></th>
                                <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-proposal/select-areas&id='.$applicant->organisation_id]) ?>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php  $operations=MgfOperation::find()->all(); ?>
                            <?php  $ia=1; ?>
                                <?php foreach($operations as $act):?>
                                    <tr class="table-active">
                                        <th scope="row"><?=$ia; ?></th>
                                        <td><?=$act->operation_type; ?></td>
                                    </tr>
                                <?php  $ia=$ia+1; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <?php $model = MgfOrganisation::findOne($applicant->organisation_id);?>
                        <div class="modal-footer">
                            <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Assign Selected Projects ', ['class' => 'btn btn-success btn-sm']) ?>
                        </div>  
                        <?php ActiveForm::end() ?>
                    </table>
                </div>
            </div>   
        </div>
    </div>
</div>

<?php }?>
<?php }else{?>
    <div role="alert" style="text-align: center;border-style: outset;">
    <hr><p style="font-weight: bold; color:red">MGF Application Periond was From <?= $mgfWindow->open_from." to ".$mgfWindow->closing_date; ?></p><hr>
</div>
    
<?php } ?>
