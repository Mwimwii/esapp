<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "activity_time_sheets_district_staff".
 *
 * @property int $id
 * @property int $rate_id
 * @property string $month
 * @property string $designation
 * @property string $activity_description
 * @property int $hours_field_esapp_activities
 * @property int $hours_office_esapp_activities
 * @property int $total_hours_worked
 * @property float $contribution
 * @property int $status
 * @property string|null $reviewer_comments
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property ConfHourlyRates $rate
 */
class TimeSheetsDistrictStaff extends \yii\db\ActiveRecord {

    const _status_pending_approval = 0;
    const _accepted = 1;
    const _resent_back = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'activity_time_sheets_district_staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['rate_id',  'status','month', 'designation', 'activity_description', 'year', 'hours_field_esapp_activities'], 'required'],
            [['rate_id', 'hours_field_esapp_activities', 'hours_office_esapp_activities', 'total_hours_worked', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by','district','province'], 'integer'],
            [['activity_description', 'reviewer_comments'], 'string'],
            [['contribution'], 'number'],
            [['approved_at'], 'safe'],
            [['month', 'designation'], 'string', 'max' => 45],
            ['hours_field_esapp_activities', 'checkTotalHours'],
            ['hours_office_esapp_activities', 'checkTotalHours1'],
            ['month', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('month') &&
                            !empty(self::findOne(['month' => $model->month,
                                        "year" => $model->year])) ? TRUE : FALSE;
                }, 'message' => 'You have already added a time sheet for this month and year'],
            ['year', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('year') &&
                            !empty(self::findOne(['month' => $model->month,
                                        "year" => $model->year])) ? TRUE : FALSE;
                }, 'message' => 'You have already added a time sheet for this month and year'],
            [['rate_id'], 'exist', 'skipOnError' => true, 'targetClass' => HourlyRates::className(), 'targetAttribute' => ['rate_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'month' => 'Month',
            'year' => 'Year',
            'designation' => 'Designation',
            'activity_description' => 'Activity Description',
            'hours_field_esapp_activities' => 'Field hrs',
            'hours_office_esapp_activities' => 'Office hrs',
            'total_hours_worked' => 'Total hrs',
            'rate_id' => 'Rate(ZMW/hr)',
            'contribution' => 'Contribution(ZMW)',
            'status' => 'Status',
            'reviewer_comments' => 'Approval comments',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public function checkTotalHours() {
        $total_hours = 24;
        $hours_office = !empty($this->hours_field_esapp_activities) ? $this->hours_field_esapp_activities : 0;
        $hours_field = !empty($this->hours_office_esapp_activities) ? $this->hours_office_esapp_activities : 0;

        $total_worked_hours = $hours_field + $hours_office;
        if ($total_worked_hours > $total_hours) {
            $this->addError('hours_field_esapp_activities', "Total hours(Office + Field) cannot be more than 24hours");
        }
    }

    public function checkTotalHours1() {
        $total_hours = 24;
        $hours_office = !empty($this->hours_field_esapp_activities) ? $this->hours_field_esapp_activities : 0;
        $hours_field = !empty($this->hours_office_esapp_activities) ? $this->hours_office_esapp_activities : 0;

        $total_worked_hours = $hours_field + $hours_office;
        if ($total_worked_hours > $total_hours) {
            $this->addError('hours_office_esapp_activities', "Total hours(Office + Field) cannot be more than 24hours");
        }
    }

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
     * Gets query for [[Rate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRate() {
        return $this->hasOne(ConfHourlyRates::className(), ['id' => 'rate_id']);
    }

}
