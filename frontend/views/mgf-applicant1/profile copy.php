<?php

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


use frontend\models\MgfConceptNote;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
//use dosamigos\datepDatePickericker\;
use frontend\models\MgfOperation;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfApplicantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ' E-SAPP - Matching Grant Facility (MGF)';
$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::findOne(['user_id'=>$userid]);
if($applicant->applicant_type=="Category-A"){
    $window=1;
}else{
    $window=2;
}

if ($applicant->organisation_id>0) {
    if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1])->exists()) {
        $application=MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1])->one();
        $attachement = MgfAttachements::find()->where(['application_id'=>$application->id])->one();
    } else {
        $application=new MgfApplication();
        $application->organisation_id=$applicant->organisation_id;
        $application->applicant_id=$applicant->id;
        $application->is_active=1;
        $application->save();
        $application=MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1])->one();
        $attachement = MgfAttachements::find()->where(['application_id'=>$application->id])->one();
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
?>

    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Submitted'])->exists()) { ?>
        <?php Yii::$app->session->setFlash('info', 'Your Application has been Submitted to the District for Review');?>
    <?php }?>

    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Under_Review'])->exists()) { ?>
        <?php Yii::$app->session->setFlash('info', 'Your Application is Under Review at District Level');?>
    <?php }?>

    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Accepted'])->exists()) { ?>
        <?php Yii::$app->session->setFlash('info', 'Your Application is Under Review at Provincial Level');?>
    <?php }?>

    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Certified'])->exists()) { ?>
        <?php Yii::$app->session->setFlash('info', 'Your Application is Under Review at National Level');?>
    <?php }?>


    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Approved'])->exists()) { ?>
        <?php Yii::$app->session->setFlash('info', 'Your Application is Has been Approved at National Level');?>
    <?php }?>

    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Rejected'])->exists()) { ?>
        <?php Yii::$app->session->setFlash('danger', 'Your Application has been Rejected at District Level');?>
    <?php }?>


    <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'On-Hold'])->exists()) { ?>
        <?php Yii::$app->session->setFlash('danger', 'Your Application has been put ON-HOLD at District Level');?>
    <?php }?>


    <?php if(MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id, 'is_active'=>1])->exists()) { ?>
        <?php $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id, 'is_active'=>1]);?>
        <?php Yii::$app->session->setFlash('info', 'Full Project Proposal Status: '.$proposal->proposal_status);?>
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
    <?= Html::a('<i class="glyphicon glyphicon-home"></i> Home', ['/mgf-applicant/profile'], ['class' => 'btn btn-link']) ?><br/>
    
    <div class="margin">
        <div class="btn-group">
            <button type="button" class="btn btn-default">Organisation Details</button>
            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">

            <?php if (MgfOrganisation::find()->where(['applicant_id'=>$applicant->id])->exists()) { ?>
                <?php $usertype=Yii::$app->user->identity->type_of_user;?>
                <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Organisation', ['/mgf-organisation/view','id'=>$applicant->organisation_id], ['class' => 'btn btn-link']) ?><br/>
                <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Business Management', ['/mgf-organisational-detail/create'], ['class' => 'btn btn-link']) ?><br/>
                <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Previous Experience', ['/mgf-experience/view','id'=>$experience->id,'status'=>0], ['class' => 'btn btn-link']) ?><br/>
                <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Attachments', ['/mgf-attachements/attachements','id'=>$attachement->id], ['class' => 'btn btn-link']) ?><br/>
                <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Confirmation', ['/mgf-applicant/confirm','id'=>$applicant->id], ['class' => 'btn btn-link']) ?><br/>
            <?php }else{ ?>
                <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Profile of the Organisation', ['/mgf-organisation/create'], ['class' => 'btn btn-link']) ?> <br/>
            <?php }?>
            </div>
        </div>
    </div>



        <div id="accordionOrg">
            <div class="card">
                <div class="card-header" id="headingOrganisation">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOrg" aria-expanded="true" aria-controls="collapseOrg">
                            <i class="glyphicon glyphicon-registration-mark"></i> Organisation Details
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


                                        <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Organisation', ['/mgf-organisation/view','id'=>$applicant->organisation_id], ['class' => 'btn btn-link']) ?><br/>
                                        <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Business_Management', ['/mgf-organisational-detail/create'], ['class' => 'btn btn-link']) ?><br/>
                                        <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Previous_Experience', ['/mgf-experience/view','id'=>$experience->id,'status'=>0], ['class' => 'btn btn-link']) ?><br/>
                                        <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Attachments', ['/mgf-attachements/attachements','id'=>$attachement->id], ['class' => 'btn btn-link']) ?><br/>
                                        <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>Confirmation', ['/mgf-applicant/confirm','id'=>$applicant->id], ['class' => 'btn btn-link']) ?><br/>
                                    <?php }else{ ?>
                                        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Profile of the Organisation', ['/mgf-organisation/create'], ['class' => 'btn btn-link']) ?> <br/>
                                    <?php }?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
         
        <?php if($window==2){ ?>

        <div class="margin">
        <div class="btn-group">
            <button type="button" class="btn btn-default">Application for Participation</button>
            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">
                <?php if (MgfOrganisation::find()->where(['applicant_id'=>$applicant->id])->exists()) { ?>
                    <?php if(MgfConceptNote::find()->where(['application_id'=>$application->id])->exists()){ ?>
                        <?php $concept=MgfConceptNote::findOne(['application_id'=>$application->id]); ?>
                        <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>MGF Concepte Note', ['/mgf-concept-note/view','id'=>$concept->id], ['class' => 'btn btn-link']) ?>
                    <?php }else{ ?>
                        <?= Html::button('<i class="glyphicon glyphicon-plus"></i>MGF Project Concept Note', [ 'class' => 'btn btn-link', 'onclick' => '$(\'#newConceptNote\').modal();']);?>
                    <?php }?>                         
                <?php }?>
            </div>
        </div>
    </div>


        <div id="accordionCN">
            <div class="card">
                <div class="card-header" id="headingOrganisation">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseCN" aria-expanded="false" aria-controls="collapseCN">
                            <i class="glyphicon glyphicon-copyright-mark"></i> Application for Participation<br/> in the E-SAPP-MGF
                        </button>
                    </h5>
                </div>
                <div id="collapseCN" class="collapse" aria-labelledby="collapseCN" data-parent="#accordionCN">
                    <div class="row">
                        <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <div class="card-body">
                                    <?php if (MgfOrganisation::find()->where(['applicant_id'=>$applicant->id])->exists()) { ?>
                                        <?php if(MgfConceptNote::find()->where(['application_id'=>$application->id])->exists()){ ?>
                                            <?php $concept=MgfConceptNote::findOne(['application_id'=>$application->id]); ?>
                                            <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i>MGF Concepte Note', ['/mgf-concept-note/view','id'=>$concept->id], ['class' => 'btn btn-link']) ?>
                                        <?php }else{ ?>
                                            <?= Html::button('<i class="glyphicon glyphicon-plus"></i>MGF Project Concept Note', [ 'class' => 'btn btn-link', 'onclick' => '$(\'#newConceptNote\').modal();']);?>
                                        <?php }?>                         
                                    <?php }?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    
        <?php } ?>

        <div class="margin">
        <div class="btn-group">
            <button type="button" class="btn btn-default">Project Background</button>
            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">
                <?php if (MgfOrganisation::find()->where(['applicant_id'=>$applicant->id])->exists()) { ?>
                    <?php if(MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id, 'is_active'=>1])->exists()){ ?>
                        <?php $proposal=MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id, 'is_active'=>1])->one();?>
                            <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i> Project Details', ['/mgf-proposal/view','id'=>$proposal->id], ['class' => 'btn btn-link']) ?> <br/>
                            <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i> Project Description,<br/>Costs and Financing ', ['/mgf-component/components',], ['class' => 'btn btn-link']) ?> <br/>
                            <!--<?= Html::a('<i class="glyphicon glyphicon-pushpin"></i> Project\'s Activites', ['/mgf-activity/activities',], ['class' => 'btn btn-link']) ?> <br/>-->
                        <?php }else{?>
                            <?php if($window==1){ ?>
                                <?= Html::a('<i class="glyphicon glyphicon-plus"></i>Profile of the Project', ['/mgf-proposal/create'], ['class' => 'btn btn-link']) ?>
                            <?php } ?>
                    <?php }?>
                <?php }?>
            </div>
        </div>
    </div>

        <div id="accordionProj">
            <div class="card">
                <div class="card-header" id="headingProj">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseProj" aria-expanded="false" aria-controls="collapseProj">
                            <i class="glyphicon glyphicon-tower"></i> Project Background
                        </button>
                    </h5>
                </div>
                <div id="collapseProj" class="collapse" aria-labelledby="collapseProj" data-parent="#accordionProj">
                <div class="row">
                    <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <?php if (MgfOrganisation::find()->where(['applicant_id'=>$applicant->id])->exists()) { ?>
                                    <?php if(MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id, 'is_active'=>1])->exists()){ ?>
                                        <?php $proposal=MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id, 'is_active'=>1])->one();?>
                                            <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i> Project Details', ['/mgf-proposal/view','id'=>$proposal->id], ['class' => 'btn btn-link']) ?> <br/>
                                            <?= Html::a('<i class="glyphicon glyphicon-pushpin"></i> Project Description,<br/>Costs and Financing ', ['/mgf-component/components',], ['class' => 'btn btn-link']) ?> <br/>
                                            <!--<?= Html::a('<i class="glyphicon glyphicon-pushpin"></i> Project\'s Activites', ['/mgf-activity/activities',], ['class' => 'btn btn-link']) ?> <br/>-->
                                        <?php }else{?>
                                            <?php if($window==1){ ?>
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
    </div>
    <div class="col-md-7">
        <strong>FULL PROJECT PROPOSAL (FPP) - Window <?= $window; ?></strong><br/>
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
            <p style="color:red"><b>This application should be fully completed.</b></p>
            
            <?php if($window==2){ ?>
                <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Initialized'])->exists()) { ?>
                    <?php if(MgfConceptNote::find()->where(['application_id'=>$application->id])->exists()){ ?>
                        <?php $concept=MgfConceptNote::findOne(['application_id'=>$application->id]); ?>
                        <?= Html::a('<i class="glyphicon glyphicon-ok"></i>Submit MGF Concept Note', ['/mgf-concept-note/submit','id'=>$concept->id], ['class' => 'btn btn-primary']) ?>
                    <?php }?>
                <?php }?>

                <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Updated'])->exists()) { ?>
                    <?php if(MgfConceptNote::find()->where(['application_id'=>$application->id])->exists()){ ?>
                        <?php $concept=MgfConceptNote::findOne(['application_id'=>$application->id]); ?>
                        <?= Html::a('<i class="glyphicon glyphicon-ok"></i>Submit MGF Concept Note', ['/mgf-concept-note/submit','id'=>$concept->id], ['class' => 'btn btn-primary']) ?>
                    <?php }?>
                <?php }?>

                <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Cancelled'])->exists()) { ?>
                    <?php if(MgfConceptNote::find()->where(['application_id'=>$application->id])->exists()){ ?>
                        <?php $concept=MgfConceptNote::findOne(['application_id'=>$application->id]); ?>
                        <?= Html::a('<i class="glyphicon glyphicon-ok"></i>Submit MGF Concept Note', ['/mgf-concept-note/submit','id'=>$concept->id], ['class' => 'btn btn-primary']) ?>
                    <?php }?>
                <?php }?>

                <?php if (MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1,'application_status'=>'Submitted'])->exists()) { ?>
                    <?php if(MgfConceptNote::find()->where(['application_id'=>$application->id])->exists()){ ?>
                        <?php $concept=MgfConceptNote::findOne(['application_id'=>$application->id]); ?>
                        <?= Html::a('<i class="glyphicon glyphicon-remove"></i>Cancel Concept Note Submission', ['/mgf-concept-note/cancel','id'=>$concept->id], ['class' => 'btn btn-danger']) ?>
                    <?php }?>
                <?php }?>
            <?php } ?>

                                         
        <?php if (MgfOrganisation::find()->where(['applicant_id'=>$applicant->id])->exists()) { ?>
            <?php if(MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id, 'is_active'=>1])->andWhere(['NOT',['totalcost'=>0]])->exists()){ ?>
                <?php $proposal=MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id, 'is_active'=>1])->andWhere(['NOT',['totalcost'=>0]])->one() ?>
                <?php $components=MgfComponent::find()->where(['proposal_id'=>$proposal->id])->count() ?>
                    <?php if (($proposal->proposal_status=="Prepared" || $proposal->proposal_status=="Cancelled") && $components>0) { ?>
                        <?= Html::a('<i class="glyphicon glyphicon-ok"></i>Submit Proposal', ['/mgf-proposal/submit','id'=>$proposal->id], ['class' => 'btn btn-success']) ?>
                    <?php }elseif ($proposal->proposal_status=="Submitted") { ?>
                        <?= Html::a('<i class="glyphicon glyphicon-remove"></i>Cancell Submission', ['/mgf-proposal/cancel','id'=>$proposal->id], ['class' => 'btn btn-danger']) ?>
                    <?php }else{ ?>
                    <?php } ?>
            <?php } ?>
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
                                ['/interview-guide-template/download-template',],
                                ['title' => 'Download interview guide template','target' => '_blank','data-toggle' => 'tooltip',
                            'data-placement' => 'top','data-pjax' => '0','style' => "padding:5px;",]);
                        ?>
                    </li>

                    <li>
                        <?php
                        echo Html::a('<div  class="icheck-primary d-inline ml-2"><i class="fa fa-file-pdf fa-2x"></i></div>
                        <span class="text">Form 2</span>
                        <div class="tools"><i class="fas fa-download fa-2x"></i></div>',
                            ['/downloads/farmer-registration-form',],
                            ['title' => 'Download Cat A farmer registration form','target' => '_blank','data-toggle' => 'tooltip',
                            'data-placement' => 'top','data-pjax' => '0','style' => "padding:5px;",]);
                        ?>
                    </li>
                   
                    
                    <li>
                        <?php
                        if (!empty(Yii::$app->user->identity->district_id)) {
                            echo Html::a(
                                    '<div  class="icheck-primary d-inline ml-2">
                            <i class="fa fa-file-pdf fa-2x"></i>
                        </div>
                        <!-- todo text -->
                        <span class="text">Form 3</span>
                        <div class="tools">
                            <i class="fas fa-download fa-2x"></i>
                        </div>',
                                    ['',], [
                                'title' => 'Download FaaBS training attendance sheet',
                                'target' => '_blank',
                                "data-toggle" => "modal",
                                "data-target" => "#faabsModal",
                                // 'data-toggle' => 'tooltip',
                                // 'data-placement' => 'top',
                                // 'data-pjax' => '0',
                                'style' => "padding:5px;",
                                    ]
                            );
                        } else {
                            echo Html::a(
                                    '<div  class="icheck-primary d-inline ml-2">
                          <i class="fa fa-file-pdf fa-2x"></i>
                          </div>
                          <!-- todo text -->
                          <span class="text">Farming as Business(FaaBS) Attendance Sheet</span>
                          <div class="tools">
                          <i class="fas fa-download fa-2x"></i>
                          </div>',
                                    ['/downloads/faabs-attendance-sheet',], [
                                'title' => 'Download FaaBS training attendance sheet',
                                'target' => '_blank',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-pjax' => '0',
                                'style' => "padding:5px;",
                                    ]
                            );
                        }
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
                        'project_operations',
                        'project_length',
                        'starting_date',
                        'ending_date',
                        'totalcost',
                    ],
                ]) ?>

            <?= DetailView::widget([
                    'model' => MgfProposal::find()->where(['organisation_id'=>$applicant->organisation_id, 'is_active'=>1])->one(),
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
</div>


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
                              
                    <?= $form->field($model, 'estimated_cost')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'implimentation_period')->dropDownList([ '1' => '1 Year', '2' => '2 Years','3' => '3 Years', '4' => '4 Years','5' => '5 Years', '6' => '6 Years','7' => '7 Years', '8' => '8 Years' ], ['prompt' => 'SELECT','required'=>true]) ?>
                     
                <?= $form->field($model, 'operation_id')->dropDownList(ArrayHelper::map(MgfOperation::find()->all(),'id','operation_type'),['prompt'=>'Operational Type']) ?>

                
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>



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
