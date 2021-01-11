<?php

use yii\helpers\Html;
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
            Ministry of Agriculture<br>
            Enhanced Smallholder Agribusiness Promotion Programme<br>
            Story of Change Interview guide
        </p>
    </div>
    <p style="font-weight: bold;font-size: 16px;">Informed Consent</p>
    <p style="font-weight: bold;">Interview Purpose</p>
    <p class="text-justify">
        Hello, my name is______________________________. I am a ........................................................
        working for the Ministry 
        of Agriculture.The Ministry of Agriculture is currently implementing a programme called E-SAPP that is aimed 
        at increasing the incomes, and food and nutrition security of rural households (hhs) involved in 
        market-oriented agriculture. The purpose of this interview is to talk to you about 
        ......................................................................................................
        which currently has been identified as one of the possible stories of change attributable to the 
        E-SAPP interventions.Specifically, as one of the components of our overall program evaluation we 
        are documenting stories of change in order to capture lessons that can be used in future interventions 
        and your participation in this interview is of great importance to us.
    </p>
    <p style="font-weight: bold;">Informed consent process</p>
    <p class="text-justify">
        The interview will take about 1 hour.  Your participation in this interview is voluntary.  You can choose to stop the interview at any time without explanation, or you can request that your answers are removed from the research at any time.  You will not be penalized if you decide not to participate.
    </p>
    <p class="text-justify">
        During this discussion I would like you to feel free to discuss the issues raised openly and honestly as you can even when they are critical.  There are no right or wrong answers.  If there are any questions you do not want to answer you can choose not to.
    </p>
    <p class="text-justify">
        I would like to record this session to make sure that the information captured from today’s interview is a true reflection of what was said. The discussion is confidential. The recording will
        not have any information that names or identifies you personally, and it will not be played on the radio, internet or elsewhere and the information will be kept in a secure place.
    </p>
    <p class="text-justify">
        We will be conducting more interviews like this.  At the end a report will be written based on all of the views and the suggestions that we collect. In the report no-one will be named. The feedback that you give will be reported in a way that your identity will remain anonymous.
    </p>
    <p class="text-justify">
        There is no direct benefit to you for participating, but the answers that you provide will help to better implement the programme.
    </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p style="font-weight: bold;">Consenting Process</p>
    <p>Do you agree to participate in the interview today? </p>
    <p><b>Yes</b>  &nbsp;[&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>No</b>&nbsp; [&nbsp;&nbsp;]</p>
    <p><i>If response is NO to the above question stop consent process and</i> <b>DO NOT INTERVIEW</b></p>
    <p>
        Do you agree to the discussion being recorded? [<b>OBTAIN ORAL CONSENT FROM PARTICIPANT</b>]
    </p>
    <p><b>Yes</b>  &nbsp;[&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>No</b>&nbsp; [&nbsp;&nbsp;]</p>
    <p>[<i>note below their sex and reason for refusal if they refuse to tell you</i>]</p>
    <p>Sex of person refused: &nbsp;&nbsp;&nbsp;<b>Male</b>  &nbsp;[&nbsp;&nbsp;]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Female</b>&nbsp; [&nbsp;&nbsp;]</p>
    <p><b>Reason for refusal:</b>....................................................................................................................................</p>
    <p>&nbsp;</p>
    <p>Before we start are there any questions you would like to ask?</p>
    <p>Date interview held (DD/MM/YYYY): ________/_________/_________________</p>
    <p>&nbsp;</p>
    <p><b>Name of Interviewee: </b>&nbsp;&nbsp;_______________________________________________________</p>
    <p>&nbsp;</p>
    <p><b>Name of Interviewer: </b>&nbsp;&nbsp;_______________________________________________________</p>
    <p>&nbsp;</p>
    <p><b>Date:</b> &nbsp;&nbsp;_____________________________________________________________________</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <?php
    //Display actual interview questions
    //1.Introduction
    $intro_model = backend\models\LkmStoryofchangeInterviewGuideTemplateQuestions::find()
            ->select(['number', 'question'])
            ->where(['section' => "Introduction"])
            ->orderBy(['number' => SORT_ASC])
            ->all();
    if (!empty($intro_model)) {
        echo ' <p style="font-weight: bold;font-size:14px;">Introduction:</p>';
        foreach ($intro_model as $model) {
            echo "<p><b>" . $model['number'] . ".</b> " . $model['question'] . "</p>";
        }
    }
    echo '<p>&nbsp;</p>';
    //2.The Problem
    $problem_model = backend\models\LkmStoryofchangeInterviewGuideTemplateQuestions::find()
            ->select(['number', 'question'])
            ->where(['section' => "The Problem"])
            ->orderBy(['number' => SORT_ASC])
            ->all();
    if (!empty($problem_model)) {
        echo '<p style="font-weight: bold;font-size:14px;">The Problem:</p>';
        foreach ($problem_model as $model) {
            echo "<p style='padding-left:2em'><b>" . $model['number'] . ".</b> " . $model['question'] . "</p>";
        }
    }
    echo '<p>&nbsp;</p>';
    //3.The Action
    $action_model = backend\models\LkmStoryofchangeInterviewGuideTemplateQuestions::find()
            ->select(['number', 'question'])
            ->where(['section' => "The Action"])
            ->orderBy(['number' => SORT_ASC])
            ->all();
    if (!empty($action_model)) {
        echo '<p style="font-weight: bold;font-size:14px;">The Action:</p>';
        foreach ($action_model as $model) {
            echo "<p style='padding-left:2em'><b>" . $model['number'] . ".</b> " . $model['question'] . "</p>";
        }
    }
    echo '<p>&nbsp;</p>';
    //4. Recommendations
    $recommendations_model = backend\models\LkmStoryofchangeInterviewGuideTemplateQuestions::find()
            ->select(['number', 'question'])
            ->where(['section' => "Recommendations"])
            ->orderBy(['number' => SORT_ASC])
            ->all();
    if (!empty($recommendations_model)) {
        echo '<p style="font-weight: bold;font-size:14px;">Recommendations:</p>';
        foreach ($recommendations_model as $model) {
            echo "<p style='padding-left:2em'><b>" . $model['number'] . ".</b> " . $model['question'] . "</p>";
        }
    }
    ?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p class="text-center">
        <b>
            Thank you very much for your time. I don’t have any further questions to ask you. Do you have any questions or comments, for me?
        </b>
    </p>
</div>


