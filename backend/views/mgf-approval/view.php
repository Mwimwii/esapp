<?php

use frontend\models\MgfConceptNote;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfApproval */
$concept=MgfConceptNote::findOne($model->conceptnote_id);
$this->title = $concept->project_title;
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-approval-view">
<h2><?= Html::encode($this->title) ?></h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'application.organisation.cooperative',
            'scores',
            'review_remark:ntext',
            'review_submission',
            'reviewed_by',
            'certify_remark:ntext',
            'certify_submission',
            'certified_by',
            'approval_remark:ntext',
            'approve_submittion',
            'approved_by',
        ],
    ]), Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'], ['class' => 'btn btn-default']);
    ?>

</div>
