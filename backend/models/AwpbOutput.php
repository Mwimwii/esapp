<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

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
 * @property AwpbActivityLine[] $awpbActivityLines
 * @property AwpbBudget[] $awpbBudgets
 * @property AwpbIndicator[] $awpbIndicators
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
      public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function rules()
    {
        return [
            [['code', 'component_id', 'name', 'description',], 'required'],
            [['component_id', 'outcome_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
           [['code'], 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('code');
                }, 'message' => 'Code already in use!'],
            [['name'], 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('name');
                }, 'message' => 'Name already in use!'],
            [['description'], 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('description');
                }, 'message' => 'Description already in use!'],
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
            'component_id' => 'Component ID',
            'outcome_id' => 'Outcome ID',
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
     * Gets query for [[AwpbActivityLines]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivityLines()
    {
        return $this->hasMany(AwpbActivityLine::className(), ['output_id' => 'id']);
    }

    /**
     * Gets query for [[AwpbBudgets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbBudgets()
    {
        return $this->hasMany(AwpbBudget::className(), ['output_id' => 'id']);
    }

    /**
     * Gets query for [[AwpbIndicators]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbIndicators()
    {
        return $this->hasMany(AwpbIndicator::className(), ['output_id' => 'id']);
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
