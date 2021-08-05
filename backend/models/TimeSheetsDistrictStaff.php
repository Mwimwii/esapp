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
            [['rate_id', 'month', 'designation', 'activity_description', 'year'], 'required'],
            [['rate_id', 'hours_field_esapp_activities', 'hours_office_esapp_activities', 'total_hours_worked', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['activity_description', 'reviewer_comments'], 'string'],
            [['contribution'], 'number'],
            [['month', 'designation'], 'string', 'max' => 45],
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
            'reviewer_comments' => 'Reviewer comments',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
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
