<?php

namespace backend\models;

use Yii;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "awpb_input".
 *
 * @property int $id
 * @property int $activity_id
 * @property int $awpb_template_id
 * @property int $indicator_id
 * @property int $template_indicator_id
 * @property string $name
 * @property float $unit_cost
 * @property float|null $mo_1
 * @property float|null $mo_2
 * @property float|null $mo_3
 * @property float|null $mo_4
 * @property float|null $mo_5
 * @property float|null $mo_6
 * @property float|null $mo_7
 * @property float|null $mo_8
 * @property float|null $mo_9
 * @property float|null $mo_10
 * @property float|null $mo_11
 * @property float|null $mo_12
 * @property float|null $quarter_one_quantity
 * @property float|null $quarter_two_quantity
 * @property float|null $quarter_three_quantity
 * @property float|null $quarter_four_quantity
 * @property float|null $total_quantity
 * @property float|null $mo_1_amount
 * @property float|null $mo_2_amount
 * @property float|null $mo_3_amount
 * @property float|null $mo_4_amount
 * @property float|null $mo_5_amount
 * @property float|null $mo_6_amount
 * @property float|null $mo_7_amount
 * @property float|null $mo_8_amount
 * @property float|null $mo_9_amount
 * @property float|null $mo_10_amount
 * @property float|null $mo_11_amount
 * @property float|null $mo_12_amount
 * @property float|null $quarter_one_amount
 * @property float|null $quarter_two_amount
 * @property float|null $quarter_three_amount
 * @property float|null $quarter_four_amount
 * @property float|null $total_amount
 * @property float|null $mo_1_actual
 * @property float|null $mo_2_actual
 * @property float|null $mo_3_actual
 * @property float|null $mo_4_actual
 * @property float|null $mo_5_actual
 * @property float|null $mo_6_actual
 * @property float|null $mo_7_actual
 * @property float|null $mo_8_actual
 * @property float|null $mo_9_actual
 * @property float|null $mo_10_actual
 * @property float|null $mo_11_actual
 * @property float|null $mo_12_actual
 * @property int $status
 * @property int|null $district_id
 * @property int|null $province_id
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivityLine $templateIndicator
 * @property AwpbTemplate $awpbTemplate
 * @property AwpbActivity $activity
 * @property AwpbIndicator $indicator
 * @property District $district
 * @property Province $province
 * @property Users $createdBy
 * @property Users $updatedBy
 */
