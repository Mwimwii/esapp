<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */

$this->title = 'Story of Change article upload';
$this->params['breadcrumbs'][] = ['label' => 'Stories of change', 'url' => ['stories']];
$this->params['breadcrumbs'][] = ['label' => "View Case study story", 'url' => ['story-view', 'id' => $model2->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">

    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <li>Form below allows you to upload Case Study articles<code>(Only PDF files)</code>
            </li>
            <li>Select browse article file, provide a description for the article if any then click "<span class="badge badge-success">Save article</span>" button to save the article details
            </li>
             <li>Fields marked with <code>*</code> are required
            </li>
        </ol>     


        <?php
        $form = ActiveForm::begin([
                    'action' => 'attach-article?id=' . $model2->id,
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
                /*   $form->field($model, 'media_type')
                  ->dropDownList(
                  [
                  "Completed Interview guide" => 'Completed Interview guide',
                  "Picture" => 'Picture',
                  "Audio" => "Audio",
                  'Video' => 'Video'
                  ], ['prompt' => 'Select media type', 'required' => true, 'class' => "form-group"]
                  )->label("Media type"); */
                ?>
                <?php
                echo $form->field($model, 'file')->widget(FileInput::classname(), [
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
                ])->label('Article file <code>*</code>');
                ?>
                
            </div>
            <div class="col-lg-6">
                <?=
                $form->field($model, 'description')->textarea(['rows' => 11, 'placeholder' =>
                    'Brief description of the article'])->label("Description");
                ?>
            </div>
            <div class="col-lg-12 form-group">&nbsp;</div>
            <div class="col-lg-12 form-group">
                <?= Html::submitButton('Save article', ['class' => 'btn btn-success btn-sm']) ?>
            </div>
        </div>
        <?php ActiveForm::end() ?>

    </div>
    <!-- /.card -->
</div>

