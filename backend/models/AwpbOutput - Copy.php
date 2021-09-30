<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "awpb_output".
 *
 * @property int $id
 * @property int $outcome_id
 * @property string $name
 * @property string $output_description
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivity[] $awpbActivities
 * @property AwpbOutcome $outcome
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
            [['outcome_id', 'name', 'output_description', 'created_at', 'updated_at'], 'required'],
            [['component_id','outcome_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['output_description'], 'string', 'max' => 255],
            [['outcome_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbOutcome::className(), 'targetAttribute' => ['outcome_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'component_id'=>'Component',
            'outcome_id'=>'Outcome',
            'name' => 'Name',
            'output_description' => 'Description',
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
    public static function getOutputs() {
        $data = self::find()->orderBy(['name' => SORT_ASC])
        //->where(['id'=>$id])
        ->all();
        $list = ArrayHelper::map($data, 'id','name');
        return $list;
    }
}
