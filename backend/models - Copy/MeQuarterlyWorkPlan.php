<?php

namespace backend\models;

use Yii;
use \yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "me_quarterly_work_plan".
 *
 * @property int $id
 * @property int $activity_id
 * @property int $province_id
 * @property int $district_id
 * @property int $month
 * @property string $quarter
 * @property string $year
 * @property int $status
 * @property int $district_approval_status
 * @property int $provincial_approval_status
 * @property string $Remarks
 * @property string|null $esapp_comments
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property MeQuarterlyOperationsFundsRequisition[] $meQuarterlyOperationsFundsRequisitions
 * @property AwpbActivityLine $activity
 */
class MeQuarterlyWorkPlan extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'me_quarterly_work_plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['activity_id', 'province_id', 'district_id', 'month', 'quarter', 'year', 'provincial_approval_status', 'Remarks'], 'required'],
            [['activity_id', 'province_id', 'district_id', 'month', 'status', 'district_approval_status', 'provincial_approval_status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['Remarks', 'esapp_comments'], 'string'],
            [['quarter'], 'string', 'max' => 15],
            [['year'], 'string', 'max' => 5],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbActivityLine::className(), 'targetAttribute' => ['activity_id' => 'id']],
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
            'activity_id' => 'Activity ID',
            'province_id' => 'Province ID',
            'district_id' => 'District ID',
            'month' => 'Month',
            'quarter' => 'Quarter',
            'year' => 'Year',
            'status' => 'Status',
            'district_approval_status' => 'District Approval Status',
            'provincial_approval_status' => 'Provincial Approval Status',
            'Remarks' => 'Remarks',
            'esapp_comments' => 'Esapp Comments',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[MeQuarterlyOperationsFundsRequisitions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeQuarterlyOperationsFundsRequisitions() {
        return $this->hasMany(MeQuarterlyOperationsFundsRequisition::className(), ['quarter_workplan_id' => 'id']);
    }

    /**
     * Gets query for [[Activity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActivity() {
        return $this->hasOne(AwpbActivityLine::className(), ['id' => 'activity_id']);
    }

    /**
     * Create quarterly work plan template for quarter one
     */
    public static function CreateQuarterOnePlan() {
        //We get activities that were planned for the 1st quarter for all
        //districts
        //
        //We get for month one
        $awpb_planned_activities = \backend\models\AwpbActivityLine::find()
                ->where(["year" => date('Y')])
                ->andWhere([">", 'mo_1', 0])
                // ->andWhere([">", 'mo_2', 0])
                //  ->andWhere([">", 'mo_3', 0])
                //->andWhere(['status' => 1])
                ->asArray()
                ->all();
        if (!empty($awpb_planned_activities)) {
            foreach ($awpb_planned_activities as $_activity) {
                $model = new MeQuarterlyWorkPlan();
                $model->activity_id = $_activity['id'];
                $model->province_id = $_activity['province_id'];
                $model->district_id = $_activity['district_id'];
                $model->month = 1;
                $model->quarter = "1";
                $model->year = date('Y');
                $model->status = 0;
                $model->district_approval_status = 0;
                $model->provincial_approval_status = 0;
                $model->Remarks = "Not set";
                if ($model->save(false)) {
                    $_model = new MeQuarterlyOperationsFundsRequisition();
                    $_model->quarter_workplan_id = $model->id;
                    $_model->save(false);
                }
            }
        }

        //We get for month two
        $awpb_planned_activities1 = \backend\models\AwpbActivityLine::find()
                ->where(["year" => date('Y')])
                ->andWhere([">", 'mo_2', 0])
                // ->andWhere([">", 'mo_2', 0])
                //  ->andWhere([">", 'mo_3', 0])
                //->andWhere(['status' => 1])
                ->asArray()
                ->all();
        if (!empty($awpb_planned_activities1)) {
            foreach ($awpb_planned_activities1 as $_activity) {
                $model = new MeQuarterlyWorkPlan();
                $model->activity_id = $_activity['id'];
                $model->province_id = $_activity['province_id'];
                $model->district_id = $_activity['district_id'];
                $model->month = 2;
                $model->quarter = "1";
                $model->year = date('Y');
                $model->status = 0;
                $model->district_approval_status = 0;
                $model->provincial_approval_status = 0;
                $model->Remarks = "Not set";
                if ($model->save(false)) {
                    $_model = new MeQuarterlyOperationsFundsRequisition();
                    $_model->quarter_workplan_id = $model->id;
                    $_model->save(false);
                }
            }
        }

        //We get for month three
        $awpb_planned_activities1 = \backend\models\AwpbActivityLine::find()
                ->where(["year" => date('Y')])
                ->andWhere([">", 'mo_3', 0])
                // ->andWhere([">", 'mo_2', 0])
                //  ->andWhere([">", 'mo_3', 0])
                //->andWhere(['status' => 1])
                ->asArray()
                ->all();
        if (!empty($awpb_planned_activities1)) {
            foreach ($awpb_planned_activities1 as $_activity) {
                $model = new MeQuarterlyWorkPlan();
                $model->activity_id = $_activity['id'];
                $model->province_id = $_activity['province_id'];
                $model->district_id = $_activity['district_id'];
                $model->month = 3;
                $model->quarter = "1";
                $model->year = date('Y');
                $model->status = 0;
                $model->district_approval_status = 0;
                $model->provincial_approval_status = 0;
                $model->Remarks = "Not set";
                if ($model->save(false)) {
                    $_model = new MeQuarterlyOperationsFundsRequisition();
                    $_model->quarter_workplan_id = $model->id;
                    $_model->save(false);
                }
            }
        }
    }

    /**
     * Create quarterly work plan template for quarter two
     */
    public static function CreateQuarterTwoPlan() {
        //We get activities that were planned for the 2nd quarter for all
        //districts
        //
        //We get for month four
        $awpb_planned_activities = \backend\models\AwpbActivityLine::find()
                ->where(["year" => date('Y')])
                ->andWhere([">", 'mo_4', 0])
                // ->andWhere([">", 'mo_2', 0])
                //  ->andWhere([">", 'mo_3', 0])
                //->andWhere(['status' => 1])
                ->asArray()
                ->all();
        if (!empty($awpb_planned_activities)) {
            foreach ($awpb_planned_activities as $_activity) {
                $model = new MeQuarterlyWorkPlan();
                $model->activity_id = $_activity['id'];
                $model->province_id = $_activity['province_id'];
                $model->district_id = $_activity['district_id'];
                $model->month = 4;
                $model->quarter = "2";
                $model->year = date('Y');
                $model->status = 0;
                $model->district_approval_status = 0;
                $model->provincial_approval_status = 0;
                $model->Remarks = "Not set";
                if ($model->save(false)) {
                    $_model = new MeQuarterlyOperationsFundsRequisition();
                    $_model->quarter_workplan_id = $model->id;
                    $_model->save(false);
                }
            }
        }

        //We get for month five
        $awpb_planned_activities1 = \backend\models\AwpbActivityLine::find()
                ->where(["year" => date('Y')])
                ->andWhere([">", 'mo_5', 0])
                // ->andWhere([">", 'mo_2', 0])
                //  ->andWhere([">", 'mo_3', 0])
                //->andWhere(['status' => 1])
                ->asArray()
                ->all();
        if (!empty($awpb_planned_activities1)) {
            foreach ($awpb_planned_activities1 as $_activity) {
                $model = new MeQuarterlyWorkPlan();
                $model->activity_id = $_activity['id'];
                $model->province_id = $_activity['province_id'];
                $model->district_id = $_activity['district_id'];
                $model->month = 5;
                $model->quarter = "2";
                $model->year = date('Y');
                $model->status = 0;
                $model->district_approval_status = 0;
                $model->provincial_approval_status = 0;
                $model->Remarks = "Not set";
                if ($model->save(false)) {
                    $_model = new MeQuarterlyOperationsFundsRequisition();
                    $_model->quarter_workplan_id = $model->id;
                    $_model->save(false);
                }
            }
        }

        //We get for month six
        $awpb_planned_activities1 = \backend\models\AwpbActivityLine::find()
                ->where(["year" => date('Y')])
                ->andWhere([">", 'mo_6', 0])
                // ->andWhere([">", 'mo_2', 0])
                //  ->andWhere([">", 'mo_3', 0])
                //->andWhere(['status' => 1])
                ->asArray()
                ->all();
        if (!empty($awpb_planned_activities1)) {
            foreach ($awpb_planned_activities1 as $_activity) {
                $model = new MeQuarterlyWorkPlan();
                $model->activity_id = $_activity['id'];
                $model->province_id = $_activity['province_id'];
                $model->district_id = $_activity['district_id'];
                $model->month = 6;
                $model->quarter = "2";
                $model->year = date('Y');
                $model->status = 0;
                $model->district_approval_status = 0;
                $model->provincial_approval_status = 0;
                $model->Remarks = "Not set";
                if ($model->save(false)) {
                    $_model = new MeQuarterlyOperationsFundsRequisition();
                    $_model->quarter_workplan_id = $model->id;
                    $_model->save(false);
                }
            }
        }
    }

    /**
     * Create quarterly work plan template for quarter three
     */
    public static function CreateQuarterThreePlan() {
        //We get activities that were planned for the 3rd quarter for all
        //districts
        //
        //We get for month seven
        $awpb_planned_activities = \backend\models\AwpbActivityLine::find()
                ->where(["year" => date('Y')])
                ->andWhere([">", 'mo_7', 0])
                // ->andWhere([">", 'mo_2', 0])
                //  ->andWhere([">", 'mo_3', 0])
                //->andWhere(['status' => 1])
                ->asArray()
                ->all();
        if (!empty($awpb_planned_activities)) {
            foreach ($awpb_planned_activities as $_activity) {
                $model = new MeQuarterlyWorkPlan();
                $model->activity_id = $_activity['id'];
                $model->province_id = $_activity['province_id'];
                $model->district_id = $_activity['district_id'];
                $model->month = 7;
                $model->quarter = "3";
                $model->year = date('Y');
                $model->status = 0;
                $model->district_approval_status = 0;
                $model->provincial_approval_status = 0;
                $model->Remarks = "Not set";
                if ($model->save(false)) {
                    $_model = new MeQuarterlyOperationsFundsRequisition();
                    $_model->quarter_workplan_id = $model->id;
                    $_model->save(false);
                }
            }
        }

        //We get for month five
        $awpb_planned_activities1 = \backend\models\AwpbActivityLine::find()
                ->where(["year" => date('Y')])
                ->andWhere([">", 'mo_8', 0])
                // ->andWhere([">", 'mo_2', 0])
                //  ->andWhere([">", 'mo_3', 0])
                //->andWhere(['status' => 1])
                ->asArray()
                ->all();
        if (!empty($awpb_planned_activities1)) {
            foreach ($awpb_planned_activities1 as $_activity) {
                $model = new MeQuarterlyWorkPlan();
                $model->activity_id = $_activity['id'];
                $model->province_id = $_activity['province_id'];
                $model->district_id = $_activity['district_id'];
                $model->month = 8;
                $model->quarter = "3";
                $model->year = date('Y');
                $model->status = 0;
                $model->district_approval_status = 0;
                $model->provincial_approval_status = 0;
                $model->Remarks = "Not set";
                if ($model->save(false)) {
                    $_model = new MeQuarterlyOperationsFundsRequisition();
                    $_model->quarter_workplan_id = $model->id;
                    $_model->save(false);
                }
            }
        }

        //We get for month six
        $awpb_planned_activities1 = \backend\models\AwpbActivityLine::find()
                ->where(["year" => date('Y')])
                ->andWhere([">", 'mo_9', 0])
                // ->andWhere([">", 'mo_2', 0])
                //  ->andWhere([">", 'mo_3', 0])
                //->andWhere(['status' => 1])
                ->asArray()
                ->all();
        if (!empty($awpb_planned_activities1)) {
            foreach ($awpb_planned_activities1 as $_activity) {
                $model = new MeQuarterlyWorkPlan();
                $model->activity_id = $_activity['id'];
                $model->province_id = $_activity['province_id'];
                $model->district_id = $_activity['district_id'];
                $model->month = 9;
                $model->quarter = "3";
                $model->year = date('Y');
                $model->status = 0;
                $model->district_approval_status = 0;
                $model->provincial_approval_status = 0;
                $model->Remarks = "Not set";
                if ($model->save(false)) {
                    $_model = new MeQuarterlyOperationsFundsRequisition();
                    $_model->quarter_workplan_id = $model->id;
                    $_model->save(false);
                }
            }
        }
    }

    /**
     * Create quarterly work plan template for quarter four
     */
    public static function CreateQuarterFourPlan() {
        //We get activities that were planned for the 4th quarter for all
        //districts
        //
        //We get for month seven
        $awpb_planned_activities = \backend\models\AwpbActivityLine::find()
                ->where(["year" => date('Y')])
                ->andWhere([">", 'mo_10', 0])
                // ->andWhere([">", 'mo_2', 0])
                //  ->andWhere([">", 'mo_3', 0])
                //->andWhere(['status' => 1])
                ->asArray()
                ->all();
        if (!empty($awpb_planned_activities)) {
            foreach ($awpb_planned_activities as $_activity) {
                $model = new MeQuarterlyWorkPlan();
                $model->activity_id = $_activity['id'];
                $model->province_id = $_activity['province_id'];
                $model->district_id = $_activity['district_id'];
                $model->month = 10;
                $model->quarter = "4";
                $model->year = date('Y');
                $model->status = 0;
                $model->district_approval_status = 0;
                $model->provincial_approval_status = 0;
                $model->Remarks = "Not set";
                if ($model->save(false)) {
                    $_model = new MeQuarterlyOperationsFundsRequisition();
                    $_model->quarter_workplan_id = $model->id;
                    $_model->save(false);
                }
            }
        }

        //We get for month five
        $awpb_planned_activities1 = \backend\models\AwpbActivityLine::find()
                ->where(["year" => date('Y')])
                ->andWhere([">", 'mo_11', 0])
                // ->andWhere([">", 'mo_2', 0])
                //  ->andWhere([">", 'mo_3', 0])
                //->andWhere(['status' => 1])
                ->asArray()
                ->all();
        if (!empty($awpb_planned_activities1)) {
            foreach ($awpb_planned_activities1 as $_activity) {
                $model = new MeQuarterlyWorkPlan();
                $model->activity_id = $_activity['id'];
                $model->province_id = $_activity['province_id'];
                $model->district_id = $_activity['district_id'];
                $model->month = 11;
                $model->quarter = "4";
                $model->year = date('Y');
                $model->status = 0;
                $model->district_approval_status = 0;
                $model->provincial_approval_status = 0;
                $model->Remarks = "Not set";
                if ($model->save(false)) {
                    $_model = new MeQuarterlyOperationsFundsRequisition();
                    $_model->quarter_workplan_id = $model->id;
                    $_model->save(false);
                }
            }
        }

        //We get for month six
        $awpb_planned_activities1 = \backend\models\AwpbActivityLine::find()
                ->where(["year" => date('Y')])
                ->andWhere([">", 'mo_12', 0])
                // ->andWhere([">", 'mo_2', 0])
                //  ->andWhere([">", 'mo_3', 0])
                //->andWhere(['status' => 1])
                ->asArray()
                ->all();
        if (!empty($awpb_planned_activities1)) {
            foreach ($awpb_planned_activities1 as $_activity) {
                $model = new MeQuarterlyWorkPlan();
                $model->activity_id = $_activity['id'];
                $model->province_id = $_activity['province_id'];
                $model->district_id = $_activity['district_id'];
                $model->month = 12;
                $model->quarter = "4";
                $model->year = date('Y');
                $model->status = 0;
                $model->district_approval_status = 0;
                $model->provincial_approval_status = 0;
                $model->Remarks = "Not set";
                if ($model->save(false)) {
                    $_model = new MeQuarterlyOperationsFundsRequisition();
                    $_model->quarter_workplan_id = $model->id;
                    $_model->save(false);
                }
            }
        }
    }

}
