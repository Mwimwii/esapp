<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */

$this->title = 'Update Story of change ';
$this->params['breadcrumbs'][] = ['label' => 'My Stories of change', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Story Check list", 'url' => ['check-list', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card card-success card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Interview details</a>
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
                    <li>Fill out the form below.Click "<span style="color: #007bff;">Story Check list</span>" above to complete the other details
                    </li>
                    <li>Fields marked with <i style="color:red;">*</i> are required
                    </li>
                </ol>                    
                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>
