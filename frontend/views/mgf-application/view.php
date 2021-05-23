<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfApplication */

\yii\web\YiiAsset::register($this);
$this->title = 'MGF Application';
?>
<div class="mgf-application-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'applicant.first_name',
            'applicant.last_name',
            'organisation.cooperative',
            'application_status',
            'date_created',
            'date_submitted',
        ],
    ]) ,Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index','status'=>4], ['class' => 'btn btn-default']);?>

</div>

<div id="accordion">
  <?php if($applicant->applicant_type=="Category-A"){}else{?>
  <div class="card">
    <div class="card-header" id="headingSelection">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSelection" aria-expanded="false" aria-controls="collapseSelection">
          Selection Criteria
        </button>
      </h5>
    </div>
    <div id="collapseSelection" class="collapse" aria-labelledby="collapseSelection" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-bordered border-primary">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Project</th>
            <th scope="col">Criterion</th>
            <th scope="col">Satisfactory</th>
        </thead>
        <tbody>
          
          <?php  $i=1; ?>
          <?php foreach($criteria as $post):?>
          <tr class="table-active">
            <th scope="row"><?=$i; ?></th>
            <td><?=$post->conceptnote->project_title; ?></td>
            <td><?=$post->criterion; ?></td>
            <td>
                <?php if($post->satisfactory == NULL) {?>
                <?php }else if($post->satisfactory == 'YES') {?>
                  <i class="glyphicon glyphicon-ok" style="color:green"></i>
                <?php }else{ ?>
                  <i class="glyphicon glyphicon-remove" style="color:red"></i>
                <?php } ?>
            </td>
          </tr>
          <?php  $i=$i+1; ?>
          <?php endforeach; ?>
            
        </tbody>
      </table>
      </div>
    </div>
  </div>
<?php } ?>
</div>
</div>
