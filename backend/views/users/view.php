<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use \backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->title . "" . $model->first_name . " " . $model->other_name . " " . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <p>
            <?php
            if (\backend\models\User::userIsAllowedTo('Manage Users') && $model->status == User::STATUS_ACTIVE) {
                echo Html::a('<span class="fas fa-edit fa-2x"></span>', ['update', 'id' => $model->id], [
                    'title' => 'Update user',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                ]);
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                if ($model->status != 0) {
                    echo Html::a('<span class="fas fa-lock fa-2x"></span>', ['block', 'id' => $model->id], [
                        'title' => 'Block user',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'data' => [
                            'confirm' => 'Are you sure you want to block this user?',
                            'method' => 'post',
                        ],
                    ]);
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
                //  'id',
                [
                    'attribute' => 'type_of_user',
                    'format' => 'raw',
                    'label' => 'User type',
                ],
                [
                    'attribute' => 'province_id',
                    'format' => 'raw',
                    'label' => 'Province',
                    'value' => function ($model) {
                        return !empty($model->province_id) && $model->province_id > 0 ? backend\models\Provinces::findOne($model->province_id)->name : "";
                    },
                    'visible' => !empty($model->province_id) && $model->province_id > 0 ? TRUE : FALSE,
                ],
                [
                    'attribute' => 'district_id',
                    'format' => 'raw',
                    'label' => 'District',
                    'value' => function ($model) {
                        return !empty($model->district_id) && $model->district_id > 0 ? backend\models\Districts::findOne($model->district_id)->name : "";
                    },
                    'visible' => !empty($model->district_id) && $model->district_id > 0 ? TRUE : FALSE,
                ],
                [
                    'attribute' => 'camp_id',
                    'format' => 'raw',
                    'label' => 'Camp',
                    'value' => function ($model) {
                        return !empty($model->camp_id) && $model->camp_id > 0 ? backend\models\Camps::findOne($model->camp_id)->name : "";
                    },
                    'visible' => !empty($model->camp_id) && $model->camp_id > 0 ? TRUE : FALSE,
                ],
                [
                    'attribute' => 'role',
                    'format' => 'raw',
                    'label' => 'Role',
                    'value' => function ($model) {
                        return !empty($model->role) ? $model->role0->role : "";
                    },
                ],
                [
                    'attribute' => 'first_name',
                    'label' => 'Names',
                    'format' => 'raw',
                    "value" => function ($model) {
                        $name = "";
                        $user_model = \backend\models\User::findOne(["id" => $model->id]);
                        if (!empty($user_model)) {
                            $name = $user_model->title . "" . $user_model->first_name . " " . $user_model->other_name . " " . $user_model->last_name;
                        }
                        return $name;
                    }
                ],
                'sex',
                'phone',
                'nrc',
                //'username',
                'email',
                //'password_hash',
                //   'auth_key',
                // 'password_reset_token',
                //  'verification_token',
                [
                    'attribute' => 'status',
                     'value' => function ($model) {
                        $str = "";
                        if ($model->status == \backend\models\User::STATUS_ACTIVE) {
                            $str = "<span class='badge badge-success'> "
                                    . " Active</span><br>";
                        } elseif ($model->status == \backend\models\User::STATUS_INACTIVE) {
                            $str = "<span class='badge badge-danger'> "
                                    . "Blocked</span><br>";
                        } else {
                            $str = "<span class='badge badge-warning'> "
                                    . "MGF Status</span><br>";
                        }
                        return $str;
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'designation',
                    'label' => 'Designation',
                    'filter' => false,
                    'format' => 'raw',
                    'value' => function ($model) {
                        return !empty($model->rate) ? $model->rate->designation : "Not set";
                    }
                ],
                [
                    'label' => 'Created by',
                    'value' => function ($model) {
                        $user = \backend\models\User::findOne(['id' => $model->created_by]);
                        return !empty($user) ? $user->first_name . " " . $user->other_name . " " . $user->last_name . "-" . $user->email : "";
                    }
                ],
                [
                    'label' => 'Updated by',
                    'value' => function ($model) {
                        $user = \backend\models\User::findOne(['id' => $model->updated_by]);
                        return !empty($user) ? $user->first_name . " " . $user->other_name . " " . $user->last_name . "-" . $user->email : "";
                    }
                ],
                [
                    'label' => 'Updated at',
                    'value' => function ($model) {
                        return date('d-F-Y H:i:s', $model->updated_at);
                    }
                ],
                [
                    'label' => 'Created at',
                    'value' => function ($model) {
                        return date('d-F-Y H:i:s', $model->created_at);
                    }
                ],
            ],
        ])
        ?>

    </div>
</div>
