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
            [['work_effort_id', 'activity_id', 'faabs_id'], 'required'],
            [['activity_id', 'faabs_id', 'beneficiary_target_total', 'created_by', 'updated_by', 'beneficiary_target_women', 'beneficiary_target_youth', 'beneficiary_target_women_headed'], 'integer'],
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
        $list = AwpbActivityLine::find()
                        ->where(['district_id' => $id])
                        ->orderBy(['id' => SORT_ASC])->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

    public static function getActivityListByDistrictId1($id, $year, $work_effort_id = "", $month = "", $activity_id = "") {

        $columnName = self::getMonthColumnName($month);
        $activity_ids = [];
        $activity_ids1 = [];
        $work_effort_model = self::find()
                ->select(['activity_id'])
                ->where(['work_effort_id' => $work_effort_id])
                ->all();

        if (!empty($work_effort_model)) {
            foreach ($work_effort_model as $model) {
                //When we are updating, we need all the activities
                if (!empty($activity_id) && $activity_id == $model['activity_id']) {
                    continue;
                }
                array_push($activity_ids, $model['activity_id']);
            }
        }

        //var_dump($activity_ids);
        $list = AwpbBudget::find()
                //->select(["awpb_activity_line.activity_id"])
                ->leftJoin('awpb_template', 'awpb_template.id = awpb_budget.awpb_template_id')
                ->where(['awpb_budget.district_id' => $id])
                ->andWhere(['awpb_template.fiscal_year' => $year])
                ->andWhere(['NOT IN', 'awpb_budget.activity_id', $activity_ids])
                ->andWhere(['>=', "awpb_budget." . $columnName, 1])
                ->orderBy(['awpb_budget.id' => SORT_ASC])
                ->all();
        $response = ArrayHelper::map($list, 'activity_id', 'name');
        return $response;
    }
    

    public static function getMonthColumnName($month) {
        $columnName = "";
        if ($month == 1) {
            $columnName = "mo_1";
        }
        if ($month == 2) {
            $columnName = "mo_2";
        }
        if ($month == 3) {
            $columnName = "mo_3";
        }
        if ($month == 4) {
            $columnName = "mo_4";
        }
        if ($month == 5) {
            $columnName = "mo_5";
        }
        if ($month == 6) {
            $columnName = "mo_6";
        }
        if ($month == 7) {
            $columnName = "mo_7";
        }
        if ($month == 8) {
            $columnName = "mo_8";
        }
        if ($month == 9) {
            $columnName = "mo_9";
        }
        if ($month == 10) {
            $columnName = "mo_10";
        }
        if ($month == 11) {
            $columnName = "mo_11";
        }
        if ($month == 12) {
            $columnName = "mo_12";
        }
        return $columnName;
    }

    public static function getMonthColumnNameActuals($month) {
        $columnName = "";
        if ($month == 1) {
            $columnName = "mo_1_actual";
        }
        if ($month == 2) {
            $columnName = "mo_2_actual";
        }
        if ($month == 3) {
            $columnName = "mo_3_actual";
        }
        if ($month == 4) {
            $columnName = "mo_4_actual";
        }
        if ($month == 5) {
            $columnName = "mo_5_actual";
        }
        if ($month == 6) {
            $columnName = "mo_6_actual";
        }
        if ($month == 7) {
            $columnName = "mo_7_actual";
        }
        if ($month == 8) {
            $columnName = "mo_8_actual";
        }
        if ($month == 9) {
            $columnName = "mo_9_actual";
        }
        if ($month == 10) {
            $columnName = "mo_10_actual";
        }
        if ($month == 11) {
            $columnName = "mo_11_actual";
        }
        if ($month == 12) {
            $columnName = "mo_12_actual";
        }
        return $columnName;
    }

    public static function getQuarter($month) {
        $quarter = "";
        if (in_array($month, [1, 2, 3])) {
            $quarter = "quarter_one_actual";
        }
        if (in_array($month, [4, 5, 6])) {
            $quarter = "quarter_two_actual";
        }
        if (in_array($month, [7, 8, 9])) {
            $quarter = "quarter_three_actual";
        }
        if (in_array($month, [10, 11, 12])) {
            $quarter = "quarter_four_actual";
        }
        return $quarter;
    }

}
