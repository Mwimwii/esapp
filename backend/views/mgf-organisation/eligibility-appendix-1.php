<?php

use backend\models\MgfBranch;
use backend\models\MgfOrganisation;
use backend\models\MgfApplicant;
use backend\models\MgfContact;
use backend\models\MgfExperience;
use backend\models\MgfOrganisationalDetails;
use backend\models\MgfPosition;
use backend\models\User;
use backend\models\MgfPastproject;
use yii\helpers\Html;
$organisation=MgfOrganisation::findOne($_GET['id']);
$applicant=MgfApplicant::findOne($organisation->applicant_id);
$user=User::findOne($applicant->user_id);
$pos1=MgfPosition::findOne(['position'=>'Board Chairman']);
$pos2=MgfPosition::findOne(['position'=>'CEO']);
$bcp=MgfContact::findOne(['organisation_id'=>$organisation->id,'applicant_id'=>$applicant->id,'position_id'=>$pos1->id]);
$ceo=MgfContact::findOne(['organisation_id'=>$organisation->id,'applicant_id'=>$applicant->id,'position_id'=>$pos2->id]);
$structure=MgfOrganisationalDetails::findOne(['organisation_id'=>$organisation->id]);
$experience=MgfExperience::findOne(['organisation_id'=>$organisation->id]);

if($applicant->applicant_type=="Category-A"){
    $window=1;
}else{
    $window=2;
}
?>

