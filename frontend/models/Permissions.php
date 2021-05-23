<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "permissions".
 *
 * @property int $id
 * @property string|null $right
 * @property string|null $definition
 * @property int $active
 *
 * @property Rolepermission[] $rolepermissions
 */
class Permissions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permissions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['right', 'definition'], 'string'],
            [['active'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'right' => 'Right',
            'definition' => 'Definition',
            'active' => 'Active',
        ];
    }

    /**
     * Gets query for [[Rolepermissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRolepermissions()
    {
        return $this->hasMany(Rolepermission::className(), ['permission_id' => 'id']);
    }
}
