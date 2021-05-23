<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "awpb_unit_of_measure".
 *
 * @property int $id
 * @property string $description
 *
 * @property AwpbActivity[] $awpbActivities
 */
class AwpbUnitOfMeasure extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_unit_of_measure';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[AwpbActivities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivities()
    {
        return $this->hasMany(AwpbActivity::className(), ['unit_of_measure_id' => 'id']);
    }
}