<div class="container ">
    <div class="row">
        <div class="text-left">
            <?= Html::img('@web/img/coa.png', ['style' => 'width:100px; height: 100px']); ?>
        </div>
        <div style="margin-top: -100px;" class="text-right">
            <?= Html::img('@web/img/ifad.png', ['style' => 'width:100px; height: 100px']); ?>
        </div>
    </div>
    <div class="text-center" style="margin-top: 20px;margin-bottom: 100px;margin-top: -100px;font-weight: bold;">
        <p>
            APPLICATION FOR PARTICIPATION IN:<br>
            ENHANCED SMALLHOLDER AGRIBUSINESS PROMOTION PROGRAMME<br>
            (E-SAPP)<br>
            MATCHING GRANT FACILITY (MGF)<br><br>
        </p>
    </div>
    <p>
        We wish to apply for assistance from Enhanced Smallholder Agribusiness Promotion <br>
        Programme (E-SAPP) – Matching Grant Facility. We provide below detailed information about <br>
        our Organisation and confirm that we met the eligibility criteria and conditions to participate<br>
        under Window <u><?=$window?>
    </p>
    <p style="font-weight: bold;">I. Profile of Organization</p>
    <p class="text-justify">
        1. Name and Acronym of Organisation <u><?=$organisation->cooperative?>, <?=$organisation->acronym?></u>
    </p>

    <p class="text-justify">
        2. Type of Legal Registration <u><?=$organisation->registration_type?></u><br>

        Registration No:<u><?=$organisation->registration_no?></u>  &nbsp;&nbsp; Date: <u><?=$organisation->registration_date?></u><br>
    </p>

    <p class="text-justify">
        3.	Central Business Objective:  <u><?=$organisation->business_objective?></u>
    </p>

    <p class="text-justify">
        4.	Trade Licence Number: <u><?=$organisation->trade_license_no?></u>. 
    </p>

    <p class="text-justify">
    5. Headquarters Physical Address: <u><?=$organisation->physical_address?></u><br>
    
	Email Address: <u><?=$organisation->email_address?></u>.&nbsp;Fax: <u><?=$organisation->fax_no?>&nbsp;</u>    
    Tel: <u><?=$organisation->tel_no?></u>
    </p>
    <p class="text-justify">
    6.	Name of Contact Person: <u><?=$applicant->title .' '.$applicant->first_name .' '. $applicant->last_name?></u><br>


	Address: <u><?=$applicant->address?></u><br>

	E-mail: <u><?=$user->email?></u>. &nbsp;Land Phone: <u><?=$organisation->tel_no?></u>  &nbsp;Mobile Phone: <u><?=$applicant->mobile?></u><br>

    </p>

    <p class="text-justify">
        7. Board Chairman: Name: <?=$bcp->first_name .' '. $bcp->last_name?></u><br>

        Address: <?=$bcp->physical_address?></u><br>
        
        Land Phone:  <?=$bcp->tel_no?> &nbsp;&nbsp; Mobile Phone:  <?=$bcp->mobile?>.<br>
    </p>

    <p class="text-justify">
        8. CEO: Name: <?=$ceo->first_name .' '. $ceo->last_name?></u><br>

        Address: <?=$ceo->physical_address?></u><br>
        
        Land Phone:  <?=$ceo->tel_no?> &nbsp;&nbsp; Mobile Phone:  <?=$ceo->mobile?>.<br>
    </p>

    <p class="text-justify">
    9.	Indicate Branches/Address: If any ……………………………………………………
    <?php
    if (MgfBranch::find()->where(['organisation_id' => $organisation->id])->exists()) {
        $branches = MgfBranch::find()->where(['organisation_id' => $organisation->id])->orderBy(['address' => SORT_ASC])->all();
        echo '<p style="font-weight: bold;font-size:14px;">Branches:</p>';
        foreach ($branches as $branch) {
            echo "<p>" . $branch['address'] ." with ". $branch['employess'] . " Employees</p>";
        }
    }
    ?>
    </p>


    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <p style="font-weight: bold;">II. Business Management Capacity, Governance and Financial Status</p>


    <p>1. Business Establishment: </p>

        <p>Management Staff : 	No. <u><?=$structure->mgt_Staff?></u></p>
        <p>Senior Staff:		No. <u><?=$structure->senior_Staff?></u></p>
        <p>Junior Staff: 		No. <u><?=$structure->junior_Staff?></u></p>
        <p>Others:				No. <u><?=$structure->others?></u></p>

    <p>2.  Governance:</p>
        <p>Last Board Meeting:		Date . <u><?=$structure->last_board?></u>.</p>
        <p>Last Annual General Meeting: Date <u><?=$structure->last_agm?></u>.</p>
        <p>Last Audit Report: 		Date <u><?=$structure->last_audit?></u></p>

   
    <p style="font-weight: bold;">III.	Previous Experience with External Project Financing </p>

        <p>1.	Have you received grant financing in the past from any project including SAPP: <u><?=$experience->financed_before?></u></p>
        If Yes, How many; Please provide information on it/them

    <?php
    if (MgfPastproject::find()->where(['organisation_id' => $organisation->id])->exists()) {
        $projects = MgfPastproject::find()->where(['organisation_id' => $organisation->id])->orderBy(['project_name' => SORT_ASC])->all();
        echo '<p style="font-weight: bold;font-size:14px;">Past Projects:</p>';
        foreach ($projects as $project) {
            echo "<p> Name of Project: " . $project['project_name'] ."</p>";
            echo "<p> Years of Assistance: " . $project['years_assisted'] ."</p>";
            echo "<p> Amount of Assistance ZMW: " . $project['amount_assisted'] ."</p>";
            echo "<p> Did you meet your obligations?: " . $project['obligations_met'] ."</p>";
            echo "<p> Result: " . $project['outcome_response'] ."</p>";
            echo "<p> </p>";
        }
    }
    ?>

    <p>2.	Have you any collaboration/partnership with smallholder’s farmers/producers/rural agribusiness in the past? <u><?=$experience->any_collaboration?></u></p>
        <p>If yes, please elaborate and confirm willingness to continue/expand. If no, Are you prepared to establish such collaboration? <u><?=$experience->collaboration_ready?></u></p>
        <p>If yes, have you undertaken any consultation to establish collaboration/partnerships, please indicate status.</p>
        
            
</div>


