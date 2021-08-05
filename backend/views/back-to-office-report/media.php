<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */

$this->title = 'Media upload';
$this->params['breadcrumbs'][] = ['label' => 'My back to office reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Report details", 'url' => ['view', 'id' => $model2->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Upload media</a>
            </li>
            <li class="nav-item">
                <?php
                echo Html::a('Back to office report', ['view', 'id' => $model2->id], ['class' => 'nav-link']);
                ?>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                <h5>Instructions</h5>
                <ol>
                    <li>Form below allows you to upload Back to Office media<code>(<?= $type ?>)</code>
                    </li>
                    <li>You can only add one file at a time hence the system will redirect you to this page until you are done uploading all media files
                    </li>
                    <li>Once you are done adding media, click
                        <?php
                        echo '"' . Html::a('Back to office report', ['view', 'id' => $model2->id], ['class' => '']) . '" to view Case study story details';
                        ?>
                    </li>
                    <li>
                        <?php
                        if ($type == "Image") {
                            echo 'To add videos, click "' . Html::a('Add video', ['media', 'id' => $model2->id, "type" => "Video"], ['class' => '']) . '"';
                        } else {
                            echo 'To add image, click "' . Html::a('Add image', ['media', 'id' => $model2->id, "type" => "Image"], ['class' => '']) . '"';
                        }
                        ?>
                    </li>
                </ol>     


<?php
$form = ActiveForm::begin([
            'action' => 'media?id=' . $model2->id . '&type=' . $type,
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
if (!empty($type)) {
    $model->type = $type;
}
echo $form->field($model, 'type')
        ->dropDownList(
                [
                    "Image" => 'Image',
                    'Video' => 'Video'
                ], ['prompt' => 'Select media type', 'required' => true, 'class' => "form-group", "disabled" => "disabled"]
        )->label("Media type");
?>
                        <?php
                        if ($type == "Image") {
                            echo $form->field($model, 'file')->widget(FileInput::classname(), [
                                'options' => [
                                    //'multiple' => true,
                                    'accept' => 'image/*',
                                ],
                                'pluginOptions' => [
                                    'previewFileType' => 'any',
                                    'showCancel' => false,
                                    'showRemove' => false,
                                    'showUpload' => false,
                                    'maxFileSize' => 1028000,
                                    'allowedFileExtensions' => ['jpg', 'jpeg', 'png'],
                                ]
                            ]);
                        }
                        if ($type == "Video") {
                            echo $form->field($model, 'file')->widget(FileInput::classname(), [
                                'options' => [
                                    //'multiple' => true,
                                    'accept' => 'video/*',
                                ],
                                'pluginOptions' => [
                                    'previewFileType' => 'any',
                                    'showCancel' => false,
                                    'showRemove' => false,
                                    'showUpload' => false,
                                    'maxFileSize' => 1028000,
                                    'allowedFileExtensions' => ['mp4'],
                                ]
                            ]);
                        }
                        ?>
                    </div>
                    <div class="col-lg-12 form-group">&nbsp;</div>
                    <div class="col-lg-12 form-group">
<?= Html::submitButton('Save media', ['class' => 'btn btn-success btn-sm']) ?>
                    </div>
                </div>
<?php ActiveForm::end() ?>

            </div>
        </div>
    </div>
    <!-- /.card -->
</div>

