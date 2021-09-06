<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use backend\models\Storyofchange;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\tabs\TabsX;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model backend\models\MeBackToOfficeReport */

$this->title = "Review BtOR report #" . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Back to office reports', 'url' => ['btor-reports']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

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
<div class="card card-success card-outline">
    <div class="card-header">
        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="introduction-tab" data-toggle="pill" href="#introduction" role="tab" aria-controls="introduction" aria-selected="true">Review report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="challenges-tab" data-toggle="pill" href="#challenges" role="tab" aria-controls="challenges" aria-selected="false">Annexes</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade show active" id="introduction" role="tabpanel" aria-labelledby="introduction-tab">

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
            <div class="tab-pane fade" id="challenges" role="tabpanel" aria-labelledby="challenges-tab">
                <?php
                //Manage videos
                $content_video = "";
                $video_model = \backend\models\BackToOfficeAnnexes::find()
                        ->where(['btor_id' => $model->id, "type" => "Video"])
                        ->all();
                if (!empty($video_model)) {
                    $div = "";
                    foreach ($video_model as $_model) {
                        $_file = $_model->file;
                        $div .= '<div class="col-lg-6"><div class="card">
                                             <div class="card-body">
                                    <div style="margin: 0px;" class="embed-responsive embed-responsive-21by9">
                                        <iframe class="embed-responsive-item" src="' . Url::to("@web/uploads/video/$_file") . '"></iframe>
                                    </div></div></div></div>';
                    }
                    $content_video = '<div class="row">' . $div . '</div>';
                } else {
                    $content_video = "<p>No videos have been attached</p>";
                }
                //Manage images
                $content_img = "";
                $divs = "";
                $img_model1 = \backend\models\BackToOfficeAnnexes::find()
                        ->where(['btor_id' => $model->id, "type" => "Image"])
                        ->all();
                $_count = 0;
                $count = 0;
                if (!empty($img_model1)) {
                    foreach ($img_model1 as $_model) {
                        $divs .= '<ol class = "carousel-indicators">';
                        if ($count == 0) {
                            $divs .= '<li data-target = "#carouselExampleIndicators" data-slide-to = "' . $count . '" class = "active"></li>';
                        } else {
                            $divs .= '<li data-target = "#carouselExampleIndicators" data-slide-to = "' . $count . '"></li>';
                        }
                        $divs .= '</ol>';
                        $count++;
                    }

                    $divs .= '<div class="carousel-inner">';

                    foreach ($img_model1 as $_model) {
                        $_file = $_model->file;
                        if ($_count == 0) {
                            $divs .= '<div class="carousel-item active">
                                                                    <p><img title ="' . $_model->file_name . '" style="height: 550px;width: 30px;" class="d-block w-100" src="' . Url::to("@web/uploads/image/$_file") . '" alt="' . ($count + 1) . ' slide"></p>
                                                                  ';
                        } else {
                            $divs .= '<div class="carousel-item">
                                                                <p><img title ="' . $_model->file_name . '" style="height: 550px;width: 30px;" class="d-block w-100" src="' . Url::to("@web/uploads/image/$_file") . '" alt="' . $count . '" slide"></p>';
                        }
                        $divs .= '</div>';
                        $_count++;
                    }
                    $content_img = '
                                                 <div class="row">
                                                 <div  class="col-lg-2 text-center">&nbsp;</div>
                                    <div class="col-lg-8 text-center">
                                        <div class="card-body">
                                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">'
                            . $divs
                            . '</div>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span  class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                 <div  class="col-lg-2 text-center">&nbsp;</div>
                            </div>';
                } else {
                    $content_img = "<p>No images have been attached</p>";
                }

                $items = [
                    [
                        'label' => Icon::show('image', ['class' => '', 'framework' => Icon::FAS]) . ' Images',
                        'content' => $content_img,
                        'height' => TabsX::SIZE_X_SMALL,
                    //'linkOptions' => ['data-url' => \yii\helpers\Url::to(['/site/tabs-data'])]
                    ],
                    [
                        'label' => Icon::show('file-video', ['class' => '', 'framework' => Icon::FAS]) . ' Video',
                        'content' => $content_video,
                        'height' => TabsX::SIZE_X_SMALL,
                    // 'linkOptions' => ['data-url' => \yii\helpers\Url::to(['/site/tabs-data'])]
                    ],
                ];

                echo TabsX::widget([
                    'items' => $items,
                    'position' => TabsX::POS_ABOVE,
                    'encodeLabels' => false
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
