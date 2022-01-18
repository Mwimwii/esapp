<?php

use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\editable\Editable;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <p>
            <?php
            if (\backend\models\User::userIsAllowedTo('Manage Users')) {
                echo Html::a('<i class="fa fa-plus"></i> Add User', ['create'], ['class' => 'btn btn-success btn-sm']);
            }
            ?>
        </p>
        <hr class="dotted short">
        <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                [
                    'attribute' => 'role',
                    'format' => 'raw',
                    'label' => 'Role',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => common\models\Role::getRoles(),
                    'filterInputOptions' => ['prompt' => 'Filter by role', 'class' => 'form-control', 'id' => null],
                    'value' => function ($model) {
                        return !empty($model->role) ? $model->role0->role : "";
                    },
                ],
                [
                    'attribute' => 'first_name',
                    'label' => 'Names',
                    'format' => 'raw',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => \backend\models\User::getFullNames(),
                    'filterInputOptions' => ['prompt' => 'Filter by names', 'class' => 'form-control', 'id' => null],
                    "value" => function ($model) {
                        $name = "";
                        $user_model = \backend\models\User::findOne(["id" => $model->id]);
                        if (!empty($user_model)) {
                            $name = $user_model->title . "" . $user_model->first_name . " " . $user_model->other_name . " " . $user_model->last_name;
                        }
                        return $name;
                    }
                ],
                //'username',
                //'last_name',
                //'other_name',
                //'sex',
                'email',
                //'institution_id',
                //'username',
                //'password_hash',
                //'auth_key',
                //'password_reset_token',
                //'verification_token',
                [
                    'class' => EditableColumn::className(),
                    'readonly' => function ($model) {
                        if ($model->status == \backend\models\User::STATUS_ACTIVE || $model->status == \backend\models\User::STATUS_INACTIVE) {
                            return false;
                        } else {
                            return true;
                        }
                    },
                    'attribute' => 'status',
                    'filter' => false,
                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => [User::STATUS_ACTIVE => 'Active', User::STATUS_INACTIVE => 'Blocked'],
                    'filterInputOptions' => ['prompt' => 'Filter by Status', 'class' => 'form-control', 'id' => null],
                    'class' => EditableColumn::className(),
                    'enableSorting' => true,
                    'format' => 'raw',
                    'editableOptions' => [
                        'asPopover' => false,
                        'options' => ['class' => 'form-control', 'prompt' => 'Select Status...'],
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'data' => [\backend\models\User::STATUS_ACTIVE => 'Active', User::STATUS_INACTIVE => 'Blocked'],
                    ],
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
                    'refreshGrid' => true,
                ],
                //'created_at',
                //'updated_at',
                //'updated_by',
                //'created_by',
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            if (User::userIsAllowedTo('View Users')) {
                                return Html::a(
                                                '<span class="fa fa-eye"></span>', ['view', 'id' => $model->id], [
                                            'title' => 'View user',
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
                            if (User::userIsAllowedTo('Manage Users') && $model->status == User::STATUS_ACTIVE) {
                                return Html::a(
                                                '<span class="fas fa-edit"></span>', ['update', 'id' => $model->id], [
                                            'title' => 'Update user',
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
                        'delete' => function ($url, $model) {
                            if (User::userIsAllowedTo('Manage Users') && $model->status == User::STATUS_INACTIVE) {
                                return Html::a(
                                                '<span class="fa fa-trash"></span>', ['delete', 'id' => $model->id], [
                                            'title' => 'Remove user',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to remove this user?',
                                                'method' => 'post',
                                            ],
                                            'style' => "padding:5px;",
                                            'class' => 'bt btn-lg'
                                                ]
                                );
                            }
                        },
                    ]
                ]
            ],
        ]);
        ?>


    </div>
</div>
