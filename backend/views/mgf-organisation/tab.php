<?php
use yii\helpers\Html;
if($_GET['status']==0){
<<<<<<< HEAD
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
            <?= Html::a('Window 1 Applications', ['/mgf-organisation/applications','status'=>1]) ?><br/>
            <?= Html::a('Window 2 Applications', ['/mgf-organisation/applications','status'=>2]) ?><br/>
        </div>
    </div>
</div>
       
   

=======
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

<div class="default" style="color:black;font-weight:bold">
<ul class="nav nav-tabs">
<?php if($_GET['status']==0) {?>
    <li>
        <?= Html::a('All Applications', ['/mgf-application/index','status'=>4]) ?>
    </li>
    <li class="active">
        <?= Html::a('Submitted Applications', ['/mgf-organisation/applications','status'=>0]) ?>
    </li>
    <li>
        <?= Html::a('District Accepted Applications', ['/mgf-organisation/applications','status'=>1]) ?>
    </li>
    <li>
        <?= Html::a('Province Certified Applications', ['/mgf-organisation/applications','status'=>2]) ?>
    </li>
    <li>
        <?= Html::a('PCO Approved Applications', ['/mgf-organisation/applications','status'=>3]) ?>
    </li>

<?php }else if($_GET['status']==1){?>
    <li>
        <?= Html::a('All Applications', ['/mgf-application/index','status'=>4]) ?>
    </li>
    <li>
        <?= Html::a('Submitted Applications', ['/mgf-organisation/applications','status'=>0]) ?>
    </li>
    <li class="active">
        <?= Html::a('District Accepted Applications', ['/mgf-organisation/applications','status'=>1]) ?>
    </li>
    <li>
        <?= Html::a('Province Certified Applications', ['/mgf-organisation/applications','status'=>2]) ?>
    </li>
    <li>
        <?= Html::a('PCO Approved Applications', ['/mgf-organisation/applications','status'=>3]) ?>
    </li>
    <?php }else if($_GET['status']==2){?>
    <li>
        <?= Html::a('All Applications', ['/mgf-application/index','status'=>4]) ?>
    </li>
    <li>
        <?= Html::a('Submitted Applications', ['/mgf-organisation/applications','status'=>0]) ?>
    </li>
    <li>
        <?= Html::a('District Accepted Applications', ['/mgf-organisation/applications','status'=>1]) ?>
    </li>
    <li class="active">
        <?= Html::a('Province Certified Applications', ['/mgf-organisation/applications','status'=>2]) ?>
    </li>
    <li>
        <?= Html::a('PCO Approved Applications', ['/mgf-organisation/applications','status'=>3]) ?>
    </li>
<?php }else if($_GET['status']==3){?>
    <li>
        <?= Html::a('All Applications', ['/mgf-application/index','status'=>4]) ?>
    </li>
    <li>
        <?= Html::a('Submitted Applications', ['/mgf-organisation/applications','status'=>0]) ?>
    </li>
    <li>
        <?= Html::a('District Accepted Applications', ['/mgf-organisation/applications','status'=>1]) ?>
    </li>
    <li>
        <?= Html::a('Province Certified Applications', ['/mgf-organisation/applications','status'=>2]) ?>
    </li>
    <li class="active">
        <?= Html::a('PCO Approved Applications', ['/mgf-organisation/applications','status'=>3]) ?>
    </li>

<?php }else{?>
    
    <li class="active">
        <?= Html::a('All Applications', ['/mgf-application/index','status'=>4]) ?>
    </li>
    <li>
        <?= Html::a('Submitted Applications', ['/mgf-organisation/applications','status'=>0]) ?>
    </li>
    <li>
        <?= Html::a('District Accepted Applications', ['/mgf-organisation/applications','status'=>1]) ?>
    </li>
    <li>
        <?= Html::a('Province Certified Applications', ['/mgf-organisation/applications','status'=>2]) ?>
    </li>
    <li>
        <?= Html::a('PCO Approved Applications', ['/mgf-organisation/applications','status'=>3]) ?>
    </li>

    
<?php }?>

</ul>
</div>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
