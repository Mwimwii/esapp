<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingTopics */

$this->title = "Topic #".$model->id;
$this->params['breadcrumbs'][] = ['label' => 'FaaBS training topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <p>
            <?php
            if (User::userIsAllowedTo('Manage FaaBS training topics')) {
                echo Html::a('<i class="fas fa-pencil-alt fa-2x"></i>', ['update', 'id' => $model->id], [
                    'title' => 'Update topic',
                    'data-placement' => 'top',
                    'data-toggle' => 'tooltip'
                ]);
            }
            if (User::userIsAllowedTo('Remove FaaBS training topics')) {
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                echo Html::a('<i class="fas fa-trash fa-2x"></i>', ['delete', 'id' => $model->id], [
                    'title' => 'Remove topic',
                    'data-placement' => 'top',
                    'data-toggle' => 'tooltip',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this topic?<br>'
                        . 'Topic will only be removed if its not being used by the system!',
                        'method' => 'post',
                    ],
                ]);
            }
            //This is a hack, just to use pjax for the delete confirm button
            $query = User::find()->where(['id' => '-2']);
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
                'topic:ntext',
                'category:ntext',
                'subcomponent:ntext',
                'output_level_indicator:ntext'
            ],
        ])
        ?>

    </div>
</div>
