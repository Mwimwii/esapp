<?php

namespace backend\models;

use Yii;
use \yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "me_quarterly_operations_funds_requisition".
 *
 * @property int $id
 * @property int $quarter_workplan_id
 * @property string|null $budget_estimate_month_1
 * @property string|null $budget_estimate_month_2
 * @property string|null $budget_estimate_month_3
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property MeQuarterlyWorkPlan $quarterWorkplan
 */
class MeQuarterlyOperationsFundsRequisition extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'me_quarterly_operations_funds_requisition';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['quarter_workplan_id'], 'required'],
            [['quarter_workplan_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['budget_estimate_month_1', 'budget_estimate_month_2', 'budget_estimate_month_3'], 'string', 'max' => 50],
            [['quarter_workplan_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeQuarterlyWorkPlan::className(), 'targetAttribute' => ['quarter_workplan_id' => 'id']],
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
            'quarter_workplan_id' => 'Quarter Workplan ID',
            'budget_estimate_month_1' => 'Budget Estimate Month 1',
            'budget_estimate_month_2' => 'Budget Estimate Month 2',
            'budget_estimate_month_3' => 'Budget Estimate Month 3',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[QuarterWorkplan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuarterWorkplan() {
        return $this->hasOne(MeQuarterlyWorkPlan::className(), ['id' => 'quarter_workplan_id']);
    }

}
