<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfProjectEvaluation */

$this->title = $model->proposal->project_title. " Review";
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-project-evaluation-view">

    <h3><?= Html::encode($this->title) ?></h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'proposal.project_title',
            'organisation.cooperative',
            'window',
            'observation:ntext',
            'declaration:ntext',
            'totalscore',
            'decision',
            'date_created',
            'date_submitted',
            'date_reviewed',
        ],
    ]) ?>
    <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'], ['class' => 'btn btn-default']);?>
</div>
