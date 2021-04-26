<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use common\models\Role;

/**
 * This is the model class for table "awpb_activity_line".
 *
 * @property int $id
 * @property int $activity_id
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
 * @property float $total_amount
 * @property int $status
 * @property int|null $district_id
 * @property int|null $province_id
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivity $activity
 */
class AwpbActivityLine extends \yii\db\ActiveRecord
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
        return 'awpb_activity_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_id','awpb_template_id', 'name', 'unit_cost', 'total_quantity', 'total_amount', 'status'], 'required'],
            [['activity_id','awpb_template_id', 'status', 'district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['unit_cost', 'mo_1', 'mo_2', 'mo_3', 'mo_4', 'mo_5', 'mo_6', 'mo_7', 'mo_8', 'mo_9', 'mo_10', 'mo_11', 'mo_12', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_quantity','mo_1_amount', 'mo_2_amount', 'mo_3_amount', 'mo_4_amount', 'mo_5_amount', 'mo_6_amount', 'mo_7_amount', 'mo_8_amount', 'mo_9_amount', 'mo_10_amount', 'mo_11_amount', 'mo_12_amount', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount'], 'number'],
            [['name'], 'string', 'max' => 255],
            ['unit_cost', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number'],
            ['total_amount', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number'],
       
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbActivity::className(), 'targetAttribute' => ['activity_id' => 'id']],
            [['awpb_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbTemplate::className(), 'targetAttribute' => ['awpb_template_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Activity ID',
            'awpb_template_id' => 'AWPB Template',
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
            'quarter_one_quantity' => 'Qtr 1 Qty',
            'quarter_two_quantity' => 'Qtr 2 Qty',
            'quarter_three_quantity' => 'Qtr 3 Qty',
            'quarter_four_quantity' => 'Qtr 4 Qty',
            'total_quantity' => 'Total Quantity',
            'quarter_one_amount' => 'Qtr 1 Amount',
            'quarter_two_amount' => 'Qtr 2 Amount',
            'quarter_three_amount' => 'Qtr 3 Amount',
            'quarter_four_amount' => 'Qtr 4 Amount',
            'total_amount' => 'Total Amount',
            'status' => 'Status',
            'district_id' => 'District ID',
            'province_id' => 'Province ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Activity]].
     *
     * @return \yii\db\ActiveQuery
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
    public function getActivity()
    {
        return $this->hasOne(AwpbActivity::className(), ['id' => 'activity_id']);
    }
    public function getAwpbTemplate()
    {
        return $this->hasOne(AwpbTemplate::className(), ['id' => 'awpb_template_id']);
    }

    public static function getByActivity($id) {
        $list = self::find()->where(['activity_id' => $id])->all();
        return ArrayHelper::map($list, 'id', 'name');
    }
  
    
    public static function getList() {
        $list = self::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

  

}
