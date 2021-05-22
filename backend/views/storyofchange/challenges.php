<?php

use yii\helpers\Html;
use kartik\editors\Summernote;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */

$this->title = 'Challenges: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'My Stories of change', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Story Check list", 'url' => ['check-list', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Update introduction</a>
            </li>
            <li class="nav-item">
                <?= Html::a('Story Check list', ['check-list', 'id' => $model->id], ['class' => 'nav-link']); ?>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                <h5>Instructions</h5>
                <ol>
                    <li>Fill out the Story challenges below.Click "<span style="color: #007bff;">Story Check list</span>" above to complete the other details
                    </li>
                    <li>Click "<span class="badge badge-success">Save story challenges</span>" button to save the challenges
                    </li>
                </ol>     

                <div class="row">
                    <?php
                    $form = ActiveForm::begin(['action' => 'challenges?id=' . $model->id])
                    ?>
                    <div class="col-lg-9">
                        <p>
                            <b>The challenge (what problem was being addressed):</b> Outlining the situation/problem that was being faced (which could be before the programme began).
                        </p>
                        <?=
                        $form->field($model, 'challenge')->widget(\yii\redactor\widgets\Redactor::className(),
                                [
                                    'clientOptions' => [
                                        'plugins' => ['clips', 'fontcolor', 'imagemanager']
                                    ]
                        ])->label(false);
                        ?>
                        <?php
                        /* echo $form->field($model, 'introduction')->widget(Summernote::class, [
                          'options' => ['placeholder' => 'Use a table to ']
                          ])->label(FALSE); */
                        ?>
                        <div class="form-group">
                            <?= Html::submitButton('Save story challenges', ['class' => 'btn btn-success btn-sm']) ?>

                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>
