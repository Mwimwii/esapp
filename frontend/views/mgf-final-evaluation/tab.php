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
    $this->title = 'Deffered Projects';
}
?>
  <h2><?= Html::encode($this->title) ?></h2>

<div class="default" style="color:black;font-weight:bold">
<ul class="nav nav-tabs">
<?php if($_GET['status']==0) {?>
    <li class="active">
        <?= Html::a('Proposal Evaluations', ['index','status'=>0]) ?>
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
<?php }else if($_GET['status']==1){?>
    <li>
        <?= Html::a('Proposal Evaluations', ['index','status'=>0]) ?>
    </li>
    <li class="active">
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
<?php }else if($_GET['status']==2){?>
    <li>
        <?= Html::a('Proposal Evaluations', ['index','status'=>0]) ?>
    </li>
    <li>
        <?= Html::a('Strongly Recommended', ['evaluations','status'=>1]) ?>
    </li>
    <li class="active">
        <?= Html::a('Recommended', ['evaluations','status'=>2]) ?>
    </li>
    <li>
        <?= Html::a('Not Recommended', ['evaluations','status'=>3]) ?>
    </li>
    <li>
        <?= Html::a('Deferred', ['evaluations','status'=>4]) ?>
    </li>
<?php }else if($_GET['status']==3){?>
    <li>
        <?= Html::a('All Applications', ['index','status'=>0]) ?>
    </li>
    <li>
        <?= Html::a('Strongly Recommended', ['evaluations','status'=>1]) ?>
    </li>
    <li>
        <?= Html::a('Recommended', ['evaluations','status'=>2]) ?>
    </li>
    <li class="active">
        <?= Html::a('Not Recommended', ['evaluations','status'=>3]) ?>
    </li>
    <li>
        <?= Html::a('Deferred', ['evaluations','status'=>4]) ?>
    </li>
<?php }else{?>
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
    <li class="active">
        <?= Html::a('Deferred', ['evaluations','status'=>4]) ?>
    </li>
<?php }?>

</ul>
</div>

