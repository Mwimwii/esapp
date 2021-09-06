<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use backend\models\Storyofchange;
use yii\helpers\Url;
use kartik\tabs\TabsX;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model backend\models\MeBackToOfficeReport */

$this->title = "BtOR report #" . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'My Back to office reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<ol>
    <li>
        To attach annexes <code>(pictures and/or videos)</code> to this Back to Office report, click the
        <span class="badge badge-primary">Annexes tab</span> 
        then attach/update files from there
    </li>
</ol>
<div class="card card-success card-outline">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="introduction-tab" data-toggle="pill" href="#introduction" role="tab" aria-controls="introduction" aria-selected="true">Report details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="challenges-tab" data-toggle="pill" href="#challenges" role="tab" aria-controls="challenges" aria-selected="false">Annexes</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade show active" id="introduction" role="tabpanel" aria-labelledby="introduction-tab">

                <p>
                    <?php
                    if ($model->status == 0 || $model->status == 3) {
                        echo Html::a(
                                '<span class="fa fa-edit"></span>', ['update', 'id' => $model->id], [
                            'title' => 'Edit report',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'data-pjax' => '0',
                            'style' => "padding:10px;",
                            'class' => 'bt btn-lg'
                                ]
                        );
                    }

                    if ($model->status == 0 || $model->status == 3) {
                        echo Html::a(
                                '<span class="fa fa-paper-plane"></span>', ['submit-for-review', 'id' => $model->id], [
                            'title' => 'Submit for review',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'data' => [
                                'confirm' => 'Are you sure you want to submit this Back to office report?<br/>'
                                . 'You will not be able to make changes to the report once submitted',
                                'method' => 'post',
                            ],
                            'style' => "padding:10px;",
                            'class' => 'bt btn-lg'
                                ]
                        );
                    }
                    if ($model->status == 0) {
                        echo Html::a(
                                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                            'title' => 'Remove report',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'data' => [
                                'confirm' => 'Are you sure you want to remove this Back to office report?',
                                'method' => 'post',
                            ],
                            'style' => "padding:10px;",
                            'class' => 'bt btn-lg'
                                ]
                        );
                    }
                    //This is a hack, just to use pjax for the delete confirm button
                    $query = \backend\models\User::find()->where(['id' => '-2']);
                    $dataProvider = new \yii\data\ActiveDataProvider([
                        'query' => $query,
                    ]);
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                    ]);
                    ?>
                </p>

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
                                if ($model->status == Storyofchange::_accepted) {
                                    $str = "<p class='badge badge-success'> "
                                            . "<i class='fa fa-check'></i> Accepted</p><br>";
                                } elseif ($model->status == Storyofchange::_submitted_for_review) {
                                    $str = "<p class='badge badge-info'> "
                                            . "<i class='fa fa-hourglass-half'></i> Submitted for review</p><br>";
                                } elseif ($model->status == Storyofchange::_resent_back) {
                                    $str = "<p class='badge badge-warning'> "
                                            . "<i class='fa fa-times'></i> Resent back. Requires changes</p><br>";
                                } else {
                                    $str = "<p class='badge badge-danger'> "
                                            . "<i class='fa fa-times'></i> Pending submision for review</p><br>";
                                }
                                return $str;
                            },
                        ],
                    // 'copy_sent_to:ntext',
                    // 'created_at',
                    // 'updated_at',
                    // 'created_by',
                    // 'updated_by',
                    ],
                ])
                ?>

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
                    $div .= '<div class="col-lg-12"> <p> 
                                                   ' . Html::a(Icon::show('file-audio', ['class' => '', 'framework' => Icon::FAS]) . ' Attach new video', ['media', 'id' => $model->id, "type" => "Video"], [
                                'title' => 'Attach video',
                                'data-placement' => 'top',
                                'data-toggle' => 'tooltip',
                                'style' => "padding:5px;",
                                "class" => "btn btn-primary btn-sm"
                            ]) . '
                                                    </p></div>';
                    foreach ($video_model as $_model) {
                        $_file = $_model->file;

                        $div .= '<div class="col-lg-6">
                                            <div class="card">
                                             <div class="card-body">
                                                <div style="margin: 0px;" class="embed-responsive embed-responsive-21by9">
                                                    <iframe class="embed-responsive-item" src="' . Url::to("@web/uploads/video/$_file") . '"></iframe>
                                                </div>
                                            </div> 
                                            <div class="card-footer">' .
                                Html::a('<span class="fa fa-edit fa-2x"></span>', ['update-media', 'id' => $_model->id, 'id1' => $model->id, "type" => "Video"], [
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
                                . '</div>'
                                . '</div>'
                                . '</div>';
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
                                                    <li> 
                                                        Click
                                                        <span class="badge badge-primary bt btn-md">Attach new video</span> button below to add another video
                                                    </li>
                                                </ul>
                                                <div class="row">' . $div . '</div>';
                } else {
                    $content_video = "<p>No videos found</p>" .
                            Html::a('<i class="fas fa-camera"></i> Attach video', ['media', 'id' => $model->id, "type" => "Video"], [
                                'title' => 'Attach video',
                                'data-placement' => 'top',
                                'data-toggle' => 'tooltip',
                                'style' => "padding:5px;",
                                "class" => "btn btn-primary btn-sm"
                    ]);
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
                                      <p><img title ="' . $_model->file_name . '" style="height: 450px;width: 300px;" class="d-block w-100" src="' . Url::to("@web/uploads/image/$_file") . '" alt="' . ($count + 1) . ' slide"></p>';
                        } else {
                            $divs .= '<div class="carousel-item">
                                     <p><img title ="' . $_model->file_name . '" style="height: 450px;width: 300px;" class="d-block w-100" src="' . Url::to("@web/uploads/image/$_file") . '" alt="' . $count . '" slide"></p>';
                            //$divs .= '<div class="carousel-item">
                            //  <p><img title ="' . $_model->file_name . '" style="height: 450px;width: 20px;" class="d-block w-100" src="' . Url::to("@web/uploads/image/$_file") . '" alt="' . $count . '" slide"></p>';
                        }
                        $divs .= '<div class="carousel-caption d-none d-md-block"><p style="padding:10px;">' . Html::a(
                                        '<span class="fa fa-edit fa-2x"></span>', ['update-media', 'id' => $_model->id, 'id1' => $model->id, "type" => "Image"], [
                                    'title' => 'Edit image',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data-pjax' => '0',
                                    'style' => "padding:15px;",
                                    'class' => 'bt btn-md'
                                        ]
                                ) .
                                Html::a('<i class="fas fa-trash fa-2x"></i>', ['delete-media', 'id' => $_model->id, 'id1' => $model->id], [
                                    'title' => 'Remove image',
                                    'data-placement' => 'top',
                                    'style' => "padding:10px;",
                                    'data-toggle' => 'tooltip',
                                    'class' => 'bt btn-md',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to remove image:' . $_model->file_name . ' from the story?',
                                        'method' => 'post',
                                    ],
                                ]) . '</p></div></div>';
                        $_count++;
                    }
                    $content_img = '<ul>
                                        <li> 
                                            Click
                                            <span class="badge badge-primary bt btn-md"><span class="fa fa-edit fa-1x"></span></span> 
                                            icon on the image to update image
                                             and 
                                            <span class="badge badge-primary bt btn-md"><span class="fas fa-trash-alt fa-1x"></span></span> 
                                            icon on the image to remove image
                                        </li>
                                        <li> 
                                            Click
                                            <span class="badge badge-primary bt btn-md">Attach new image</span> button below to add another image file
                                        </li>
                                    </ul>
                                     <div class="row">
                                     <div class="col-lg-12">' . Html::a(Icon::show('image', ['class' => '', 'framework' => Icon::FAS]) . ' Attach new image', ['media', 'id' => $model->id, "type" => "Image"], [
                                'title' => 'Attach images',
                                'data-placement' => 'top',
                                'data-toggle' => 'tooltip',
                                'style' => "padding:5px;",
                                "class" => "btn btn-primary btn-sm"
                            ]) . '</div>
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
                    $content_img = "<p>No images found</p>" .
                            Html::a(Icon::show('image', ['class' => '', 'framework' => Icon::FAS]) . ' Attach image', ['media', 'id' => $model->id, "type" => "Image"], [
                                'title' => 'Attach image',
                                'data-placement' => 'top',
                                'data-toggle' => 'tooltip',
                                'style' => "padding:5px;",
                                "class" => "btn btn-primary btn-sm"
                    ]);
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
