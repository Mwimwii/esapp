<?php
use yii\helpers\Html;
$status=$_GET['status'];
if($status==0){
    $this->title = 'Past Projects';
}else if($status==1){
    $this->title = 'Partnerships';
}
?>

  <h2><?= Html::encode($this->title) ?></h2>

<div class="default" style="color:black;font-weight:bold">
    <ul class="nav nav-tabs">
        <?php if($status==0) {?>
            <li class="active">
                <?= Html::a('Past Projects', ['view','id'=>$_GET['id'],'status'=>0]) ?>
            </li>
           
            <li>
                <?= Html::a('Partnerships', ['view','id'=>$_GET['id'],'status'=>1]) ?>
            </li>
            
        <?php }else{?>
           
            <li>
                <?= Html::a('Past Projects', ['view','id'=>$_GET['id'],'status'=>0]) ?>
            </li> 

            <li class="active">
                <?= Html::a('Partnerships', ['view','id'=>$_GET['id'],'status'=>1]) ?>
            </li>
        <?php }?>
    </ul>
</div>

