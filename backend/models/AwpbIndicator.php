<?php

namespace backend\models;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use common\models\Role;

use yii\helpers\Html;

use yii\helpers\Url;

/**
 * This is the model class for table "awpb_indicator".
 *
 * @property int $id
 * @property int $component_id
 * @property string $name
 * @property string $description
 * @property int $unit_of_measure_id
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivity[] $awpbActivities
 * @property AwpbComponent $component
 * @property AwpbUnitOfMeasure $unitOfMeasure
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
            [['component_id', 'name', 'description', 'unit_of_measure_id', 'created_at', 'updated_at'], 'required'],
            [['component_id', 'unit_of_measure_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['description'], 'string', 'max' => 255],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbComponent::className(), 'targetAttribute' => ['component_id' => 'id']],
            [['unit_of_measure_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbUnitOfMeasure::className(), 'targetAttribute' => ['unit_of_measure_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'component_id' => 'Component ID',
            'name' => 'Name',
            'description' => 'Description',
            'unit_of_measure_id' => 'Unit Of Measure ID',
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
     * Gets query for [[Component]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComponent()
    {
        return $this->hasOne(AwpbComponent::className(), ['id' => 'component_id']);
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

    public static function getIndicatorsPerComponent($id) {
        $data = self::find()->orderBy(['name' => SORT_ASC])
      //  ->where(['component_id'=>40])
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


  
}
