<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_position".
 *
 * @property int $id
 * @property string $position
 * @property string $date_created
 *
 * @property MgfContact[] $mgfContacts
 */
class MgfPosition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position'], 'required'],
            [['date_created'], 'safe'],
            [['position'], 'string', 'max' => 30],
            [['position'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position' => 'Position',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * Gets query for [[MgfContacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfContacts()
    {
        return $this->hasMany(MgfContact::className(), ['position_id' => 'id']);
    }
}
