<?php
use yii\helpers\Html;

if($status==0){
    $this->title = 'Project Activities';
}else if($status==1){
    $this->title = 'Quantity of Inputs';
}else if($status==2){
    $this->title = 'Costs of Inputs';
}else if($status==3){
    $this->title = 'Input Finance Plan';
}
?>

  <h2><?= Html::encode($this->title) ?></h2>

<div class="default" style="color:black;font-weight:bold">
    <ul class="nav nav-tabs">
        <?php if($status==0) {?>
            <li class="active">
                <?= Html::a('Project Activities', ['manage','id'=>$_GET['id']]) ?>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <li>
                <?= Html::a('Quantity of Inputs', ['inputitem','id'=>$_GET['id']]) ?>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <li>
                <?= Html::a('Costs of Inputs', ['itemcosts','id'=>$_GET['id']]) ?>
            </li>
           
            
        <?php }else if($status==1){?>
            <li>
                <?= Html::a('Project Activities', ['manage','id'=>$_GET['id']]) ?>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <li class="active">
                <?= Html::a('Quantity of Inputs', ['inputitem','id'=>$_GET['id']]) ?>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <li>
                <?= Html::a('Costs of Inputs', ['itemcosts','id'=>$_GET['id']]) ?>
            </li>
           

        <?php }else if($status==2){?>
            <li>
                <?= Html::a('Project Activities', ['manage','id'=>$_GET['id']]) ?>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <li>
                <?= Html::a('Quantity of Inputs', ['inputitem','id'=>$_GET['id']]) ?>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <li class="active">
                <?= Html::a('Costs of Inputs', ['itemcosts','id'=>$_GET['id']]) ?>
            </li>
            
            
        <?php }else{?>
            <li>
                <?= Html::a('Project Activities', ['manage','id'=>$_GET['id']]) ?>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <li>
                <?= Html::a('Quantity of Inputs', ['inputitem','id'=>$_GET['id']]) ?>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <li>
                <?= Html::a('Costs of Inputs', ['itemcosts','id'=>$_GET['id']]) ?>
            </li>

        <?php }?>
    </ul>
</div>

