<?php
use yii\helpers\Html;
if($_GET['status']==0){
    $this->title = 'Submitted Applications';
}else if($_GET['status']==1){
    $this->title = 'District Accepted Applications';
}else if($_GET['status']==2){
    $this->title = 'Province Certified Applications';
}else if($_GET['status']==3){
    $this->title = 'PCO Approved Applications';
}else{
    $this->title = 'All Applications';
}
?>

<h2><?= Html::encode($this->title) ?></h2>
       
<div class="margin">
    <div class="btn-group">
        <button type="button" class="btn btn-default">MGF Applications</button>
        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
            <?= Html::a('All Applications', ['/mgf-application/index','status'=>4]) ?><br/>
            <?= Html::a('Submitted Applications', ['/mgf-organisation/applications','status'=>0]) ?><br/>
            <?= Html::a('District Accepted', ['/mgf-organisation/applications','status'=>1]) ?><br/>
            <?= Html::a('Province Certified', ['/mgf-organisation/applications','status'=>2]) ?><br/>
            <?= Html::a('PCO Approved', ['/mgf-organisation/applications','status'=>3]) ?>
        </div>
    </div>
</div>
       
   

