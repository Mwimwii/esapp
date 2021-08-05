<?php
use yii\helpers\Html;
use yii\bootstrap\Tabs;
//echo $this->title;
//include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
?>


<div class="default" style="color:black;font-weight:bold">
<ul class="nav nav-tabs">
<?php if($this->title=="MFG Proposals") {?>
    <li class="active">
        <?= Html::a('All Proposals', ['mgf-proposal/index']) ?>
    </li>
    <li>
        <?= Html::a('Submitted', ['mgf-proposal/proposals']) ?>
    </li>
    <li>
        <?= Html::a('Reviewers', ['mgf-proposal/reviewers']) ?>
    </li>
    <li>
        <?= Html::a('Assigned', ['index']) ?>
    </li>
<?php }elseif($this->title=="Submitted Proposals") {?>
    <li>
        <?= Html::a('All Proposals', ['mgf-proposal/index']) ?>
    </li>
    <li class="active">
        <?= Html::a('Submitted', ['mgf-proposal/proposals']) ?>
    </li>
    <li>
        <?= Html::a('Reviewers', ['mgf-proposal/reviewers']) ?>
    </li>
    <li>
        <?= Html::a('Assigned', ['mgf-project-evaluation/index']) ?>
    </li>

<?php }elseif($this->title=="Assigned Proposals") {?>
    <li>
        <?= Html::a('All Proposals', ['mgf-proposal/index']) ?>
    </li>
    <li>
        <?= Html::a('Submitted', ['mgf-proposal/proposals']) ?>
    </li>
    <li>
        <?= Html::a('Reviewers', ['mgf-proposal/reviewers']) ?>
    </li>
    <li class="active">
        <?= Html::a('Assigned', ['index']) ?>
    </li>
<?php }else{?>
    <li>
        <?= Html::a('All Proposals', ['mgf-proposal/index']) ?>
    </li>
    <li>
        <?= Html::a('Submitted', ['mgf-proposal/proposals']) ?>
    </li>
    <li class="active">
        <?= Html::a('Reviewers', ['mgf-proposal/reviewers']) ?>
    </li>
    <li>
        <?= Html::a('Assigned', ['index']) ?>
    </li>
<?php }?>
</ul>
</div>

