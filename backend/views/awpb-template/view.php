<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
//use kartik\grid\GridView;
use kartik\detail\DetailView;
use \backend\models\User;
//use kartik\file\FileInput;
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;
//use yii\widgets\DetailView;
use kartik\grid\GridView;
use borales\extensions\phoneInput\PhoneInput;
//use kartik\form\ActiveForm;
use backend\models\AwpbComponent;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use backend\models\Storyofchange;
use yii\helpers\Url;
use kartik\tabs\TabsX;
use kartik\icons\Icon;
use lo\widgets\modal\ModalAjax;
use backend\models\AwpbTemplate;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplate */

$this->title = $model->fiscal_year . ' AWPB Template';
$this->params['breadcrumbs'][] = ['label' => 'AWPB Template', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="card card-success card-outline">
    <div class="card-body">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>



<?php
echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['index', 'id' => $model->id], [
    'title' => 'back',
    'data-toggle' => 'tooltip',
    'data-placement' => 'top',
]);

echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
if (\backend\models\User::userIsAllowedTo('Setup AWPB')) {



      if ($model->status == AwpbTemplate::STATUS_DRAFT ||$model->status == AwpbTemplate::STATUS_PUBLISHED) {
        echo Html::a(
                '<span class="fa fa-edit fa-2x"></span>', ['check-list', 'id' => $model->id], [
            'title' => 'Update template',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data-pjax' => '0',
            'style' => "padding:20px;",
            'class' => 'bt btn-lg'
                ]
        );
      }
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
 if ($model->status == AwpbTemplate::STATUS_DRAFT ){
        echo Html::a(
                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
            'title' => 'delete template',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data' => [
                'confirm' => 'Are you sure you want to remove this template?',
                'method' => 'post',
            ],
            'style' => "padding:5px;",
            'class' => 'bt btn-lg'
                ]
        );
    }
}
?>
        <div clas="row">
            <div class="col-lg-12">

            <?php
            $attributes = [
                [
                    'columns' =>
                    [
                        [
                            'attribute' => 'budget_theme',
                            'label' => 'Budget Theme',
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:90%']
                        ],
                    ],
                ],
                [
                    'columns' =>
                    [
                        [
                            'attribute' => 'preparation_deadline_first_draft',
                            //'label' => 'Deadline for preparing the AWPB by participating institution',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:40%'],
                            'valueColOptions' => ['style' => 'width:10%']
                        ],
                        [
                            'attribute' => 'submission_deadline',
                            //'//label'=> 'Deadline for submitting the AWPB proposals to PCO',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:40%'],
                            'valueColOptions' => ['style' => 'width:10%']
                        ],
                    ],
                ],
                [
                    'columns' =>
                    [
                        [
                            'attribute' => 'consolidation_deadline',
                            //'label'=> 'Deadline for consolidating AWPB',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:40%'],
                            'valueColOptions' => ['style' => 'width:10%']
                        ],
                        [
                            'attribute' => 'review_deadline',
                            //'label' => 'Deadline for reviewing the draft AWPB by participating institution',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:40%'],
                            'valueColOptions' => ['style' => 'width:10%']
                        ],
                    ],
                ],
                [
                    'columns' =>
                    [
                        [
                            'attribute' => 'preparation_deadline_second_draft',
                            //'label' => 'Deadline for preparing the second AWPB Draft by participating institution',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:40%'],
                            'valueColOptions' => ['style' => 'width:10%']
                        ],
                        [
                            'attribute' => 'review_deadline_pco',
                            // 'label' => 'Deadline for review the AWPB by PCO',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:40%'],
                            'valueColOptions' => ['style' => 'width:10%']
                        ],
                    ],
                ],
                [
                    'columns' =>
                    [
                        [
                            'attribute' => 'finalisation_deadline_pco',
                            //'label' => 'Deadline for AWPB finalisation by PCO',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:40%'],
                            'valueColOptions' => ['style' => 'width:10%']
                        ],
                        [
                            'attribute' => 'submission_deadline_moa_mfl',
                            //'label' => 'Deadline for submitting AWPB to MoA/MFL',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:40%'],
                            'valueColOptions' => ['style' => 'width:10%']
                        ],
                    ],
                ],
                [
                    'columns' =>
                    [
                        [
                            'attribute' => 'approval_deadline_jpsc',
                            //'label' => 'Deadline for approving AWPB by JPSC',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:40%'],
                            'valueColOptions' => ['style' => 'width:10%']
                        ],
                        [
                            'attribute' => 'incorpation_deadline_pco_moa_mfl',
                            //'label' => 'Deadline for incorpating PCO Budget into MoA/MFL budget',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:40%'],
                            'valueColOptions' => ['style' => 'width:10%']
                        ],
                    ],
                ],
                [
                    'columns' =>
                    [
                        [
                            'attribute' => 'submission_deadline_ifad',
                            //'label' => 'Deadline for submitting AWPB to IFAD',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:40%'],
                            'valueColOptions' => ['style' => 'width:10%']
                        ],
                        [
                            'attribute' => 'comment_deadline_ifad',
                            //'label'=>'Deadline for receiving AWPB comments from IFAD',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:40%'],
                            'valueColOptions' => ['style' => 'width:10%']
                        ],
                    ],
                ],
                [
                    'columns' =>
                    [
                        [
                            'attribute' => 'distribution_deadline',
                            //'label'=>'Deadline for distributing the AWPB to institutions',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:40%'],
                            'valueColOptions' => ['style' => 'width:10%']
                        ],
                        [
                            'attribute' => 'comment',
                            //  'label' => 'Comment',
                            'displayOnly' => true,
                            'labelColOptions' => ['style' => 'width:10%'],
                            'valueColOptions' => ['style' => 'width:40%']
                        ],
                    ],
                ],
//     // 'created_at',
//     // 'updated_at',
//     // 'created_by',
//     // 'updated_by',
// ],
            ];
            ?>
                <?=
                DetailView::widget([
                    'model' => $model,
                    'hAlign' => 'left',
                    'attributes' => $attributes,
                ])
                ?>

            </div></div>

                <?php
                $form = ActiveForm::begin([
                ]);
                ?>
        <div clas="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="activities-tab" data-toggle="pill" href="#activities" role="tabs" aria-controls="activities" aria-selected="true">Activities</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="media-tab" data-toggle="pill" href="#media" role="tab" aria-controls="media" aria-selected="false">Budget Guidelines</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="article-tab" data-toggle="pill" href="#article" role="tab" aria-controls="article" aria-selected="false">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="article-tab" data-toggle="pill" href="#district" role="tab" aria-controls="district" aria-selected="false">District</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">


                            <div class="tab-pane fade show active" id="activities" role="tabpanel" aria-labelledby="activities-tab">
