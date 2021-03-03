<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "awpb_activity_line".
 *
 * @property int $id
 * @property int $activity_id
 * @property int|null $unit_of_measure_id
 * @property string $description
 * @property float $unit_cost
 * @property float|null $quarter_one_quantity
 * @property float|null $quarter_two_quantity
 * @property float|null $quarter_three_quantity
 * @property float|null $quarter_four_quantity
 * @property float $total_quantity
 * @property int|null $district_id
 * @property int|null $province_id
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property CommodityType $commodityType
 * @property AwpbActivity $activity
 */
class AwpbActivityLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const STATUS_DISTRICT = 0;
    const STATUS_PROVINCIAL = 1;
    const STATUS_PROGRAMME = 2;
    const STATUS_MINISTRY = 3;

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
            [['activity_id', 'name', 'unit_cost', 'total_quantity','total_amount'], 'required'],
            [['activity_id', 'name', 'unit_cost', 'total_quantity','total_amount'], 'safe'],
            [['activity_id', 'unit_of_measure_id', 'district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['unit_cost', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_quantity','total_amount'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['unit_of_measure_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbUnitOfMeasure::className(), 'targetAttribute' => [ 'unit_of_measure_id' => 'id']],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbActivity::className(), 'targetAttribute' => ['activity_id' => 'id']],
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
             'unit_of_measure_id' => 'Unit of Measure',
            'name' => 'Name',
            'unit_cost' => 'Unit Cost',
            'quarter_one_quantity' => 'Q1 Qty',
            'quarter_two_quantity' => 'Q2 Qty',
            'quarter_three_quantity' => 'Q3 Qty',
            'quarter_four_quantity' => 'Q4 Qty',
            'total_quantity' => 'Total Qty',
            'total_amount' => 'Total Amount',
            'district_id' => 'District',
            'province_id' => 'Province',
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
     * Gets query for [[CommodityType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnitOfMeasure()
    {
        return $this->hasOne(AwpbUnitOfMeasure::className(), ['id' => 'unit_of_measure_id']);
    }

    /**
     * Gets query for [[Activity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(AwpbActivity::className(), ['id' => 'activity_id']);
    }

    public static function getByActivity($id) {
        $list = self::find()->where(['activity_id' => $id])->all();
        return ArrayHelper::map($list, 'id', 'name');
    }
    // }
    // public static function getList($id) {
    //     $list = self::find()->where(['activity_id' => $id])->all();
    //     return ArrayHelper::map($list, 'id', 'name');
    // }
    
    public static function getList() {
        $list = self::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($list, 'id', 'name');
    }
}
