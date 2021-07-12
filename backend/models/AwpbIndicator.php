<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "awpb_indicator".
 *
 * @property int $id
 * @property int $activity_id
 * @property int $component_id
 * @property int $outcome_id
 * @property int|null $output_id
 * @property string $name
 * @property string $description
 * @property int $unit_of_measure_id
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivity[] $awpbActivities
 * @property AwpbActivityLine[] $awpbActivityLines
 * @property AwpbUnitOfMeasure $unitOfMeasure
 * @property AwpbActivity $activity
 * @property AwpbComponent $component
 * @property AwpbOutput $output
 */
class AwpbIndicator extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_indicator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['component_id','output_id', 'unit_of_measure_id', 'name', 'description', 'unit_of_measure_id','programme_target'], 'required'],
            [['activity_id', 'component_id', 'outcome_id', 'output_id', 'unit_of_measure_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['programme_target'], 'number'],
            [['description'], 'string', 'max' => 255],
            [['unit_of_measure_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbUnitOfMeasure::className(), 'targetAttribute' => ['unit_of_measure_id' => 'id']],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbActivity::className(), 'targetAttribute' => ['activity_id' => 'id']],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbComponent::className(), 'targetAttribute' => ['component_id' => 'id']],
            [['output_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbOutput::className(), 'targetAttribute' => ['output_id' => 'id']],
              //  [['camp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Camps::className(), 'targetAttribute' => ['camp_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Activity',
            'component_id' => 'Component',
            'outcome_id' => 'Outcome',
            'output_id' => 'Output',
            'name' => 'Name',
            'description' => 'Description',
            'programme_target' => 'Programme Target',
            'unit_of_measure_id' => 'Unit Of Measure',
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
        return $this->hasMany(AwpbActivity::className(), ['indicator_id' => 'id']);
    }

    /**
     * Gets query for [[AwpbActivityLines]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivityLines()
    {
        return $this->hasMany(AwpbActivityLine::className(), ['indicator_id' => 'id']);
    }

    /**
     * Gets query for [[UnitOfMeasure]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnitOfMeasure()
    {
        return $this->hasOne(AwpbUnitOfMeasure::className(), ['id' => 'unit_of_measure_id']);
    }

    /**
     * Gets query for [[Activity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(AwpbActivity::className(), ['id' => 'activity_id']);
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

    /**
     * Gets query for [[Output]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOutput()
    {
        return $this->hasOne(AwpbOutput::className(), ['id' => 'output_id']);
    }
    public static function getIndicatorsPerComponent($id) {
        $data = self::find()->orderBy(['name' => SORT_ASC])

      ->where(['component_id'=>$id])
        ->all();
        $list = ArrayHelper::map($data, 'id','name');
        return $list;
    }
    public static function getAwpbComponentIndicators($id)
    {
        $awpbindicators = self::find()
            ->select(['id','name'])
            ->where(['component_id'=>$id])
            ->asArray()
            ->all();
        return  $awpbindicators;
   
    }
    public static function getIndicators() {
        $data = self::find()->orderBy(['name' => SORT_ASC])
        ->orderBy(['activity_id' => SORT_ASC])
     // ->where(['component_id'=>$id])
        ->all();
        $list = ArrayHelper::map($data, 'id','name');
        return $list;
    }
}
