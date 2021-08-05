<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use backend\models\Storyofchange;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimeSheetsDistrictStaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Time Sheets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h5>Instructions</h5>
        <ol>
            <li>Click <span class="badge badge-success">Submit time sheet</span> button below to 
                add a new time sheet
            </li>
            <li>You can only add time sheets for a month which you have not added already for the year the activity was done
            </li>
            <li>To edit a time sheet, click the 
                <span class="badge badge-primary"><span class="fa fa-edit fa-1x"></span></span> 
                icon in the table below
            </li>
            <li>You can only edit time sheets which you have not Submitted for review,have been accepted or those which have been Resent back for changes
            </li>
            <li>To view full details of a time sheet record, click the 
                <span class="badge badge-primary"><span class="fa fa-eye fa-1x"></span></span> 
                icon in the table below
            </li>
            <li>You can delete a time sheet record that you have not yet submitted for review. To delete a record, click the
                <span class="badge badge-primary"><span class="fa fa-trash fa-1x"></span></span> 
                icon in the table below
            </li>
        </ol>
        <p>
            <?= Html::a('<i class="fa fa-plus"></i> Submit time sheet', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                // 'id',
                [
                    'attribute' => 'month',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'year',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'designation',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'activity_description',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'hours_field_esapp_activities',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'hours_office_esapp_activities',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'total_hours_worked',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'rate_id',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'contribution',
                    'filter' => false,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'status',
                    //'class' => EditableColumn::className(),
                    'enableSorting' => true,
                    'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filter' => [
                         Storyofchange::_accepted => 'Accepted',
                        Storyofchange::_submitted_for_review => 'Pending review',
                        Storyofchange::_resent_back => 'Sent back. Requires changes'
                    ],
                    'filterInputOptions' => ['prompt' => 'Filter by Status', 'class' => 'form-control', 'id' => null],
                    'format' => 'raw',
                    'value' => function($model) {
                        $str = "";
                        if ($model->status == Storyofchange::_accepted) {
                            $str = "<p class='badge badge-success'> "
                                    . "<i class='fa fa-check'></i> Accepted</p><br>";
                        } elseif ($model->status == Storyofchange::_submitted_for_review) {
                            $str = "<p class='badge badge-info'> "
                                    . "<i class='fa fa-hourglass-half'></i> Submitted for review</p><br>";
                        } else {
                            $str = "<p class='badge badge-warning'> "
                                    . "<i class='fa fa-times'></i> Resent back. Requires changes</p><br>";
                        }
                        return $str;
                    },
                ],
                //'reviewer_comments:ntext',
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
