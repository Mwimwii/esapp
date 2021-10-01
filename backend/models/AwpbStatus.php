<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "awpb_status".
 *
 * @property int $id
 * @property int $awpb_template_id
 * @property int $status
 * @property int|null $cost_centre_id
 * @property int|null $camp_id
 * @property int|null $district_id
 * @property int|null $province_id
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class AwpbStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['awpb_template_id', 'status', 'created_at', 'updated_at'], 'required'],
            [['awpb_template_id', 'status', 'cost_centre_id', 'camp_id', 'district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'awpb_template_id' => 'Awpb Template ID',
            'status' => 'Status',
            'cost_centre_id' => 'Cost Centre ID',
            'camp_id' => 'Camp ID',
            'district_id' => 'District ID',
            'province_id' => 'Province ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
