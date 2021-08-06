<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "awpb_district".
 *
 * @property int $id
 * @property int $awpb_template_id
 * @property int|null $district_id
 * @property int|null $cost_centre_id
 * @property int|null $province_id
 * @property string $name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbTemplate $awpbTemplate
 * @property AwpbCostCentre $costCentre
 * @property Province $province
 * @property District $district
 */
class AwpbTemplateComponent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_template_component';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['awpb_template_id', 'component_id','status'], 'required'],
            [['awpb_template_id',   'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['awpb_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbTemplate::className(), 'targetAttribute' => ['awpb_template_id' => 'id']],
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
            'awpb_template_id' => 'Awpb Template ID',
           
                      'component_id' => 'Component',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[AwpbTemplate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbTemplate()
    {
        return $this->hasOne(AwpbTemplate::className(), ['id' => 'awpb_template_id']);
    }

    /**
     * Gets query for [[CostCentre]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComponent()
    {
        return $this->hasOne(AwpbComponent::className(), ['id' => 'component_id']);
    }

 

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
  
//    
//     public static function getAwpbDistricts() {
//
//        $query = static::find()
//                ->select(['name', 'district_id as id'])          
//                ->orderBy(['name' => SORT_ASC])
//                ->asArray()
//                ->all();
//        return ArrayHelper::map($query, 'id', 'name');
//    
//}
 public static function getAwpbTemplateComponents($template_id) {
    
        $activties = self::find()
                ->select(['component_id', 'name'])
            
                ->where(['awpb_template_id'=>$template_id])
                 
                ->all();
      // $list = ArrayHelper::map($activties, 'id', 'name');
        return  $activties;






}}
