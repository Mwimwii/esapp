<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_operation".
 *
 * @property int $id
 * @property string $operation_type
 * @property string $date_created
 *
 * @property MgfApplication[] $mgfApplications
 */
class MgfOperation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_operation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operation_type'], 'required'],
            [['date_created'], 'safe'],
            [['operation_type'], 'string', 'max' => 30],
            [['operation_type'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'operation_type' => 'Operation Type',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * Gets query for [[MgfApplications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfApplications()
    {
        return $this->hasMany(MgfApplication::className(), ['operation_id' => 'id']);
    }
}
