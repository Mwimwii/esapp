<?php

use backend\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfOrganisationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'MGF Organisations';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card card-success card-outline">
    <div class="card-body">
    <h3><?= Html::encode($this->title) ?></h3>
    <hr class="dotted short">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cooperative',
            'acronym',
            'registration_type',
            'registration_no',
            //'trade_license_no',
            //'registration_date',
            //'business_objective:ntext',
            'email_address:email',
            'district.name',
            //'physical_address',
            //'tel_no',
            //'applicant_id',
            //'date_created',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{update}',
            'buttons' => [
                'view' => function ($url, $model) {
                    if (User::userIsAllowedTo('View MGF Organisations')) {
                        return Html::a(
                                        '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                    'title' => 'View',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'data-pjax' => '0',
                                    'style' => "padding:5px;",
                                    'class' => 'bt btn-lg'
                                        ]
                        );
                    }
                },

                'update' => function ($url, $model) {
                    if (User::userIsAllowedTo('Update MGF Organisation')) {
                        return Html::a(
                                        '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id], [
                                    'title' => 'Update',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    // 'target' => '_blank',
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
    </div>
</div>

