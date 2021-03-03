<?php

namespace backend\models;

use Yii;

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
            [['activity_id', 'name', 'unit_cost', 'total_quantity', 'total_amount', 'status', 'created_at', 'updated_at'], 'required'],
            [['activity_id', 'status', 'district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['unit_cost', 'mo_1', 'mo_2', 'mo_3', 'mo_4', 'mo_5', 'mo_6', 'mo_7', 'mo_8', 'mo_9', 'mo_10', 'mo_11', 'mo_12', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_quantity', 'total_amount'], 'number'],
            [['name'], 'string', 'max' => 255],
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
            'activity_id' => 'Activity ID',
            'name' => 'Name',
            'unit_cost' => 'Unit Cost',
            'mo_1' => 'Mo 1',
            'mo_2' => 'Mo 2',
            'mo_3' => 'Mo 3',
            'mo_4' => 'Mo 4',
            'mo_5' => 'Mo 5',
            'mo_6' => 'Mo 6',
            'mo_7' => 'Mo 7',
            'mo_8' => 'Mo 8',
            'mo_9' => 'Mo 9',
            'mo_10' => 'Mo 10',
            'mo_11' => 'Mo 11',
            'mo_12' => 'Mo 12',
            'quarter_one_quantity' => 'Quarter One Quantity',
            'quarter_two_quantity' => 'Quarter Two Quantity',
            'quarter_three_quantity' => 'Quarter Three Quantity',
            'quarter_four_quantity' => 'Quarter Four Quantity',
            'total_quantity' => 'Total Quantity',
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
