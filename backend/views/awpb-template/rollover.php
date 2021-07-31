<?php

use backend\models\AwpbTemplate;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */

$this->title = "Checklist for " .$model->fiscal_year ."";
$this->params['breadcrumbs'][] = ['label' => 'Rollover', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="card card-success card-outline">
    <div class="card-body">
         <h4>Year End Process Instructions</h4>
        <ol>
            <li>This process will enable you to rollover from <?= $model->fiscal_year?> to <?= $_model->fiscal_year?>.</li>
            <li>Click on "<span class="badge badge-success">Year End</span>" button to rollover to the <?= $_model->fiscal_year?>.</li>
            <li>Once the rollover to <?= $_model->fiscal_year?> is complete, you will not be able to process anything under <?= $model->fiscal_year ?> fiscal year.</li>
        </ol>
        <div class="card-header">
            <div class="card-title">
                   <?php
                if ($model->status == AwpbTemplate::STATUS_CURRENT_BUDGET) {
                  //  if (!empty($model->status_activities) && !empty($model->status_users)&& !empty($model->guideline_file)&& !empty($model->status_district)) {
                        ?>
                        <?=
                        Html::a('Year End',
                                ['awpb-template/rollover'],
                                [
                                    'class' => 'btn btn-success btn-xs',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to rollover to' . $_model->fiscal_year . ' fiscal year?'
                                        . '<br>Once the rollover process is complete, you will not be able to process anything under '. $model->fiscal_year . ' fiscal year',
                                        'method' => 'post',
                                    ],
                        ]);
                        ?>
                        <?php
                    //}
                }
                //This is a hack, just to use pjax for the delete confirm button
                $query = backend\models\User::find()->where(['id' => '-2']);
                $dataProvider = new \yii\data\ActiveDataProvider([
                    'query' => $query,
                ]);
                GridView::widget([
                    'dataProvider' => $dataProvider,
                ]);
                ?> 
            </div>
            <div class="card-tools">
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">

             
            </div>
            <div class="col-lg-5">
                <p></p>
            </div>
        </div>
    </div>
</div>