class AwpbInput extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
        const STATUS_DRAFT = 0;
    const STATUS_SUBMITTED = 1;
    const STATUS_REVIEWED = 2;
    const STATUS_APPROVED = 3;
    const STATUS_MINISTRY = 4;

    public $quarter;
    public static function tableName()
    {
        return 'awpb_input';
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

            [['component_id', 'budget_id', 'name','unit_of_measure_id', 'unit_cost'], 'required'],
            [['activity_id', 'awpb_template_id', 'indicator_id', 'budget_id', 'status','unit_of_measure_id','cost_centre_id', 'camp_id','district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['unit_cost', 'mo_1', 'mo_2', 'mo_3', 'mo_4', 'mo_5', 'mo_6', 'mo_7', 'mo_8', 'mo_9', 'mo_10', 'mo_11', 'mo_12', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_quantity', 'mo_1_amount', 'mo_2_amount', 'mo_3_amount', 'mo_4_amount', 'mo_5_amount', 'mo_6_amount', 'mo_7_amount', 'mo_8_amount', 'mo_9_amount', 'mo_10_amount', 'mo_11_amount', 'mo_12_amount', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount', 'mo_1_actual', 'mo_2_actual', 'mo_3_actual', 'mo_4_actual', 'mo_5_actual', 'mo_6_actual', 'mo_7_actual', 'mo_8_actual', 'mo_9_actual', 'mo_10_actual', 'mo_11_actual', 'mo_12_actual'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbComponent::className(), 'targetAttribute' => ['component_id' => 'id']],
            [['output_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbOutput::className(), 'targetAttribute' => ['output_id' => 'id']],
            [['unit_of_measure_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbUnitOfMeasure::className(), 'targetAttribute' => ['unit_of_measure_id' => 'id']],

            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbBudget::className(), 'targetAttribute' => ['budget_id' => 'id']],
            [['awpb_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbTemplate::className(), 'targetAttribute' => ['awpb_template_id' => 'id']],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbActivity::className(), 'targetAttribute' => ['activity_id' => 'id']],
            [['indicator_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbIndicator::className(), 'targetAttribute' => ['indicator_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
             'component_id' => 'Component',
            'output_id' => 'Output',

            'activity_id' => 'Activity',
            'awpb_template_id' => 'AWPB Template',
            'indicator_id' => 'Programme Indicator',
             'budget_id' => 'Budget',
            'name' => 'Name',

            'quarter'=>"",
            'unit_cost' => 'Unit Cost',
            'mo_1' => 'Jan Qty',
            'mo_2' => 'Feb Qty',
            'mo_3' => 'Mar Qty',
            'mo_4' => 'Apr Qty',
            'mo_5' => 'May Qty',
            'mo_6' => 'Jun Qty',
            'mo_7' => 'Jul Qty',
            'mo_8' => 'Aug Qty',
            'mo_9' => 'Sep Qty',
            'mo_10' => 'Oct Qty',
            'mo_11' => 'Nov Qty',
            'mo_12' => 'Dec Qty',

            'quarter_one_quantity' => 'Q1 Qty',
            'quarter_two_quantity' => 'Q2 Qty',
            'quarter_three_quantity' => 'Q3 Qty',
            'quarter_four_quantity' => 'Q4 Qty',
            'total_quantity' => 'Total Qty',

            'mo_1_amount' => 'Jan Amt',
            'mo_2_amount' => 'Feb Amt',
            'mo_3_amount' =>'Mar Amt',
            'mo_4_amount' => 'Apr Amt',
            'mo_5_amount' => 'May Amt',
            'mo_6_amount' => 'Jun Amt',
            'mo_7_amount' => 'Jul Amt',
            'mo_8_amount' => 'Aug Amt',
            'mo_9_amount' => 'Sep Amt',
            'mo_10_amount' => 'Oct Amt',
            'mo_11_amount' => 'Nov',
            'mo_12_amount' => 'Dec Amt',

            'quarter_one_amount' => 'Q1 Budget',
            'quarter_two_amount' => 'Q2 Budget',
            'quarter_three_amount' => 'Q3 Budget',
            'quarter_four_amount' => 'Q4 Budget',

            'total_amount' => 'Activity Budget',

      
            'mo_1_actual' => 'Mo 1 Actual',
            'mo_2_actual' => 'Mo 2 Actual',
            'mo_3_actual' => 'Mo 3 Actual',
            'mo_4_actual' => 'Mo 4 Actual',
            'mo_5_actual' => 'Mo 5 Actual',
            'mo_6_actual' => 'Mo 6 Actual',
            'mo_7_actual' => 'Mo 7 Actual',
            'mo_8_actual' => 'Mo 8 Actual',
            'mo_9_actual' => 'Mo 9 Actual',
            'mo_10_actual' => 'Mo 10 Actual',
            'mo_11_actual' => 'Mo 11 Actual',
            'mo_12_actual' => 'Mo 12 Actual',
            'status' => 'Status',
            'camp_id'=>'Camp',

            'cost_centre_id'=>'Cost Centre',

            'district_id' => 'District ID',
            'province_id' => 'Province ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    
//    public function beforeDelete() {
//  //$this->awpbActualInput->delete();
//
//  // call the parent implementation so that this event is raise properly
//  //return parent::beforeDelete();
//}
    
    public function getAwpbActualInput()
    {
        return $this->hasOne(AwpbActualInput::className(), ['input_id' => 'id']);
    }


    /**
     * Gets query for [[TemplateIndicator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateIndicator()
    {
        return $this->hasOne(AwpbActivityLine::className(), ['id' => 'template_indicator_id']);
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
     * Gets query for [[Activity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(AwpbActivity::className(), ['id' => 'activity_id']);
    }

    /**
     * Gets query for [[Indicator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndicator()
    {
        return $this->hasOne(AwpbIndicator::className(), ['id' => 'indicator_id']);
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

        public function getAwpbDistrict()
   {
        return $this->hasOne(AwpbDistrict::className(), ['district_id' => 'district_id','awpb_template_id'=>'awpb_template_id']);
    }


    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'updated_by']);
    }
}
