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
class AwpbProvince extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_province';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['awpb_template_id', 'province_id','status'], 'required'],
            [['awpb_template_id',  'cost_centre_id', 'province_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['awpb_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbTemplate::className(), 'targetAttribute' => ['awpb_template_id' => 'id']],
            [['cost_centre_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbCostCentre::className(), 'targetAttribute' => ['cost_centre_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
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
           
            'cost_centre_id' => 'Cost Centre ID',
            'province_id' => 'Province ID',
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
    public function getCostCentre()
    {
        return $this->hasOne(AwpbCostCentre::className(), ['id' => 'cost_centre_id']);
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Provinces::className(), ['id' => 'province_id']);
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
 public static function getAwpbProvince($template_id) {
    
        $activties = self::find()
                ->select(['province_id', 'name'])
            
                ->where(['awpb_template_id'=>$template_id])
                 
                ->all();
      // $list = ArrayHelper::map($activties, 'id', 'name');
        return  $activties;






}}
