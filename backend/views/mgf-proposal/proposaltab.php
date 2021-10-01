<?php
use yii\helpers\Html;
use yii\bootstrap\Tabs;
//echo $this->title;
?>


<div class="panel with-nav-tabs panel-primary">
<div class="panel-body">
<div class="btn btn-default" style="color:black;background:lightgray;font-weight:bold">
<ul class="nav nav-tabs nav-justified">
<?php if($this->title=="UNMARKED") {?>
    <li class="active">
        <?= Html::a('U N M A R K E D', ['open','id'=>$_GET['id']]) ?>
    </li>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <li>
        <?= Html::a('M A R K E D', ['marked','id'=>$_GET['id']]) ?>
    </li>
<?php }else{?>
    <li>
        <?= Html::a('U N M A R K E D', ['open','id'=>$_GET['id']]) ?>
    </li>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <li class="active">
        <?= Html::a('M A R K E D', ['marked','id'=>$_GET['id']]) ?>
    </li>
<?php }?>
</ul>
</div>
</div>
</div>



