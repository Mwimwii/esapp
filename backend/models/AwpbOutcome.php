
<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "awpb_outcome".
 *
 * @property int $id
 * @property string $outcome_code
 * @property int $component_id
 * @property string $name
 * @property string $outcome_description
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivity[] $awpbActivities
 * @property AwpbComponent $component
 * @property AwpbOutput[] $awpbOutputs
 */
class AwpbOutcome extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_outcome';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['outcome_code', 'name', 'outcome_description', 'created_at', 'updated_at'], 'required'],
            [['component_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['outcome_code'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 40],
            [['outcome_description'], 'string', 'max' => 255],
            [['outcome_code'], 'unique'],
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
            'outcome_code' => 'Outcome Code',
            'component_id' => 'Component',
            'name' => 'Name',
            'outcome_description' => 'Description',
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
        return $this->hasMany(AwpbActivity::className(), ['outcome_id' => 'id']);
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
     * Gets query for [[AwpbOutputs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbOutputs()
    {
        return $this->hasMany(AwpbOutput::className(), ['outcome_id' => 'id']);
    }
    public static function getAwpbComponentOutcomes($id)
    {
        $awpboutcomes = self::find()
            ->select(['id','name'])
            ->where(['component_id'=>$id])
            ->asArray()
            ->all();
        return  $awpboutcomes;
   
    }
    // public static function getOutcomes($id) {
    //     $data = self::find()->orderBy(['name' => SORT_ASC])
    //     ->where(['id'=>$id])
    //     ->all();
    //     $list = ArrayHelper::map($data, 'id','name');
    //     return $list;
    // }
    public static function getOutcomes($id) {
        $data = self::find()->orderBy(['name' => SORT_ASC])
        ->where(['id'=>$id])
        ->all();
        $list = ArrayHelper::map($data, 'id','name');
        return $list;
    }
    public static function getAllOutcomes() {
        $data = self::find()->orderBy(['name' => SORT_ASC])
        //->where(['id'=>$id])
        ->all();
        $list = ArrayHelper::map($data, 'id','name');
        return $list;
    }
}

