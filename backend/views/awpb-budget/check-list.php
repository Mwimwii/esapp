<?php

use backend\models\AwpbBudget;
use backend\models\AwpbTemplate;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */

$this->title = "Checklist for indicator number " .$model->indicator_id ;
$this->params['breadcrumbs'][] = ['label' => 'AWPB Indicator', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h4>Instructions</h4>
        <ol>
            <li>Click the blue "<span style="color:#007bff;"><i class="fa fa-link"></i> Update section</span>" link alongside a section to update a particular section.</li>
            <li>Completed sections can be edited by navigating to the forms in the same manner.</li>
            <li>Completed sections will be marked with <span class="badge badge-success">COMPLETED</span> under the status column.</li>
            <li>Once all the sections have been completed a green "<span class="badge badge-success">Publish</span>" button will appear at the bottom of the table. Click it to publish the AWPB template for Stakeholders to start budgeting.</li>
           
        </ol>
        <div class="card-header">
            <div class="card-title">
                <?php
                echo Html::a(
                        '<span class="fa fa-eye fa-2x"></span>', ['view', 'id' => $model->id], [
                    'title' => 'View template',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'data-pjax' => '0',
                    'style' => "padding:10px;",
                    'class' => 'bt btn-lg'
                        ]
                );
                if ($model->status == 0 || $model->status == 3) {
                    echo Html::a('<i class="fas fa-trash fa-2x"></i>', ['delete', 'id' => $model->id], [
                        'title' => 'Delete AWPB indicator',
                        'data-placement' => 'top',
                        'data-toggle' => 'tooltip',
                        'style' => "padding:30px;",
                        'data' => [
                            'confirm' => 'Are you sure you want to remove ' . $model->indicator .'?',
                            'method' => 'post',
                        ],
                    ]);
                }
                ?>
            </div>
            <div class="card-tools">
                <?php
               /* if (!empty($model)) {
                    echo Html::a('<i class="fas fa-camera fa-2x"></i> Attach media', ['media', 'id' => $model->id], [
                        'title' => 'Attach Case Study media',
                        'data-placement' => 'top',
                        'data-toggle' => 'tooltip',
                        'style' => "padding:5px;",
                    ]);
                }*/
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
        </div>
        <div class="row">
            <div class="col-lg-7">
                <table class="table">
                    <thead>
                        <tr>
                            <th>AWPB Indicator Section</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>AWPB Indicator details</b>(i.e. AWPB Targets etc)&emsp;&emsp;
                                <?php
                                if ($model->status == AwpbBudget::STATUS_DRAFT) {
                                    echo Html::a('<i class="fa fa-link"></i> Update section', ['update', 'id' => $model->id]);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                // if (!empty($model->preparation_deadline_first_draft) && !empty($model->submission_dealine) && !empty($model->consolidation_deadline) 
                                // && !empty($model->review_deadline) && !empty($model->preparation_deadline_second_draft) && !empty($model->review_deadline_pco) 
                                // && !empty($model->finalisation_deadline_pco) && !empty($model->submission_deadline_moa_mfl) && !empty($model->approval_deadline_jpsc) 
                                // && !empty($model->incorpation_deadline_pco_moa_mfl) && !empty($model->submission_dealine_ifad))
                                //
                                if (!empty($model->total_quantity) ){
                                    echo '<span class="badge badge-success">COMPLETED</span>';
                                } else {
                                    echo '<span class="badge badge-danger">INCOMPLETE</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Input</b>&emsp;&emsp;
                                <?php
                                 if ($model->status == AwpbBudget::STATUS_DRAFT) {
                                    echo Html::a('<i class="fa fa-link"></i> Update section', ['/awpb-template/activities', 'id' => $model->id]);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($model->total_amount)) {
                                    echo '<span class="badge badge-success">COMPLETED</span>';
                                } else {
                                    echo '<span class="badge badge-danger">INCOMPLETE</span>';
                                }
                                ?>
                            </td>
                        </tr>
                      

                    </tbody>

                </table>
                <?php
            
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
            <div class="col-lg-5">
                <p></p>
            </div>
        </div>
    </div>
</div>
