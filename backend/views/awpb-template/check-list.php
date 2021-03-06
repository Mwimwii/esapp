<?php

use backend\models\AwpbTemplate;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */

$this->title = "Checklist for " .$model->fiscal_year ." AWPB template";
$this->params['breadcrumbs'][] = ['label' => 'AWPB Template', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h4>Instructions</h4>
        <ol>
            <li>Click the blue "<span style="color:#007bff;"><i class="fa fa-link"></i> Update section </span>" link alongside a section to update a particular section.</li>
            <li>Completed sections can be edited by navigating to the forms in the same manner.</li>
            <li>Completed sections will be marked with <span class="badge badge-success"> COMPLETED </span> under the status column.</li>
            <li>Once all the sections have been completed a green "<span class="badge badge-success"> Publish </span>" button will appear at the bottom of the table. Click it to publish the AWPB template for Stakeholders to start budgeting.</li>
            <li>To attach the <code> <?php $model->fiscal_year?> Budget Guideline </code>, click the 
                <span class="badge badge-primary"><span class="fa fa-eye fa-2x"></span></span> 
                icon below.
            </li>
        </ol>
        <div class="card-header">
            <div class="card-title">
                <?php
                  echo Html::a(
                '<span class="fa fa-arrow-left fa-2x"></span>', ['index' ], [
            'title' => 'Checklist',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data-pjax' => '0',
            'style' => "padding:20px;",
            'class' => 'bt btn-lg'
                ]
        );
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
                if ($model->status == AwpbTemplate::STATUS_DRAFT) {
                    echo Html::a('<i class="fas fa-trash fa-2x"></i>', ['delete', 'id' => $model->id], [
                        'title' => 'Delete Temaplate',
                        'data-placement' => 'top',
                        'data-toggle' => 'tooltip',
                        'style' => "padding:30px;",
                        'data' => [
                            'confirm' => 'Are you sure you want to remove ' . $model->fiscal_year . ' AWPB template?',
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
                            <th>Template Section</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Template  details</b>(i.e. Budget theme, schedule etc)&emsp;&emsp;
                                <?php
                                if ($model->status == AwpbTemplate::STATUS_DRAFT ||$model->status == AwpbTemplate::STATUS_PUBLISHED) {
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
                                if (!empty($model->guideline_file) ){
                                    echo '<span class="badge badge-success">COMPLETED</span>';
                                } else {
                                    echo '<span class="badge badge-danger">INCOMPLETE</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Activities</b>&emsp;&emsp;
                                <?php
                                if ($model->status == AwpbTemplate::STATUS_DRAFT ||$model->status == AwpbTemplate::STATUS_PUBLISHED) {
                                    echo Html::a('<i class="fa fa-link"></i> Update section', ['/awpb-template/activities', 'id' => $model->id]);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($model->status_activities)) {
                                    echo '<span class="badge badge-success">COMPLETED</span>';
                                } else {
                                    echo '<span class="badge badge-danger">INCOMPLETE</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Budget Team</b> (Users allowed to conduct budgeting activities)&emsp;&emsp;
                                <?php
                                if ($model->status == AwpbTemplate::STATUS_DRAFT ||$model->status == AwpbTemplate::STATUS_PUBLISHED) {
                                    echo Html::a('<i class="fa fa-link"></i> Update section', ['/awpb-template/template-users', 'id' => $model->id]);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($model->status_users)) {
                                    echo '<span class="badge badge-success">COMPLETED</span>';
                                } else {
                                    echo '<span class="badge badge-danger">INCOMPLETE</span>';
                                }
                                ?>
                            </td>
                        </tr>
                       
                                 <tr>
                            <td><b>Districts</b> (Districts where E-SAPP will undertaken activities)&emsp;&emsp;
                                <?php
                                if ($model->status == AwpbTemplate::STATUS_DRAFT ||$model->status == AwpbTemplate::STATUS_PUBLISHED) {
                                    echo Html::a('<i class="fa fa-link"></i> Update section', ['/awpb-template/template-districts', 'id' => $model->id]);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($model->status_district)) {
                                    echo '<span class="badge badge-success">COMPLETED</span>';
                                } else {
                                    echo '<span class="badge badge-danger">INCOMPLETE</span>';
                                }
                                ?>
                            </td>
                        </tr>
                       
           <tr>
                            <td><b>Funding Profile</b> (Set funding profile for each activity set above)&emsp;&emsp;
                                <?php
                                if (($model->status == AwpbTemplate::STATUS_DRAFT ||$model->status == AwpbTemplate::STATUS_PUBLISHED) && !empty($model->status_activities)) {
                                    echo Html::a('<i class="fa fa-link"></i> Update section', ['/awpb-template-activity/index', 'id' => $model->id]);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($model->status_funding)) {
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
                if ($model->status == AwpbTemplate::STATUS_DRAFT) {
                    if (!empty($model->status_activities) && !empty($model->status_users)&& !empty($model->guideline_file)&& !empty($model->status_district)) {
                        ?>
                        <?=
                        Html::a('Publish AWPB Template',
                                ['awpb-template/publish', 'id' => $model->id],
                                [
                                    'class' => 'btn btn-success btn-xs',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to publish the ' . $model->fiscal_year . '" AWPB Template?'
                                        . '<br>Once published, you will not be able to make changes to the AWPB Template',
                                        'method' => 'post',
                                    ],
                        ]);
                        ?>
                        <?php
                    }
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
            <div class="col-lg-5">
                <p></p>
            </div>
        </div>
    </div>
</div>
