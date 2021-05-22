<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "awpb_funder".
 *
 * @property int $id
 * @property string $funder_code
 * @property string $funder_name
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivityFunder[] $awpbActivityFunders
 */
class AwpbFunder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_funder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['funder_code', 'funder_name', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['funder_code'], 'string', 'max' => 6],
            [['funder_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'funder_code' => 'Funder Code',
            'funder_name' => 'Funder Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[AwpbActivityFunders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivityFunders()
    {
        return $this->hasMany(AwpbActivityFunder::className(), ['funder_id' => 'id']);
    }
}
