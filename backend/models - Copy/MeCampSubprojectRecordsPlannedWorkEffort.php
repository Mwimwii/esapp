<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "me_camp_subproject_records_planned_work_effort".
 *
 * @property int $id
 * @property int $camp_id
 * @property int $year
 * @property string $month
 * @property int $days_in_month
 * @property int $days_field
 * @property int $days_office
 * @property int|null $days_total Field days + Office days
 * @property int|null $days_other_non_esapp_activities
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Camp $camp
 */
class MeCampSubprojectRecordsPlannedWorkEffort extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'me_camp_subproject_records_planned_work_effort';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['camp_id', 'year', 'month', 'days_in_month', 'days_office', 'days_field'], 'required'],
            [['camp_id', 'year', 'days_in_month', 'days_field', 'days_office', 'days_total', 'days_other_non_esapp_activities', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['month'], 'string', 'max' => 15],
            ['camp_id', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('camp_id') && !empty(self::findOne(['camp_id' => $model->camp_id, "year" => date('Y'), "month" => date('n')])) ? TRUE : FALSE;
                }, 'message' => 'You have already added work effort for this month for this camp!'],
            ['days_office', 'checkTotalDays'],
            ['days_field', 'checkTotalDays1'],
            ['days_other_non_esapp_activities', 'checkTotalDays2'],
            [['camp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Camps::className(), 'targetAttribute' => ['camp_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'camp_id' => 'Camp',
            'year' => 'Year',
            'month' => 'Month',
            'days_in_month' => 'Days in month',
            'days_field' => 'Days Field',
            'days_office' => 'Days Office',
            'days_total' => 'Days Total',
            'days_other_non_esapp_activities' => 'Days non-esapp activities',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public function checkTotalDays() {
        $total_month_days = date('t');
        $days_office = !empty($this->days_office) ? $this->days_office : 0;
        $days_field = !empty($this->days_field) ? $this->days_field : 0;
        $days_non_esapp = !empty($this->days_other_non_esapp_activities) ? $this->days_other_non_esapp_activities : 0;

        $total_planned_days = $days_office + $days_field + $days_non_esapp;
        if ($total_planned_days > $total_month_days) {
            $this->addError('days_office', "Total days(Office + Field + Non-esapp activities cannot be more than total days in a month");
        }
    }

    public function checkTotalDays1() {
        $total_month_days = date('t');
        $days_office = !empty($this->days_office) ? $this->days_office : 0;
        $days_field = !empty($this->days_field) ? $this->days_field : 0;
        $days_non_esapp = !empty($this->days_other_non_esapp_activities) ? $this->days_other_non_esapp_activities : 0;

        $total_planned_days = $days_office + $days_field + $days_non_esapp;
        if ($total_planned_days > $total_month_days) {
            $this->addError('days_field', "Total days(Office + Field + Non-esapp activities cannot be more than total days in a month");
        }
    }

    public function checkTotalDays2() {
        $total_month_days = date('t');
        $days_office = !empty($this->days_office) ? $this->days_office : 0;
        $days_field = !empty($this->days_field) ? $this->days_field : 0;
        $days_non_esapp = !empty($this->days_other_non_esapp_activities) ? $this->days_other_non_esapp_activities : 0;

        $total_planned_days = $days_office + $days_field + $days_non_esapp;
        if ($total_planned_days > $total_month_days) {
            $this->addError('days_other_non_esapp_activities', "Total days(Office + Field + Non-esapp activities cannot be more than total days in a month");
        }
    }

    /**
     * Gets query for [[Camp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCamp() {
        return $this->hasOne(Camps::className(), ['id' => 'camp_id']);
    }

}
