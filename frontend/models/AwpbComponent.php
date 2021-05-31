<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "awpb_component".
 *
 * @property int $id
 * @property string $component_code
 * @property int $parent_component_id
 * @property string $component_description
 * @property string|null $component_outcome
 * @property string|null $component_output
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivity[] $awpbActivities
 * @property AwpbComponent $parentComponent
 * @property AwpbComponent[] $awpbComponents
 */
class AwpbComponent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_component';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['component_code', 'parent_component_id', 'component_description', 'created_at', 'updated_at'], 'required'],
            [['parent_component_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['component_outcome', 'component_output'], 'string'],
            [['component_code'], 'string', 'max' => 10],
            [['component_description'], 'string', 'max' => 255],
            [['parent_component_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbComponent::className(), 'targetAttribute' => ['parent_component_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'component_code' => 'Component Code',
            'parent_component_id' => 'Parent Component ID',
            'component_description' => 'Component Description',
            'component_outcome' => 'Component Outcome',
            'component_output' => 'Component Output',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[AwpbActivities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivities()
    {
        return $this->hasMany(AwpbActivity::className(), ['component_id' => 'id']);
    }

    /**
     * Gets query for [[ParentComponent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentComponent()
    {
        return $this->hasOne(AwpbComponent::className(), ['id' => 'parent_component_id']);
    }

    /**
     * Gets query for [[AwpbComponents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbComponents()
    {
        return $this->hasMany(AwpbComponent::className(), ['parent_component_id' => 'id']);
    }
}
