<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use backend\models\User;
use backend\models\Storyofchange;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\tabs\TabsX;
use kartik\icons\Icon;

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
            <?php } else { ?>
                <h5>Instructions</h5>
                <ol>
                    <li>Click <span class="badge badge-primary"><span class="fas fa-upload fa-1x"></span></span> 
                        icon below to attach articles that were generated from this Case Study Story
                    </li>
                    <li>Click <span class="badge badge-primary"><span class="fas fa-file-pdf fa-1x"></span></span> icon below to export story to PDF file
                    </li>
                </ol>
                <div class="card-tools">
                    <?=
                    Html::a('<i class="fas fa-upload fa-2x"></i>', ['attach-article', 'id' => $model->id], [
                        'title' => 'Attach Case Study article',
                        'data-placement' => 'top',
                        'data-toggle' => 'tooltip',
                        'style' => "padding:20px;",
                        'class' => 'bt btn-lg'
                    ]);
                    ?>
                    <?=
                    Html::a('<span class="fas fa-file-pdf fa-2x bt"></span>',
                            ['export-story', 'id' => $model->id],
                            [
                                'class' => 'bt btn-lg',
                                'target' => '_blank',
                                'title' => 'Export story to pdf',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                    ]);
                    ?>

                </div>
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
                            <li class="nav-item">
                                <a class="nav-link" id="article-tab" data-toggle="pill" href="#article" role="tab" aria-controls="article" aria-selected="false">Generated Articles</a>
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
                                <?php
                                //Manage interview guide document
                                $content_doc = "";
                                $document_model = \backend\models\LkmStoryofchangeMedia::find()
                                        ->where(['story_id' => $model->id, "media_type" => "Completed Interview guide"])
                                        ->all();
                                if (!empty($document_model)) {
                                    $div = "";
                                    foreach ($document_model as $_model) {
                                        $_file = $_model->file;
                                        $div .= '<div class="col-6">'
                                                . '<iframe src="' . Url::to("@web/uploads/documents/$_file") . '"width="100%" height="500px;" ></iframe>'
                                                . Html::a('<span class="fa fa-download fa-2x"></span>', ['download', 'id' => $_model->id, 'id1' => $model->id],
                                                        [
                                                            'target' => '_blank',
                                                            'data-pjax' => '0',
                                                            'style' => "padding:15px;",
                                                            'title' => 'Download/View full',
                                                ]) . '</div>';
                                    }
                                    $content_doc = '<ol>
                                                    <li> 
                                                        Click
                                                        <span class="badge badge-primary bt btn-md"><span class="fa fa-download fa-1x"></span></span> 
                                                        icon to download/view full completed interview guide document 
                                                        </li>
                                                </ol><div class="row">' . $div . '</div>';
                                } else {
                                    $content_doc = "<p>No case study interview guide document has been attached</p>";
                                }
                                //Manage videos
                                $content_video = "";
                                $video_model = \backend\models\LkmStoryofchangeMedia::find()
                                        ->where(['story_id' => $model->id, "media_type" => "Video"])
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
                                    $content_video = "<p>No case study videos have been attached</p>";
                                }

                                //Manage Audio
                                $content_audio = "";
                                $audio_model = \backend\models\LkmStoryofchangeMedia::find()
                                        ->where(['story_id' => $model->id, "media_type" => "Audio"])
                                        ->all();
                                if (!empty($audio_model)) {
                                    $div = "";
                                    foreach ($audio_model as $_model) {
                                        $_file = $_model->file;
                                        $div .= '<div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="text-center">
                                                    <span class="fas fa-music fa-4x"></span>
                                                </p>
                                                <p class="text-center">
                                                    <audio controls>
                                                        <source src="' . Url::to("@web/uploads/audio/$_file") . '" type="audio/mpeg" />
                                                    </audio>
                                                </p>
                                            </div>
                                        </div>
                                    </div>';
                                    }

                                    $content_audio = '<div class="row">' . $div . '</div>';
                                } else {
                                    $content_audio = "<p>No case study audio files have attached</p>";
                                }

                                //Manage images
                                $content_img = "";
                                $divs = "";
                                $img_model1 = \backend\models\LkmStoryofchangeMedia::find()
                                        ->where(['story_id' => $model->id, "media_type" => "Picture"])
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
                                    $content_img = "<p>No Case study images have been attached</p>";
                                }

                                $items = [
                                    [
                                        'label' => Icon::show('file-pdf', ['class' => '', 'framework' => Icon::FAS]) . ' Completed interview guide document',
                                        'content' => $content_doc,
                                        'active' => true,
                                        'height' => TabsX::SIZE_X_SMALL,
                                        'bordered' => true,
                                    ],
                                    [
                                        'label' => Icon::show('image', ['class' => '', 'framework' => Icon::FAS]) . ' Images',
                                        'content' => $content_img,
                                        'height' => TabsX::SIZE_X_SMALL,
                                    //'linkOptions' => ['data-url' => \yii\helpers\Url::to(['/site/tabs-data'])]
                                    ],
                                    [
                                        'label' => Icon::show('file-audio', ['class' => '', 'framework' => Icon::FAS]) . ' Audio',
                                        'content' => $content_audio,
                                        'height' => TabsX::SIZE_X_SMALL,
                                    // 'linkOptions' => ['data-url' => \yii\helpers\Url::to(['/site/tabs-data'])]
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
                            <div class="tab-pane fade" id="article" role="tabpanel" aria-labelledby="article-tab">
                                <?php
                                $content_article = "";
                                $article_model = \backend\models\LkmStoryofchangeArticle::find()
                                        ->where(['story_id' => $model->id])
                                        ->all();
                                if (!empty($article_model)) {
                                    $div = "";
                                    foreach ($article_model as $_model) {
                                        $_file = $_model->file;
                                        $div .= '<div class="col-6">'
                                                . '<iframe src="' . Url::to("@web/uploads/articles/$_file") . '"width="100%" height="500px;" ></iframe>'
                                                . Html::a('<span class="fa fa-download fa-2x"></span>', ['download-article', 'id' => $_model->id, 'id1' => $model->id],
                                                        [
                                                            'target' => '_blank',
                                                            'data-pjax' => '0',
                                                            'style' => "padding:15px;",
                                                            'title' => 'Download/View full',
                                                ]) . Html::a('<span class="fa fa-edit fa-2x"></span>', ['update-article', 'id' => $_model->id, 'id1' => $model->id], [
                                                    'class' => 'bt btn-md',
                                                    'title' => 'Update article',
                                                    'data-toggle' => 'tooltip',
                                                    'style' => "padding:15px;",
                                                    'data-placement' => 'top',
                                                ]) .
                                                Html::a('<span class="fa fa-trash fa-2x"></span>', ['delete-article', 'id' => $_model->id, 'id1' => $model->id], [
                                                    'class' => 'bt btn-md',
                                                    'title' => 'Remove case study article',
                                                    'data-toggle' => 'tooltip',
                                                    'style' => "padding:15px;",
                                                    'data-placement' => 'top',
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to remove this case study article?',
                                                        'method' => 'post',
                                                    ],
                                                ]) . '</div>';
                                    }
                                    $content_article = '<ol>
                                                    <li> 
                                                        Click
                                                        <span class="badge badge-primary bt btn-md"><span class="fa fa-download fa-1x"></span></span> 
                                                        icon to download/view full article,
                                                        <span class="badge badge-primary bt btn-md"><span class="fa fa-edit fa-1x"></span></span> 
                                                        icon to update article and
                                                        <span class="badge badge-primary bt btn-md"><span class="fas fa-trash-alt fa-1x"></span></span> 
                                                        icon to remove article
                                                    </li>
                                                </ol><div class="row">' . $div . '</div>';
                                } else {
                                    $content_article = "<p>No case study articles have been attached</p>";
                                }

                                echo $content_article;
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
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </div>
</div>
