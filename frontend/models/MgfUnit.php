<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_unit".
 *
 * @property int $id
 * @property string $unit
 * @property string $synonym
 * @property int $user_id
 * @property string $date_created
 *
 * @property Users $user
 */
class MgfUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit', 'synonym', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['date_created'], 'safe'],
            [['unit'], 'string', 'max' => 30],
            [['synonym'], 'string', 'max' => 11],
            [['unit'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit' => 'Unit',
            'synonym' => 'Synonym',
            'user_id' => 'User ID',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
