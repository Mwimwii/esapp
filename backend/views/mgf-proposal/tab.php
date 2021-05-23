<?php
use yii\helpers\Html;
use yii\bootstrap\Tabs;
//echo $this->title;
//include("C:/xampp/htdocs/esapp-mgf/frontend/views/mgf-applicant/mgfmenu.php");
?>
<h2><?= Html::encode($this->title) ?></h2> 
<div class="margin">
    <div class="btn-group">
        <button type="button" class="btn btn-default">MGF Full Proposals</button>
        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
            <li>
                <?= Html::a('All Proposals', ['index']) ?>
            </li>
            <li>
                <?= Html::a('Submitted', ['proposals']) ?>
            </li>
            <li>
                <?= Html::a('Reviewers', ['reviewers']) ?>
            </li>
            <li>
                <?= Html::a('Assigned', ['mgf-project-evaluation/index']) ?>
            </li>
        </div>
    </div>
</div>