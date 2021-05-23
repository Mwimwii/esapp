<?php
use yii\helpers\Html;
use yii\bootstrap\Tabs;
if($_GET['status']==0){
    $this->title = 'MGF Evaluations';
}else if($_GET['status']==1){
    $this->title = 'Strongly Recommended Projects';
}else if($_GET['status']==2){
    $this->title = 'Recommended Projects';
}else if($_GET['status']==3){
    $this->title = 'Not Recommended Projects';
}else if($_GET['status']==4){
    $this->title = 'Deferred Projects';
}
?>

<h3><?= Html::encode($this->title) ?></h3>
       
<div class="margin">
    <div class="btn-group">
        <button type="button" class="btn btn-default">Proposal Evaluations</button>
        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
            <li>
                <?= Html::a('All Applications', ['index','status'=>0]) ?>
            </li>
            <li>
                <?= Html::a('Strongly Recommended', ['evaluations','status'=>1]) ?>
            </li>
            <li>
                <?= Html::a('Recommended', ['evaluations','status'=>2]) ?>
            </li>
            <li>
                <?= Html::a('Not Recommended', ['evaluations','status'=>3]) ?>
            </li>
            <li>
                <?= Html::a('Deferred', ['evaluations','status'=>4]) ?>
            </li>
        </div>
    </div>
</div>
       
   



