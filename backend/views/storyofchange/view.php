<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use backend\models\User;
use backend\models\Storyofchange;
use yii\helpers\Url;
use kartik\tabs\TabsX;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */

$this->title = "View story ";
$this->params['breadcrumbs'][] = ['label' => 'My Stories of change', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
Icon::map($this, Icon::EL);
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <?php
            if ($model->status == 0 || $model->status == 3) {
                echo '<li>To edit full details of a Story, click the 
                <span class="badge badge-primary"><span class="fa fa-edit fa-2x"></span></span> 
                icon below
            </li>
            <li>To Remove this Story, click the 
                <span class="badge badge-primary"><span class="fa fa-trash fa-2x"></span></span> 
                icon below
            </li>';
            }
            ?>
            <li>To attach media <code>(Completed Interview guide pdf,audio, pictures, videos)</code> to this story, click the
                <span class="badge badge-primary"><span class="fa fa-camera fa-2x"></span></span> 
                icon below
            </li>
            <?php
            if ($model->status == 0 || $model->status == 3) {
                if (!empty($model->sequel) && !empty($model->conclusions) &&
                        !empty($model->results) && !empty($model->actions) && !empty($model->challenge) &&
                        !empty($model->introduction)) {
                    echo '<li>Click "<span class="badge badge-success">Submit for review</span>" button to submit this story for review.</li>';
                }
            }
            ?>
        </ol>
        <div class="card-header">
            <div class="card-title">
                <?php
                if ($model->status == 0 || $model->status == 3) {
                    echo Html::a(
                            '<span class="fa fa-edit fa-2x"></span>', ['check-list', 'id' => $model->id], [
                        'title' => 'Edit Story',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'data-pjax' => '0',
                        'style' => "padding:20px;",
                        'class' => 'bt btn-lg'
                            ]
                    );
                }
                if ($model->status == 0 || $model->status == 3) {
                    echo Html::a('<i class="fas fa-trash fa-2x"></i>', ['delete', 'id' => $model->id], [
                        'title' => 'Remove Story',
                        'data-placement' => 'top',
                        'style' => "padding:30px;",
                        'data-toggle' => 'tooltip',
                        'data' => [
                            'confirm' => 'Are you sure you want to remove story: ' . $model->title . '?',
                            'method' => 'post',
                        ],
                    ]);
                }


                if (!empty($model)) {
                    echo Html::a('<i class="fas fa-camera fa-2x"></i>', ['media', 'id' => $model->id], [
                        'title' => 'Attach Case Study media',
                        'data-placement' => 'top',
                        'data-toggle' => 'tooltip',
                        'style' => "padding:20px;",
                        'class' => 'bt btn-lg'
                    ]);
                }
                ?>
            </div>
            <div class="card-tools">

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
                ?> 
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
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
                                } elseif ($model->status == Storyofchange::_submitted_for_review) {
                                    $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-info'> "
                                            . "<i class='fa fa-times'></i> Submitted for review</p><br>";
                                } elseif ($model->status == Storyofchange::_resent_back) {
                                    $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-warning'> "
                                            . "<i class='fa fa-times'></i> Resent back. Requires changes</p><br>";
                                } else {
                                    $str = "<p style='margin:2px;padding:2px;display:inline-block;' class='badge badge-danger'> "
                                            . "<i class='fa fa-times'></i> Pending submision for review</p><br>";
                                }
                                return $str;
                            },
                        ],
                        [
                            'label' => 'IKM officer comments',
                            'attribute' => 'ikmo_comments',
                            'visible' => $model->status === Storyofchange::_resent_back || $model->status === Storyofchange::_accepted ? true : false
                        ],
                    ],
                ])
                ?>
            </div>

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
                                                . '<iframe src="' . Url::to("@web/uploads/documents/$_file") . '"width="100%" height="500px" ></iframe>'
                                                . Html::a('<span class="fa fa-download fa-2x"></span>', ['download', 'id' => $_model->id, 'id1' => $model->id],
                                                        [
                                                            'target' => '_blank',
                                                            'data-pjax' => '0',
                                                            'style' => "padding:15px;",
                                                            'title' => 'Download/View full',
                                                ]) .
                                                Html::a('<span class="fa fa-edit fa-2x"></span>', ['update-media', 'id' => $_model->id, 'id1' => $model->id], [
                                                    'class' => 'bt btn-md',
                                                    'title' => 'Update document',
                                                    'data-toggle' => 'tooltip',
                                                    'style' => "padding:15px;",
                                                    'data-placement' => 'top',
                                                ]) .
                                                Html::a('<span class="fa fa-trash fa-2x"></span>', ['delete-media', 'id' => $_model->id, 'id1' => $model->id], [
                                                    'class' => 'bt btn-md',
                                                    'title' => 'Remove interview guide document',
                                                    'data-toggle' => 'tooltip',
                                                    'style' => "padding:15px;",
                                                    'data-placement' => 'top',
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to remove interview guide document?',
                                                        'method' => 'post',
                                                    ],
                                                ]) . '</div>';
                                    }
                                    $content_doc = '<ol>
                                                    <li> 
                                                        Click
                                                        <span class="badge badge-primary bt btn-md"><span class="fa fa-download fa-1x"></span></span> 
                                                        icon to download/view full completed interview guide document 
                                                        </li>
                                                        <li>
                                                        Click
                                                        <span class="badge badge-primary bt btn-md"><span class="fa fa-edit fa-1x"></span></span> 
                                                        icon to update completed interview guide document
                                                        </li>
                                                        <li>
                                                        Click
                                                        <span class="badge badge-primary bt btn-md"><span class="fas fa-trash-alt fa-1x"></span></span> 
                                                        icon to remove completed interview guide document
                                                    </li>
                                                </ol><div class="row">' . $div . '</div>';
                                } else {
                                    $content_doc = "<p>No case study interview guide document found</p>" .
                                            Html::a('<i class="fas fa-camera"></i> Attach completed interview guide document', ['media', 'id' => $model->id], [
                                                'title' => 'Attach Case Study document',
                                                'data-placement' => 'top',
                                                'data-toggle' => 'tooltip',
                                                'style' => "padding:5px;",
                                                "class" => "btn btn-primary btn-sm"
                                    ]);
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
                                    </div></div> <div class="card-footer">' .
                                                Html::a('<span class="fa fa-edit fa-2x"></span>', ['update-media', 'id' => $_model->id, 'id1' => $model->id], [
                                                    'class' => 'bt btn-md',
                                                    'title' => 'Update video',
                                                    'data-toggle' => 'tooltip',
                                                    'style' => "padding:15px;",
                                                    'data-placement' => 'top',
                                                ]) .
                                                Html::a('<span class="fa fa-trash fa-2x"></span>', ['delete-media', 'id' => $_model->id, 'id1' => $model->id], [
                                                    'class' => 'bt btn-md',
                                                    'title' => 'Remove video',
                                                    'data-toggle' => 'tooltip',
                                                    'style' => "padding:15px;",
                                                    'data-placement' => 'top',
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to remove this video?',
                                                        'method' => 'post',
                                                    ],
                                                ])
                                                . '</div></div></div>';
                                    }
                                    $content_video = '<ul>
                                                    <li> 
                                                        Click
                                                        <span class="badge badge-primary bt btn-md"><span class="fa fa-edit fa-1x"></span></span> 
                                                        icon to update video
                                                         and 
                                                        <span class="badge badge-primary bt btn-md"><span class="fas fa-trash-alt fa-1x"></span></span> 
                                                        icon to remove video
                                                    </li>
                                                </ul><div class="row">' . $div . '</div>';
                                } else {
                                    $content_video = "<p>No case study videos found</p>" .
                                            Html::a('<i class="fas fa-camera"></i> Attach video', ['media', 'id' => $model->id], [
                                                'title' => 'Attach Case Study video',
                                                'data-placement' => 'top',
                                                'data-toggle' => 'tooltip',
                                                'style' => "padding:5px;",
                                                "class" => "btn btn-primary btn-sm"
                                    ]);
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
                                            <div class="card-footer">' .
                                                Html::a('<span class="fa fa-edit fa-2x"></span>', ['update-media', 'id' => $_model->id, 'id1' => $model->id], [
                                                    'class' => 'bt btn-md',
                                                    'title' => 'Update audio',
                                                    'data-toggle' => 'tooltip',
                                                    'style' => "padding:15px;",
                                                    'data-placement' => 'top',
                                                ]) .
                                                Html::a('<span class="fa fa-trash fa-2x"></span>', ['delete-media', 'id' => $_model->id, 'id1' => $model->id], [
                                                    'class' => 'bt btn-md',
                                                    'title' => 'Remove audio',
                                                    'data-toggle' => 'tooltip',
                                                    'style' => "padding:15px;",
                                                    'data-placement' => 'top',
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to remove this audio file?',
                                                        'method' => 'post',
                                                    ],
                                                ])
                                                . '</div>
                                        </div>
                                    </div>';
                                    }

                                    $content_audio = '<ul>
                                                    <li> 
                                                        Click
                                                        <span class="badge badge-primary bt btn-md"><span class="fa fa-edit fa-1x"></span></span> 
                                                        icon to update audio
                                                         and 
                                                        <span class="badge badge-primary bt btn-md"><span class="fas fa-trash-alt fa-1x"></span></span> 
                                                        icon to remove audio
                                                    </li>
                                                </ul><div class="row">' . $div . '</div>';
                                } else {
                                    $content_audio = "<p>No case study audio files found</p>" .
                                            Html::a('<i class="fas fa-camera"></i> Attach audio', ['media', 'id' => $model->id], [
                                                'title' => 'Attach Case Study audio',
                                                'data-placement' => 'top',
                                                'data-toggle' => 'tooltip',
                                                'style' => "padding:5px;",
                                                "class" => "btn btn-primary btn-sm"
                                    ]);
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
                                        $divs .= '<p style="padding:10px;">' . Html::a(
                                                        '<span class="fa fa-edit fa-3x"></span>', ['update-media', 'id' => $_model->id, 'id1' => $model->id], [
                                                    'title' => 'Edit image',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'top',
                                                    'data-pjax' => '0',
                                                    'style' => "padding:15px;",
                                                    'class' => 'bt btn-md'
                                                        ]
                                                ) .
                                                Html::a('<i class="fas fa-trash fa-3x"></i>', ['delete-media', 'id' => $_model->id, 'id1' => $model->id], [
                                                    'title' => 'Remove image',
                                                    'data-placement' => 'top',
                                                    'style' => "padding:10px;",
                                                    'data-toggle' => 'tooltip',
                                                    'class' => 'bt btn-md',
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to remove image:' . $_model->file_name . ' from the story?',
                                                        'method' => 'post',
                                                    ],
                                                ]) . '</p></div>';
                                        $_count++;
                                    }
                                    $content_img = '<ul>
                                                    <li> 
                                                        Click
                                                        <span class="badge badge-primary bt btn-md"><span class="fa fa-edit fa-1x"></span></span> 
                                                        icon below image to update image
                                                         and 
                                                        <span class="badge badge-primary bt btn-md"><span class="fas fa-trash-alt fa-1x"></span></span> 
                                                        icon below image to remove image
                                                    </li>
                                                </ul>
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
                                    $content_img = "<p>No Case study images found</p>" .
                                            Html::a('<i class = "fas fa-camera"></i> Attach images', ['media', 'id' => $model->id], [
                                                'title' => 'Attach Case Study images',
                                                'data-placement' => 'top',
                                                'data-toggle' => 'tooltip',
                                                'style' => "padding:5px;",
                                                "class" => "btn btn-primary btn-sm"
                                    ]);
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
                                                ]) . '</div>';
                                    }
                                    $content_article = '<ol>
                                                    <li> 
                                                        Click
                                                        <span class="badge badge-primary bt btn-md"><span class="fa fa-download fa-1x"></span></span> 
                                                        icon to download/view full article
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
