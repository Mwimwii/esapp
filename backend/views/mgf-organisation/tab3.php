<?php
use yii\helpers\Html;
if($_GET['status']==0){
    $this->title = 'MGF Eligilbility Applications: Windows 1 and 2';
}else if($_GET['status']==1){
    $this->title = 'Window 1 MGF Applications';
}else if($_GET['status']==2){
    $this->title = 'Window 2 MGF Applications';
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
            <?= Html::a('Window 1 Applications', ['/mgf-organisation/applications3','status'=>1]) ?><br/>
            <?= Html::a('Window 2 Applications', ['/mgf-organisation/applications3','status'=>2]) ?><br/>
        </div>
    </div>
</div>
       
   

