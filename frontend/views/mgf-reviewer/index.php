<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfReviewerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Reviewers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-reviewer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Reviewer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'login_code',
            'first_name',
            'last_name',
            //'mobile',
            //'reviewer_type',
            //'area_of_expertise:ntext',
            //'user_id',
            //'confirmed',
            //'createdBy',
            //'total_assigned_1',
            //'total_assigned_2',
            //'email:email',
            //'date_created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
