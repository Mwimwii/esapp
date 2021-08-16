<?php
use yii\helpers\Html;
use yii\bootstrap\Tabs;
//echo $this->title;
//include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
?>

<h3><?= Html::encode($this->title) ?></h3> 
<div class="margin">
    <div class="btn-group">
        <button type="button" class="btn btn-default">MGF Full Proposals</button>
        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
            <li>
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
        </div>
    </div>
</div>

