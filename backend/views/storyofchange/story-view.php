<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use backend\models\User;
use backend\models\Storyofchange;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */

$this->title = "View story ";
$this->params['breadcrumbs'][] = ['label' => 'Stories of change', 'url' => ['stories']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <div class="card-header">
            <?php
            if ($model->status == Storyofchange::_submitted_for_review) {
                ?>
                <h5>Instructions</h5>
                <ol>
                    <li>
                        Review this story and take action to either accept the story or send it back for more information using the form on the right below
                    </li>
                    <li>Fields marked with <i style="color:red;">*</i> are required
                    </li>
                </ol>
            <?php } ?>
        </div>
        &nbsp;
        <div class="row">
            <?php
            if ($model->status == Storyofchange::_submitted_for_review) {
                ?>
                <div class="col-lg-8">
                    <?php
                } else {
                    echo '<div class="col-lg-12">';
                }
                ?>
                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'province_id',
                            'value' => function ($model) {
                                //$province_id = backend\models\Districts::findOne($model->district_id)->province_id;
                                $name = !empty($model->province_id) ? backend\models\Provinces::findOne($model->province_id)->name : "";
                                return $name;
                            },
                        ],
                        [
                            'attribute' => 'district_id',
                            'value' => function ($model) {
                                $name = !empty($model->district_id) ? backend\models\Districts::findOne($model->district_id)->name : "";
                                return $name;
                            },
                        ],
                        [
                            'attribute' => 'camp_id',
                            'value' => function ($model) {
                                $name = !empty($model->camp_id) ? backend\models\Camps::findOne($model->camp_id)->name : "";
                                return $name;
                            },
                        ],
                        [
                            'attribute' => 'title',
                        ],
                        [
                            'attribute' => 'interviewee_names',
                        ],
                        [
                            'attribute' => 'interviewer_names',
                        ],
                        [
                            'attribute' => 'date_interviewed',
                        ],
                        [
                            'attribute' => 'status', 'format' => 'raw',
                            'value' => function($model) {
                                $str = "";
                                if ($model->status == Storyofchange::_accepted) {
                                    $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-success'> "
                                            . "<i class='fa fa-check'></i> Accepted</p><br>";
                                } else {
                                    $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-info'> "
                                            . "<i class='fa fa-hourglass-half'></i> Pending IKMO review</p><br>";
                                }
                                return $str;
                            },
                        ],
                    ],
                ])
                ?>
            </div>
            <?php
            if ($model->status == Storyofchange::_submitted_for_review) {
                ?>
                <div class="col-lg-4">
                    <p>Take action by filling in the form below</p>
                    <?php
                    $model1 = new Storyofchange();
                    $form = ActiveForm::begin(['action' => 'review-story-action?id=' . $model->id,])
                    ?>
                    <?=
                            $form->field($model1, 'status')
                            ->dropDownList(
                                    [Storyofchange::_accepted => "Accept Story", Storyofchange::_resent_back => "Send back for more information"], ['custom' => true, 'prompt' => 'Select Action', 'required' => true]
                    );
                    ?>
                    <?=
                    $form->field($model1, 'ikmo_comments')->textarea(['rows' => 4, 'placeholder' =>
                        'Enter any comments'])->label("Comments ");
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('Submit action', ['class' => 'btn btn-success btn-sm']) ?>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            <?php } ?>
            <div class="col-lg-12">
                <div class="card card-success card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="introduction-tab" data-toggle="pill" href="#introduction" role="tab" aria-controls="introduction" aria-selected="true">Introduction</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="challenges-tab" data-toggle="pill" href="#challenges" role="tab" aria-controls="challenges" aria-selected="false">Challenges</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="actions-tab" data-toggle="pill" href="#actions" role="tab" aria-controls="actions" aria-selected="false">Actions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="results-tab" data-toggle="pill" href="#results" role="tab" aria-controls="results" aria-selected="false">Results</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="conclusion-tab" data-toggle="pill" href="#conclusion" role="tab" aria-controls="conclusion" aria-selected="false">Conclusion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sequel-tab" data-toggle="pill" href="#sequel" role="tab" aria-controls="sequel" aria-selected="false">Sequel</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="media-tab" data-toggle="pill" href="#media" role="tab" aria-controls="media" aria-selected="false">Media</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                            <div class="tab-pane fade show active" id="introduction" role="tabpanel" aria-labelledby="introduction-tab">
                                <p><?= $model->introduction ?></p>
                            </div>
                            <div class="tab-pane fade" id="challenges" role="tabpanel" aria-labelledby="challenges-tab">
                                <p><?= $model->challenge ?></p>
                            </div>
                            <div class="tab-pane fade" id="actions" role="tabpanel" aria-labelledby="actions-tab">
                                <p><?= $model->actions ?></p>
                            </div>
                            <div class="tab-pane fade" id="results" role="tabpanel" aria-labelledby="results-tab">
                                <p><?= $model->results ?></p>
                            </div>
                            <div class="tab-pane fade" id="conclusion" role="tabpanel" aria-labelledby="conclusion-tab">
                                <p><?= $model->conclusions ?></p>
                            </div>
                            <div class="tab-pane fade" id="sequel" role="tabpanel" aria-labelledby="sequel-tab">
                                <p><?= $model->sequel ?></p>
                            </div>
                            <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                                <p>Story interview audio, pictures, videos etc</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </div>
</div>
