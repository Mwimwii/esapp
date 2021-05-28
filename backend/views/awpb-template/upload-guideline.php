<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */

$this->title = 'Upload budget guideline';
$this->params['breadcrumbs'][] = ['label' => 'AWPB Template', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "AWPB Template Check list", 'url' => ['check-list', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Upload budget guideline</a>
            </li>
            <li class="nav-item">
                <?php
                if ($model->status == \backend\models\AwpbBudgetGuideline::STATUS_DRAFT) {
                    echo Html::a('AWPB Template Check list', ['check-list', 'id' => $model->id], ['class' => 'nav-link']);
                } else {
                    echo Html::a('View AWPB Template', ['view', 'id' => $model->id], ['class' => 'nav-link']);
                }
                ?>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                <h5>Instructions</h5>
                <ol>
                    <li>Form below allows you to upload the budget guideline file<code>(PDF Only)</code>
                    </li>
                    <li>You can only add one file per template s
                    </li>
                    <li>Select media type and Media file then click "<span class="badge badge-success">Save media</span>" button to save the media file
                    </li>
                   
                        <?php
                        if ($model->status == \backend\models\AwpbBudgetGuideline::STATUS_DRAFT) {
                            echo "<li>Once you are done adding media, click";
                            echo '"' . Html::a('AWPB Template Check list', ['check-list', 'id' => $model->id], ['class' => '']) . '" to continue with the Check list';
                        } else {
                            echo "<li>Once you are done, click";
                            echo '"' . Html::a('View AWPB Template', ['view', 'id' => $model->id], ['class' => '']) . '" to view AWPB template details';
                        }
                        ?>
                    </li>
                </ol>     


                <?php
                $form = ActiveForm::begin([
                            'action' => 'up-guideline?id=' . $model->id . '&id1=' . $model->id ,
                            'fieldConfig' => [
                                'options' => [
                                    'enctype' => 'multipart/form-data'
                                ],
                            ],
                ]);
                ?>
                <div class="row">
                    <div class="col-lg-6">
                       
                       
                        <?php
                      
                            echo $form->field($model, 'guideline_file')->widget(FileInput::classname(), [
                                'options' => [
                                    //'multiple' => true,
                                    'accept' => 'pdf/*',
                                ],
                                'pluginOptions' => [
                                    'previewFileType' => 'any',
                                    'showCancel' => false,
                                    'showRemove' => false,
                                    'showUpload' => false,
                                    'maxFileSize' => 1028000,
                                    'allowedFileExtensions' => ['pdf'],
                                ]
                            ]);
                        ?>
                    </div>
                    <div class="col-lg-12 form-group">&nbsp;</div>
                    <div class="col-lg-12 form-group">
                        <?= Html::submitButton('Upload Guideline', ['class' => 'btn btn-success btn-sm']) ?>
                    </div>
                </div>
                <?php ActiveForm::end() ?>

            </div>
        </div>
    </div>
    <!-- /.card -->
</div>

