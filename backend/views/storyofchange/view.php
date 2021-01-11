<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */

$this->title = "Checklist for story: " . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'My Stories of change', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h4>Instructions</h4>
        <ol>
            <li>Click the blue "<span style="color:blue;"><i class="fa fa-link"></i> Update section</span>" link alongside a section to update a particular section.</li>
            <li>Completed sections can be edited by navigating to the forms in the same manner.</li>
            <li>Completed sections will be marked with <span class="badge badge-success">COMPLETED</span> under the status column.</li>
            <li>Once all the sections have been completed a green "<span class="badge badge-success">Submit for review</span>" button will appear at the bottom of the table. Click it to submit this story of change for review.</li>
        </ol>
        <div class="card-header">
            <div class="card-title">
                <?php
                if ($model->status == 0) {
                    echo Html::a('<i class="fas fa-trash fa-2x"></i>', ['delete', 'id' => $model->id], [
                        'title' => 'Remove Story',
                        'data-placement' => 'top',
                        'data-toggle' => 'tooltip',
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
                if (!empty($model)) {
                    echo Html::a('<i class="fas fa-trash fa-2x"></i>', ['delete', 'id' => $model->id], [
                        'title' => 'Remove Story',
                        'data-placement' => 'top',
                        'data-toggle' => 'tooltip',
                        'data' => [
                            'confirm' => 'Are you sure you want to remove story: ' . $model->title . '?',
                            'method' => 'post',
                        ],
                    ]);
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
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Template Section</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Interview details(i.e. Story category,Title,Interviewer names,Interviewee names, Date of interview etc)&emsp;&emsp;
                        <?php
                        echo Html::a('<i class="fa fa-link"></i> Update section', ['update', 'id' => $model->id]);
                        ?>
                    </td>
                    <td>
                        <?php
                        if (!empty($model->title) && !empty($model->category_id) &&
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
                    <td>The introduction (2-3 sentences summary of the case study or success story)&emsp;&emsp;
                        <?php
                        echo Html::a('<i class="fa fa-link"></i> Update section', ['campus/update', 'id' => $model->id]);
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
                    <td>The challenge (what problem was being addressed)&emsp;&emsp;
                        <?php
                        if ($model->status == 0) {
                            echo Html::a('<i class="fa fa-link"></i> Update section', ['campus/update', 'id' => $model->id]);
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
                    <td>The action (what was done, how, by and with who etc)&emsp;&emsp;
                        <?php
                        if ($model->status == 0) {
                            echo Html::a('<i class="fa fa-link"></i> Update section', ['campus/update', 'id' => $model->id]);
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
                    <td>The result (what changed – what difference was made)&emsp;&emsp;
                        <?php
                        if ($model->status == 0) {
                            echo Html::a('<i class="fa fa-link"></i> Update section', ['campus/update', 'id' => $model->id]);
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
                    <td>The conclusions&emsp;&emsp;
                        <?php
                        if ($model->status == 0) {
                            echo Html::a('<i class="fa fa-link"></i> Update section', ['campus/update', 'id' => $model->id]);
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
                    <td>The sequel (what next)&emsp;&emsp;
                        <?php
                        if ($model->status == 0) {
                            echo Html::a('<i class="fa fa-link"></i> Update section', ['campus/update', 'id' => $model->id]);
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
        if ($model->status == 0 && !empty($model->sequel) && !empty($model->conclusions) &&
                !empty($model->results) && !empty($model->actions) && !empty($model->challenge) &&
                !empty($model->introduction)) {
            ?>
            <?= Html::a('Submit', ['submit for review', 'id' => $id], ['class' => 'btn btn-success btn-sm']); ?>
        <?php }
        ?> 
    </div>
</div>
