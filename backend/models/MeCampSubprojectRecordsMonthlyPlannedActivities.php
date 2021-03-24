<?php

namespace backend\models;

use Yii;
use \yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "me_camp_subproject_records_monthly_planned_activities".
 *
 * @property int $id
 * @property int $camp_id
 * @property int $activity_id
 * @property int $faabs_id
 * @property string $month
 * @property string $year
 * @property string|null $zone
 * @property string|null $activity_target
 * @property int|null $beneficiary_target_total
 * @property string $beneficiary_target_women
 * @property string $beneficiary_target_youth
 * @property string $beneficiary_target_women_headed
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Camp $camp
 * @property AwpbActivity $activity
 * @property MeFaabsGroups $faabs
 * @property MeCampSubprojectRecordsMonthlyPlannedActivitiesActual[] $meCampSubprojectRecordsMonthlyPlannedActivitiesActuals
 */
class MeCampSubprojectRecordsMonthlyPlannedActivities extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'me_camp_subproject_records_monthly_planned_activities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['work_effort_id', 'activity_id', 'faabs_id','beneficiary_target_women', 'beneficiary_target_youth', 'beneficiary_target_women_headed'], 'required'],
            [['activity_id', 'faabs_id', 'beneficiary_target_total','created_by', 'updated_by', 'beneficiary_target_women', 'beneficiary_target_youth', 'beneficiary_target_women_headed'], 'integer'],
            [['zone'], 'string', 'max' => 45],
            [['activity_target'], 'string', 'max' => 255],
           // [['camp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Camps::className(), 'targetAttribute' => ['camp_id' => 'id']],
           // [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbActivity::className(), 'targetAttribute' => ['activity_id' => 'id']],
            [['faabs_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeFaabsGroups::className(), 'targetAttribute' => ['faabs_id' => 'id']],
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
            'activity_id' => 'Activity',
            'faabs_id' => 'FaaBS',
            'zone' => 'Zone',
            'activity_target' => 'Activity Target',
            'beneficiary_target_total' => 'Target Total',
            'beneficiary_target_women' => 'Target Women',
            'beneficiary_target_youth' => 'Target Youth',
            'beneficiary_target_women_headed' => 'Target Women Headed',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Camp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCamp() {
        return $this->hasOne(Camp::className(), ['id' => 'camp_id']);
    }

    /**
     * Gets query for [[Activity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActivity() {
        return $this->hasOne(AwpbActivity::className(), ['id' => 'activity_id']);
    }

    /**
     * Gets query for [[Faabs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaabs() {
        return $this->hasOne(MeFaabsGroups::className(), ['id' => 'faabs_id']);
    }

    /**
     * Gets query for [[MeCampSubprojectRecordsMonthlyPlannedActivitiesActuals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeCampSubprojectRecordsMonthlyPlannedActivitiesActuals() {
        return $this->hasMany(MeCampSubprojectRecordsMonthlyPlannedActivitiesActual::className(), ['planned_activity_id' => 'id']);
    }

    public static function getActivityListByDistrictId($id) {
        $list = AwpbActivityLine::find()->where(['district_id' => $id])->orderBy(['id' => SORT_ASC])->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

}
