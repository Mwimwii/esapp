<?php

namespace backend\models;

use Yii;use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "awpb_output".
 *
 * @property int $id
 * @property string $code
 * @property int $component_id
 * @property int|null $outcome_id
 * @property string $name
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivity[] $awpbActivities
 * @property AwpbOutcome $outcome
 * @property AwpbComponent $component
 */
class AwpbOutput extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_output';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'component_id', 'name', 'description'], 'required'],
            [['component_id', 'outcome_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 40],
            [['description'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['outcome_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbOutcome::className(), 'targetAttribute' => ['outcome_id' => 'id']],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbComponent::className(), 'targetAttribute' => ['component_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'component_id' => 'Component',
            'outcome_id' => 'Outcome',
            'name' => 'Name',
            'description' => 'Description',
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
        return $this->hasMany(AwpbActivity::className(), ['output_id' => 'id']);
    }

    /**
     * Gets query for [[Outcome]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOutcome()
    {
        return $this->hasOne(AwpbOutcome::className(), ['id' => 'outcome_id']);
    }

    /**
     * Gets query for [[Component]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComponent()
    {
        return $this->hasOne(AwpbComponent::className(), ['id' => 'component_id']);
    }
    public static function getOutputs() {
        $data = self::find()->orderBy(['name' => SORT_ASC])
        //->where(['id'=>$id])
        ->all();
        $list = ArrayHelper::map($data, 'id','name');
        return $list;
    }

}
