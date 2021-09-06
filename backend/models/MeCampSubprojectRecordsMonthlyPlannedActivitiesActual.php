<?php

namespace backend\models;

use Yii;
use \yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "me_camp_subproject_records_monthly_planned_activities_actual".
 *
 * @property int $id
 * @property int $camp_id
 * @property int $planned_activity_id
 * @property string $hours_worked_field
 * @property string $hours_worked_office
 * @property string|null $hours_worked_total
 * @property string $achieved_activity_target
 * @property string $beneficiary_target_achieved_total
 * @property string $beneficiary_target_achieved_women
 * @property string $beneficiary_target_achieved_youth
 * @property string $beneficiary_target_achieved_women_headed
 * @property string|null $remarks
 * @property string|null $year
 * @property string|null $month
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Camp $camp
 * @property MeCampSubprojectRecordsMonthlyPlannedActivities $plannedActivity
 */
class MeCampSubprojectRecordsMonthlyPlannedActivitiesActual extends \yii\db\ActiveRecord {

    public $camp_id;
    public $target_women;
    public $target_youth;
    public $target_women_headed;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'me_camp_subproject_records_monthly_planned_activities_actual';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['planned_activity_id', 'achieved_activity_target', 'hours_worked_field', 'hours_worked_office', 'hours_worked_total', 'achieved_activity_target'], 'required'],
            [['planned_activity_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['remarks'], 'string'],
            [['hours_worked_field', 'hours_worked_office', 'target_women', 'target_youth', 'target_women_headed'], 'safe'],
            [['hours_worked_total'], 'safe'],
            [['achieved_activity_target', 'beneficiary_target_achieved_total', 'beneficiary_target_achieved_women', 'beneficiary_target_achieved_youth', 'beneficiary_target_achieved_women_headed'], 'safe'],
            ['beneficiary_target_achieved_women', 'required', 'when' => function($model) {
                    return $model->target_women > 0;
                }, 'message' => 'Target achieved women cannot be blank!'],
            ['beneficiary_target_achieved_youth', 'required', 'when' => function($model) {
                    return $model->target_youth > 0;
                }, 'message' => 'Target achieved youth cannot be blank!'],
            ['beneficiary_target_achieved_women_headed', 'required', 'when' => function($model) {
                    return $model->target_women_headed > 0;
                }, 'message' => 'Target achieved women headed cannot be blank!'],
            [['year'], 'string', 'max' => 5],
            [['month'], 'string', 'max' => 3],
            // [['camp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Camps::className(), 'targetAttribute' => ['camp_id' => 'id']],
            [['planned_activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeCampSubprojectRecordsMonthlyPlannedActivities::className(), 'targetAttribute' => ['planned_activity_id' => 'id']],
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
            'planned_activity_id' => 'Planned activity',
            'hours_worked_field' => 'Hours worked field',
            'hours_worked_office' => 'Hours worked office',
            'hours_worked_total' => 'Hours worked total',
            'achieved_activity_target' => 'Achieved activity target',
            'beneficiary_target_achieved_total' => 'Beneficiary target achieved total',
            'beneficiary_target_achieved_women' => 'Beneficiary target achieved women',
            'beneficiary_target_achieved_youth' => 'Beneficiary target achieved youth',
            'beneficiary_target_achieved_women_headed' => 'Beneficiary target achieved women headed',
            'remarks' => 'Remarks',
            'year' => 'Year',
            'month' => 'Month',
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
     * Gets query for [[PlannedActivity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlannedActivity() {
        return $this->hasOne(MeCampSubprojectRecordsMonthlyPlannedActivities::className(), ['id' => 'planned_activity_id']);
    }

}
