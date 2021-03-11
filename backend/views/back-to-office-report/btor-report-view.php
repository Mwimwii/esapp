<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use backend\models\Storyofchange;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeBackToOfficeReport */

$this->title = "Review BtOR report #" . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Back to office reports', 'url' => ['btor-reports']];
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
                        Review this BtOR and take action to either accept the report or send it back for more information using the form on the right below
                    </li>
                    <li>Fields marked with <i style="color:red;">*</i> are required
                    </li>
                </ol>
            <?php } ?>
        </div>
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
                        //  'id',
                        'name_of_officer',
                        [
                            'attribute' => "team_members",
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => "travel_dates",
                            'format' => 'raw',
                            'value' => function($model) {
                                return $model->start_date . " to " . $model->end_date;
                            }
                        ],
                        [
                            'attribute' => "key_partners",
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => "purpose_of_assignment",
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => "summary_of_assignment_outcomes",
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => "key_findings",
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => "key_recommendations",
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => "annexes",
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => "reviewer_comments",
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => function($model) {
                                $str = "";
                                if ($model->status == backend\models\Storyofchange::_accepted) {
                                    $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-success'> "
                                            . "<i class='fa fa-check'></i> Accepted</p><br>";
                                } else {
                                    $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-info'> "
                                            . "<i class='fa fa-hourglass-half'></i> Pending review</p><br>";
                                }
                                return $str;
                            },
                        ],
                    // 'copy_sent_to:ntext',
                    // 'created_at',
                    // 'updated_at',
                    // 'created_by',
                    //   'updated_by',
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
                    $model1 = new \backend\models\MeBackToOfficeReport();
                    $form = ActiveForm::begin(['action' => 'review-btor-action?id=' . $model->id,])
                    ?>
                    <?=
                            $form->field($model1, 'status')
                            ->dropDownList(
                                    [Storyofchange::_accepted => "Accept BtOR", Storyofchange::_resent_back => "Send back for more information"], ['custom' => true, 'prompt' => 'Select Action', 'required' => true]
                    );
                    ?>
                    <?=
                    $form->field($model1, 'reviewer_comments')->textarea(['rows' => 4, 'placeholder' =>
                        'Enter any comments for your action'])->label("Comments ");
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('Submit action', ['class' => 'btn btn-success btn-sm']) ?>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
