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
class AwpbDistrict extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    const STATUS_QUARTER_CLOSED = 0;
    const STATUS_QUARTER_OPEN = 1;
    const STATUS_QUARTER_REQUESTED = 2;
    const STATUS_QUARTER_APPROVED = 3;
     const STATUS_QUARTER_DISBURSED = 4;

    public static function tableName()
    {
        return 'awpb_district';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['awpb_template_id', 'name', 'status'], 'required'],
            [['awpb_template_id', 'district_id', 'cost_centre_id', 'province_id', 'status','funds_request', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount','quarter_one_actual', 'quarter_two_actual', 'quarter_three_actual', 'quarter_four_actual'], 'number'],       
            [['name'], 'string', 'max' => 255],
            [['awpb_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbTemplate::className(), 'targetAttribute' => ['awpb_template_id' => 'id']],
            [['cost_centre_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbCostCentre::className(), 'targetAttribute' => ['cost_centre_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
        ];
    }
        
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'awpb_template_id' => 'Awpb Template ID',
            'district_id' => 'District ID',
            'cost_centre_id' => 'Cost Centre ID',
            'province_id' => 'Province ID',
            'name' => 'Name',
            'status' => 'Status',
            'funds_request'=>'Funds Request Status',
             'quarter_one_amount' => 'Q1 Amount',
            'quarter_two_amount' => 'Q2 Amount',
            'quarter_three_amount' => 'Q3 Amount',
            'quarter_four_amount' => 'Q4 Amount',
            'quarter_one_actual' => 'Quarter One Actual',
            'quarter_two_actual' => 'Quarter Two Actual',
            'quarter_three_actual' => 'Quarter Three Actual',
            'quarter_four_actual' => 'Quarter Four Actual',
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
    public function getDistrict()
    {
      //  return $this->hasOne(Districts::className(), ['id' => 'district_id']);
    }
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
 public static function getAwpbDistricts($template_id) {
    
        $activties = self::find()
                ->select(['district_id', 'name'])
            
                ->where(['awpb_template_id'=>$template_id])
                 ->andWhere(['>', 'district_id',0])
                ->all();
      // $list = ArrayHelper::map($activties, 'id', 'name');
        return  $activties;

 }
  public function getAwpbInputs()
    {
        return $this->hasMany(AwpbInput::class, ['district_id' => 'district_id','awpb_template_id'=>'awpb_template_id']);
    }
 public static function getAwpbDistrictList($id) {
     $template_model =  \backend\models\AwpbTemplate::find()->where(['status' =>\backend\models\AwpbTemplate::STATUS_PUBLISHED])->one();
        $data = self::find()->where(['=', 'awpb_district.province_id', $id])->andWhere(['=', 'awpb_template_id',$template_model->id])->orderBy(['name' => SORT_ASC])->all();
        $list = ArrayHelper::map($data, 'id', 'name');
        return $list;
    }
  
// public static function getAwpbDistrictList($id) {
//
//        $data= self::find()
//        ->select(['district.name as name', 'district.id as id'])
//        ->join('LEFT JOIN', 'district', 'district.id = awpb_district.district_id')
//        ->where(['=', 'awpb_district.province_id', $id])
//         ->all();
//
// return $data;
//}


 }