<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "awpb_input".
 *
 * @property int $id
 * @property int $activity_id
 * @property int $awpb_template_id
 * @property int $indicator_id
 * @property string $name
 * @property float $unit_cost
 * @property float|null $mo_1
 * @property float|null $mo_2
 * @property float|null $mo_3
 * @property float|null $mo_4
 * @property float|null $mo_5
 * @property float|null $mo_6
 * @property float|null $mo_7
 * @property float|null $mo_8
 * @property float|null $mo_9
 * @property float|null $mo_10
 * @property float|null $mo_11
 * @property float|null $mo_12
 * @property float|null $quarter_one_quantity
 * @property float|null $quarter_two_quantity
 * @property float|null $quarter_three_quantity
 * @property float|null $quarter_four_quantity
 * @property float $total_quantity
 * @property float|null $mo_1_amount
 * @property float|null $mo_2_amount
 * @property float|null $mo_3_amount
 * @property float|null $mo_4_amount
 * @property float|null $mo_5_amount
 * @property float|null $mo_6_amount
 * @property float|null $mo_7_amount
 * @property float|null $mo_8_amount
 * @property float|null $mo_9_amount
 * @property float|null $mo_10_amount
 * @property float|null $mo_11_amount
 * @property float|null $mo_12_amount
 * @property float|null $quarter_one_amount
 * @property float|null $quarter_two_amount
 * @property float|null $quarter_three_amount
 * @property float|null $quarter_four_amount
 * @property float $total_amount
 * @property float|null $mo_1_actual
 * @property float|null $mo_2_actual
 * @property float|null $mo_3_actual
 * @property float|null $mo_4_actual
 * @property float|null $mo_5_actual
 * @property float|null $mo_6_actual
 * @property float|null $mo_7_actual
 * @property float|null $mo_8_actual
 * @property float|null $mo_9_actual
 * @property float|null $mo_10_actual
 * @property float|null $mo_11_actual
 * @property float|null $mo_12_actual
 * @property int $status
 * @property int|null $district_id
 * @property int|null $province_id
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class AwpbInput extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const STATUS_DRAFT = 0;
    const STATUS_SUBMITTED = 1;
    const STATUS_REVIEWED = 2;
    const STATUS_APPROVED = 3;
    const STATUS_MINISTRY = 4;
    public static function tableName()
    {
        return 'awpb_input';
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_id', 'awpb_template_id', 'indicator_id', 'template_indicator_id','name', 'unit_cost'], 'required'],
            [['activity_id', 'awpb_template_id', 'indicator_id','template_indicator_id', 'status', 'district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['unit_cost', 'mo_1', 'mo_2', 'mo_3', 'mo_4', 'mo_5', 'mo_6', 'mo_7', 'mo_8', 'mo_9', 'mo_10', 'mo_11', 'mo_12', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_quantity', 'mo_1_amount', 'mo_2_amount', 'mo_3_amount', 'mo_4_amount', 'mo_5_amount', 'mo_6_amount', 'mo_7_amount', 'mo_8_amount', 'mo_9_amount', 'mo_10_amount', 'mo_11_amount', 'mo_12_amount', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount', 'mo_1_actual', 'mo_2_actual', 'mo_3_actual', 'mo_4_actual', 'mo_5_actual', 'mo_6_actual', 'mo_7_actual', 'mo_8_actual', 'mo_9_actual', 'mo_10_actual', 'mo_11_actual', 'mo_12_actual'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Activity',
            'awpb_template_id' => 'Awpb Template',
            'indicator_id' => 'Indicator',
              'template_indicator_id' => 'AWPB Indicator',
            'name' => 'Name',
            'unit_cost' => 'Unit Cost',
            'mo_1' => 'Jan',
            'mo_2' => 'Feb',
            'mo_3' => 'Mar',
            'mo_4' => 'Apr',
            'mo_5' => 'May',
            'mo_6' => 'Jun',
            'mo_7' => 'Jul',
            'mo_8' => 'Aug',
            'mo_9' => 'Sep',
            'mo_10' => 'Oct',
            'mo_11' => 'Nov',
            'mo_12' => 'Dec',
            'quarter_one_quantity' => 'Q1 Qty',
            'quarter_two_quantity' => 'Q2 Qty',
            'quarter_three_quantity' => 'Q3 Qty',
            'quarter_four_quantity' => 'Q4 Qty',
            'total_quantity' => 'Total Qty',
            'mo_1_amount' => 'Jan Budget',
            'mo_2_amount' => 'Feb Budget',
            'mo_3_amount' =>'Mar Budget',
            'mo_4_amount' => 'Apr Budget',
            'mo_5_amount' => 'May Budget',
            'mo_6_amount' => 'Jun Budget',
            'mo_7_amount' => 'Jul Budget',
            'mo_8_amount' => 'Aug Budget',
            'mo_9_amount' => 'Sep Budget',
            'mo_10_amount' => 'Oct Budget',
            'mo_11_amount' => 'Nov Budget',
            'mo_12_amount' => 'Dec Budget',
            'quarter_one_amount' => 'Q1 Qty Budget',
            'quarter_two_amount' => 'Q2 Qty Budget',
            'quarter_three_amount' => 'Q3 Qty Budget',
            'quarter_four_amount' => 'Q4 Qty Budget',
            'total_amount' => 'Total Budget',
            'mo_1_actual' => 'Mo 1 Actual',
            'mo_2_actual' => 'Mo 2 Actual',
            'mo_3_actual' => 'Mo 3 Actual',
            'mo_4_actual' => 'Mo 4 Actual',
            'mo_5_actual' => 'Mo 5 Actual',
            'mo_6_actual' => 'Mo 6 Actual',
            'mo_7_actual' => 'Mo 7 Actual',
            'mo_8_actual' => 'Mo 8 Actual',
            'mo_9_actual' => 'Mo 9 Actual',
            'mo_10_actual' => 'Mo 10 Actual',
            'mo_11_actual' => 'Mo 11 Actual',
            'mo_12_actual' => 'Mo 12 Actual',
            'status' => 'Status',
            'district_id' => 'District',
            'province_id' => 'Province',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
