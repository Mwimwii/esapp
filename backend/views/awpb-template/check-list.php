<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */

$this->title = "Checklist for" .$model_fiscal ."AWPB template";
$this->params['breadcrumbs'][] = ['label' => 'AWPB Template', 'url' => ['index']];
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
            <li>To attach the <code> <?php $model->fiscal_year?> Budget Guideline </code>, click the 
                <span class="badge badge-primary"><span class="fa fa-eye fa-2x"></span></span> 
                icon below.
            </li>
        </ol>
        <div class="card-header">
            <div class="card-title">
                <?php
                echo Html::a(
                        '<span class="fa fa-eye fa-2x"></span>', ['view', 'id' => $model->id], [
                    'title' => 'View story details',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'data-pjax' => '0',
                    'style' => "padding:10px;",
                    'class' => 'bt btn-lg'
                        ]
                );
                if ($model->status == 0 || $model->status == 3) {
                    echo Html::a('<i class="fas fa-trash fa-2x"></i>', ['delete', 'id' => $model->id], [
                        'title' => 'Remove Story',
                        'data-placement' => 'top',
                        'data-toggle' => 'tooltip',
                        'style' => "padding:30px;",
                        'data' => [
                            'confirm' => 'Are you sure you want to remove story: ' . $model->title . '?',
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
                                if ($model->status == 1) {
                                    echo Html::a('<i class="fa fa-link"></i> Update section', ['update', 'id' => $model->id]);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($model->) && !empty($model->category_id) &&
                                        !empty($model->interviewee_names) && !empty($model->interviewer_names) &&
                                        !empty($model->date_interviewed)) {
                                    echo '<span class="badge badge-success">COMPLETED</span>';
                                } else {
                                    echo '<span class="badge badge-danger">INCOMPLETE</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Budget Guideline</b>&emsp;&emsp;
                                <?php
                                if ($model->status == 0 || $model->status == 3) {
                                    echo Html::a('<i class="fa fa-link"></i> Update section', ['/storyofchange/introduction', 'id' => $model->id]);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($model->introduction)) {
                                    echo '<span class="badge badge-success">COMPLETED</span>';
                                } else {
                                    echo '<span class="badge badge-danger">INCOMPLETE</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Budget Committee</b> (Users allowed to conduct budgeting activities)&emsp;&emsp;
                                <?php
                                if ($model->status == 0 || $model->status == 3) {
                                    echo Html::a('<i class="fa fa-link"></i> Update section', ['/storyofchange/challenges', 'id' => $model->id]);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($model->challenge)) {
                                    echo '<span class="badge badge-success">COMPLETED</span>';
                                } else {
                                    echo '<span class="badge badge-danger">INCOMPLETE</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>The action</b> (what was done, how, by and with who etc)&emsp;&emsp;
                                <?php
                                if ($model->status == 0 || $model->status == 3) {
                                    echo Html::a('<i class="fa fa-link"></i> Update section', ['storyofchange/actions', 'id' => $model->id]);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($model->actions)) {
                                    echo '<span class="badge badge-success">COMPLETED</span>';
                                } else {
                                    echo '<span class="badge badge-danger">INCOMPLETE</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>The result</b> (what changed – what difference was made)&emsp;&emsp;
                                <?php
                                if ($model->status == 0 || $model->status == 3) {
                                    echo Html::a('<i class="fa fa-link"></i> Update section', ['/storyofchange/results', 'id' => $model->id]);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($model->results)) {
                                    echo '<span class="badge badge-success">COMPLETED</span>';
                                } else {
                                    echo '<span class="badge badge-danger">INCOMPLETE</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>The conclusions</b>&emsp;&emsp;
                                <?php
                                if ($model->status == 0 || $model->status == 3) {
                                    echo Html::a('<i class="fa fa-link"></i> Update section', ['/storyofchange/conclusions', 'id' => $model->id]);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($model->conclusions)) {
                                    echo '<span class="badge badge-success">COMPLETED</span>';
                                } else {
                                    echo '<span class="badge badge-danger">INCOMPLETE</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>The sequel</b> (what next)&emsp;&emsp;
                                <?php
                                if ($model->status == 0 || $model->status == 3) {
                                    echo Html::a('<i class="fa fa-link"></i> Update section', ['/storyofchange/sequel', 'id' => $model->id]);
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($model->sequel)) {
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
                if ($model->status == 0 || $model->status == 3) {
                    if (!empty($model->sequel) && !empty($model->conclusions) &&
                            !empty($model->results) && !empty($model->actions) && !empty($model->challenge) &&
                            !empty($model->introduction)) {
                        ?>
                        <?=
                        Html::a('Submit for review',
                                ['storyofchange/submit-story', 'id' => $model->id],
                                [
                                    'class' => 'btn btn-success btn-xs',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to submit story:"' . $model->title . '" for review?'
                                        . '<br>You will not be able to make changes to the story once submitted',
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
                <p>Story of change media</p>
            </div>
        </div>
    </div>
</div>
