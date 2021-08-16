<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "awpb_funding_type".
 *
 * @property int $id
 * @property string $funding_type_code
 * @property string $funding_type_name
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class AwpbFundingType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_funding_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'funding_type_code', 'funding_type_name', 'created_at', 'updated_at'], 'required'],
            [['id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['funding_type_code'], 'string', 'max' => 6],
            [['funding_type_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'funding_type_code' => 'Funding Type Code',
            'funding_type_name' => 'Funding Type Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
