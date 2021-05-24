<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MeFaabsTrainingTopicEnrolmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Me Faabs Training Topic Enrolments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-faabs-training-topic-enrolment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Me Faabs Training Topic Enrolment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'faabs_id',
            'training_type',
            'topic_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
