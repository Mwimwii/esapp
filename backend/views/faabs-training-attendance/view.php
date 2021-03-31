<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsTrainingAttendanceSheet */

$this->title = "Record #" . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'FaaBS Training Attendance records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$district_model = \backend\models\Districts::findOne(Yii::$app->user->identity->district_id);
$district = !empty($district_model) ? $district_model->name : "";

$_camp_ids = [];
$camp_ids = \backend\models\Camps::find()
        ->select(['id'])
        ->where(['district_id' => Yii::$app->user->identity->district_id])
        ->asArray()
        ->all();
if (!empty($camp_ids)) {
    foreach ($camp_ids as $id) {
        array_push($_camp_ids, $id['id']);
    }
}

$list = \backend\models\MeFaabsGroups::find()
        ->where(['IN', 'camp_id', $_camp_ids])
        ->andWhere(['status' => 1])
        ->orderBy(['name' => SORT_ASC])
        ->all();
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <p>
            <?php
            if (!empty($list)) {
                if (\backend\models\User::userIsAllowedTo('Submit FaaBS training records')) {
                    echo Html::a('<span class="fas fa-edit fa-2x"></span>', ['update', 'id' => $model->id], [
                        'title' => 'Update FaaBS Training attendance record',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                    ]);
                }
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                if (\backend\models\User::userIsAllowedTo('Remove FaaBS training records')) {
                    echo Html::a(
                            '<span class="fas fa-trash fa-2x"></span>', ['delete', 'id' => $model->id], [
                        'title' => 'Remove FaaBS training record',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'data' => [
                            'confirm' => 'Are you sure you want to remove this FaaBS training attendance record?',
                            'method' => 'post',
                        ],
                        'style' => "padding:5px;",
                            //'class' => 'bt btn-lg'
                            ]
                    );
                }
            }

            //This is a hack, just to use pjax for the delete confirm button
            $query = \backend\models\User::find()->where(['id' => '-2']);
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
                [
                    'label' => "Province",
                    'attribute' => 'province_id',
                    'value' => function ($model) {
                        $camp_id = backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                        $district_id = \backend\models\Camps::findOne($camp_id)->district_id;
                        $province_id = backend\models\Districts::findOne($district_id)->province_id;
                        $name = backend\models\Provinces::findOne($province_id)->name;
                        return $name;
                    },
                    'visible' => !empty(Yii::$app->user->identity->district_id) ? false : true
                ],
                [
                    'label' => "District",
                    'attribute' => 'district_id',
                    'value' => function ($model) {
                        $camp_id = backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                        $district_id = \backend\models\Camps::findOne($camp_id)->district_id;
                        $name = backend\models\Districts::findOne($district_id)->name;
                        return $name;
                    },
                    'visible' => !empty(Yii::$app->user->identity->district_id) ? false : true
                ],
                [
                    'attribute' => 'camp_id',
                    'label' => 'Camp',
                    'value' => function ($model) {
                        $camp_id = backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                        $name = backend\models\Camps::findOne($camp_id)->name;
                        return $name;
                    },
                ],
                [
                    'attribute' => 'faabs_group_id',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->name;
                    },
                ],
                [
                    'attribute' => 'farmer_id',
                    'format' => 'raw',
                    'value' => function($model) {
                        $_model = backend\models\MeFaabsCategoryAFarmers::findOne($model->farmer_id);
                        return !empty($_model) ? $_model->title . "" . $_model->first_name . " " . $_model->other_names . " " . $_model->last_name : "";
                    },
                ],
                'household_head_type',
                'youth_non_youth',
                [
                    'attribute' => "topic",
                    'value' => function($model) {
                        $_model = backend\models\MeFaabsTrainingTopics::findOne($model->topic);
                        return !empty($_model) ? $_model->topic : "";
                    },
                ],
                'facilitators:ntext',
                'partner_organisations:ntext',
                'training_date',
                [
                    'attribute' => "quarter",
                    'label' => 'Quarter trained in'
                ],
                'duration',
                [
                    'label' => 'Created by',
                    'value' => function($model) {
                        $user = \backend\models\User::findOne(['id' => $model->created_by]);
                        return !empty($user) ? $user->first_name . " " . $user->other_name . " " . $user->last_name . "-" . $user->email : "";
                    }
                ],
                [
                    'label' => 'Updated by',
                    'value' => function($model) {
                        $user = \backend\models\User::findOne(['id' => $model->updated_by]);
                        return !empty($user) ? $user->first_name . " " . $user->other_name . " " . $user->last_name . "-" . $user->email : "";
                    }
                ],
                [
                    'label' => 'Updated at',
                    'value' => function($model) {
                        return date('d F Y H:i:s', $model->updated_at);
                    }
                ],
                [
                    'label' => 'Created at',
                    'value' => function($model) {
                        return date('d F Y H:i:s', $model->created_at);
                    }
                ],
            ],
        ])
        ?>

    </div>
</div>
