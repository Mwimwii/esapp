<?php

<<<<<<< HEAD
use backend\models\MgfPcoEligibility;
=======
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
use backend\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfOrganisationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
<<<<<<< HEAD
$eligibility=MgfPcoEligibility::findOne(['is_active'=>1]);
?>

=======
?>
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
<div class="card card-success card-outline">
    <div class="card-body">
        <h3><?= Html::encode($this->title) ?></h3>
        <hr class="dotted short">
            <?php include('tab3.php');?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'cooperative',
                    'acronym',
                    'business_objective:ntext',
                    'email_address:email',
                    'district.name',
                    'physical_address',
                    ['class' => 'yii\grid\ActionColumn','template' => '{open}',
                    'buttons' => [
                        'open' => function ($url, $model) {
<<<<<<< HEAD
                            if (User::userIsAllowedTo('Screen Eligibility')) {
=======
                            if (User::userIsAllowedTo('Review Concept Note')) {
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
                                return Html::a(
                                    '<span class="fa fa-folder-open"></span>', ['open', 'id' => $model->id], [
                                    'title' => 'Review',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data-pjax' => '0',
                                    'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                                    );
                                }
                            },
                        ]
                    ]
                ],
            ]); ?>
<<<<<<< HEAD
=======

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    </div>
</div>



        