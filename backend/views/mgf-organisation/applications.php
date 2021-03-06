<?php

use backend\models\MgfDistrictEligibility;
use backend\models\MgfYear;
use backend\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfOrganisationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$year=MgfYear::findOne(['is_active'=>1]);

?>


<div class="card card-success card-outline">
    <div class="card-body">
        <h3><?= Html::encode($this->title) ?></h3>
        <hr class="dotted short">
            <?php include('tab.php');?>
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
                            if (User::userIsAllowedTo('Screen Eligibility')) {
                                return Html::a(
                                    '<span class="fa fa-folder-open"></span>', ['open', 'id' => $model->id], [
                                    'title' => 'Review',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data-pjax' => '0',
                                    'style' => "padding:5px;",
                                    'class' => 'bt btn-lg']
                                    );
                                }
                            },
                        ]
                    ]
                ],
            ]); ?>
    </div>
</div>



        
