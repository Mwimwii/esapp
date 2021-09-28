<?php
use yii\helpers\Html;
$status=0;
if($status==0){
    //$this->title = 'Project Activities';
}else if($status==1){
   // $this->title = 'Quantity of Inputs';
}else if($status==2){
   // $this->title = 'Costs of Inputs';
}else if($status==3){
    //$this->title = 'Input Finance Plan';
}
?>

  <h2></h2>

<div class="default" style="color:black;font-weight:bold">
    <ul class="nav nav-tabs">
        <?php if($status==0) {?>
            <li class="active">
                <?= Html::a('Cost Estimates', ['mgf-variable-fixed-cost/index']) ?>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <li>
                <?= Html::a('Quantity of Inputs', ['valueofproducttotals']) ?>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <li>
                <?= Html::a('Variable Costs Totals', ['variablefixedcosttotals']) ?>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;
            
           
        <?php }?>
    </ul>
</div>