<?php
if (!empty($model->status_activities)) {


    echo $form->field($model, 'activities')->checkboxList(ArrayHelper::map(\backend\models\AwpbTemplateActivity::getActivities($model->id), 'activity_id', 'name'), [
        'item' => function ($index, $label, $name, $checked, $value) {
            $disable = true;
            $checked = 'checked';
            return "<label  > <input type='checkbox' {$checked} name='{$name}' disabled= $disable value='{$value}'> {$label} </label>";
        }
        , 'separator' => ' ', 'required' => true])->label(false);
} else {
    $content_user = "<p>No activities have been selected</p>";
}
?>
                            </div>
                            <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">


<?php
//Manage interview guide document
$content_doc = "";
// $document_model = \backend\models\LkmStoryofchangeMedia::find()
//       ->where(['story_id' => $model->id, "media_type" => "Completed Interview guide"])
//     ->all();
if (!empty($model->guideline_file)) {

    $_file = $model->guideline_file;
    $div = '<div class="col-6">'
           
            . Html::a('<span class="fa fa-download fa-2x"></span>', ['download-guideline', 'id' => $model->id, 'id1' => $model->id],
                    [
                        'target' => '_blank',
                        'data-pjax' => '0',
                        'style' => "padding:15px;",
                        'title' => 'Download/View full',
            ]) .
            Html::a('<span class="fa fa-edit fa-2x"></span>', ['upload-guideline', 'id' => $model->id, 'id1' => $model->id], [
                'class' => 'bt btn-md',
                'title' => 'Upload guideline',
                'data-toggle' => 'tooltip',
                'style' => "padding:15px;",
                'data-placement' => 'top',
            ]) .
            '</div>';

    $content_doc = '<ol>
                                                    <li> 
                                                        Click
                                                        <span class="badge badge-primary bt btn-md"><span class="fa fa-download fa-1x"></span></span> 
                                                        icon to download/view the budget guideline 
                                                        </li>
                                                        <li>
                                                        Click
                                                        <span class="badge badge-primary bt btn-md"><span class="fa fa-edit fa-1x"></span></span> 
                                                        icon to upload the budget guideline
                                                        </li>
                                                     
                                                </ol><div class="row">' . $div . '</div>';
} else {
    $content_doc = "<p>No budget guideline found</p>" .
            Html::a('<i class="fas fa-camera"></i> Attach budget guideline', ['upload-guideline', 'id' => $model->id, 'id1' => $model->id], [
                'title' => 'Attach budget guideline',
                'data-placement' => 'top',
                'data-toggle' => 'tooltip',
                'style' => "padding:5px;",
                "class" => "btn btn-primary btn-sm"
    ]);
}
echo $content_doc;
?>
                            </div>
                            <div class="tab-pane fade" id="article" role="tabpanel" aria-labelledby="article-tab">
                                <?php
                                $content_user = "";
                                if (!empty($model->status_users)) {



                                    echo $form->field($model, 'users')->checkboxList(ArrayHelper::map(\backend\models\AwpbTemplateUsers::getTemplateUsers($model->id), 'id', 'last_name'), [
                                        'item' => function ($index, $label, $name, $checked, $value) {
                                            $disable = true;
                                            $checked = 'checked';
                                            return "<label  > <input type='checkbox' {$checked} name='{$name}' disabled= $disable value='{$value}'> {$label} </label>";
                                        }
                                        , 'separator' => ' ', 'required' => true])->label(false);
                                } else {
                                    $content_user = "<p>No user has been selected</p>";
                                }

                                echo $content_user;
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
                            
                                             <div class="tab-pane fade" id="district" role="tabpanel" aria-labelledby="district-tab">
                                <?php
                                $content_district = "";
                                if (!empty($model->status_district)) {



                                    echo $form->field($model, 'districts')->checkboxList(ArrayHelper::map(\backend\models\AwpbDistrict::getAwpbDistricts($model->id), 'district_id', 'name'), [
                                        'item' => function ($index, $label, $name, $checked, $value) {
                                            $disable = true;
                                            $checked = 'checked';
                                            return "<label  > <input type='checkbox' {$checked} name='{$name}' disabled= $disable value='{$value}'> {$label} </label>";
                                        }
                                        , 'separator' => ' ', 'required' => true])->label(false);
                                } else {
                                    $content_district = "<p>No district has been selected</p>";
                                }

                                echo $content_district;
//                                //This is a hack, just to use pjax for the delete confirm button
//                                $query = backend\models\User::find()->where(['id' => '-2']);
//                                $dataProvider = new \yii\data\ActiveDataProvider([
//                                    'query' => $query,
//                                ]);
//                                GridView::widget([
//                                    'dataProvider' => $dataProvider,
//                                ]);
                                ?>
                            </div>
                            
                            
                            
                            
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
                                <?php ActiveForm::end(); ?>
    </div>

</div>

</div>
</div>
