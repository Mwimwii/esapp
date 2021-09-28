<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\User;

//use Yii;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfApplicantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MGF Applicants';
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
                'first_name',
                'last_name',
                'mobile',
                'applicant_type',
                'district.name',
                'date_created',
                ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        if (User::userIsAllowedTo('View MGF Applicants')) {
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
                ]
            ]
            ],
        ]); ?>
    </div>
</div>

