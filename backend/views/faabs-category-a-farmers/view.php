<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\MeFaabsCategoryAFarmers */
$name = $model->title . "" . $model->first_name . " " . $model->other_names . " " . $model->last_name;
$this->title = "View " . $name;
$this->params['breadcrumbs'][] = ['label' => 'Category \'A\' Farmers', 'url' => ['index']];
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
                if (\backend\models\User::userIsAllowedTo('Manage category A farmers')) {
                    echo Html::a('<span class="fas fa-edit fa-2x"></span>', ['update', 'id' => $model->id], [
                        'title' => 'Update farmer',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                    ]);
                }
                if (\backend\models\User::userIsAllowedTo('Remove category A farmers')) {
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    if ($model->status != 0) {
                        echo Html::a('<span class="fas fa-trash fa-2x"></span>', ['delete', 'id' => $model->id], [
                            'title' => 'Remove farmer',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'data' => [
                                'confirm' => 'Are you sure you want to remove Farmer?<br>'
                                . 'Farmer will only be removed if the system is not using their record!',
                                'method' => 'post',
                            ],
                        ]);
                    }
                }
            }
            ?>
        </p>
        <?php
        //This is a hack, just to use pjax for the delete confirm button
        $query = \backend\models\User::find()->where(['id' => '-2']);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
        GridView::widget([
            'dataProvider' => $dataProvider,
        ]);
        //$attributes=
        ?>
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                [
                    'label' => "Province",
                    'attribute' => 'province_id',
                    'value' => function ($model) {
                        $camp_id = \backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
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
                        $camp_id = \backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                        $district_id = \backend\models\Camps::findOne($camp_id)->district_id;
                        $name = backend\models\Districts::findOne($district_id)->name;
                        return $name;
                    },
                    'visible' => !empty(Yii::$app->user->identity->district_id) ? false : true
                ],
                [
                    'label' => "Camp",
                    'attribute' => 'camp_id',
                    'value' => function ($model) {
                        $camp_id = \backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->camp_id;
                        $name = backend\models\Camps::findOne($camp_id)->name;
                        return $name;
                    },
                  //  'visible' => !empty(Yii::$app->user->identity->district_id) ? false : true
                ],
                [
                    'attribute' => 'faabs_group_id',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $name = backend\models\MeFaabsGroups::findOne($model->faabs_group_id)->name;
                        return $name;
                    },
                ],
                [
                    'attribute' => 'title',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return str_replace(".", "", $model->title);
                    },
                ],
                'first_name',
                'other_names',
                'last_name',
                'sex',
                'dob',
                'age',
                'nrc',
                'marital_status',
                'contact_number',
                'relationship_to_household_head',
                'registration_date',
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => function($model) {
                        $str = "";
                        if ($model->status == 1) {
                            $str = "<span class='badge badge-success'> "
                                    . " Active</span><br>";
                        }
                        if ($model->status == 0) {
                            $str = "<span class='badge badge-danger'> "
                                    . "Inactive</span><br>";
                        }
                        return $str;
                    },
                    'format' => 'raw',
                ],
                'household_size',
                'village',
                'chiefdom',
                'block',
                'zone',
                'commodity',
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
