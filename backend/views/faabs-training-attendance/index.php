<?php

use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use backend\models\User;
use kartik\popover\PopoverX;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MeFaabsTrainingAttendanceSheetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FaaBS Training Attendance records';
$this->params['breadcrumbs'][] = $this->title;

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
            if (User::userIsAllowedTo('Submit FaaBS training records')) {
                if (!empty($list)) {
                    echo Html::a('<i class="fa fa-plus"></i> <span class="text-xs">Submit records</span>', ['create'], ['class' => 'btn btn-success btn-xs']);
                } else {
                    echo!empty($district_model) ?
                            "<p class='alert alert-warning'>There are no FaaBS groups in the system for $district district. The system will only allow you to add Category \'A\' farmers after FaaBS groups are added for the district!</p>" :
                            "There are no FaaBS groups in the system for your district. The system will only allow you to add Category \'A\' farmers after FaaBS groups are added for the district!";
                }
            }
            ?>
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                //'id',
                'faabs_group_id',
                'farmer_id',
                'household_head_type',
                'topic:ntext',
                'facilitators:ntext',
                //'partner_organisations:ntext',
                'training_date',
                'duration',
                //'created_at',
                //'updated_at',
                //'created_by',
                //'updated_by',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>


    </div>
</div>
