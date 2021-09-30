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
class AwpbActualInput extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    const STATUS_NOT_REQUESTED = 0;
    const STATUS_DISTRICT = 1;
    const STATUS_PROVINCIAL = 2;
    const STATUS_SPECIALIST = 3;
     const STATUS_DISBURSED = 4;
    //const STATUS_MINISTRY = 4;

    public $quarter;

    public static function tableName() {
        return 'awpb_actual_input';
    }
    
//    public function behaviors() {
//        return [
//            'timestamp' => [
//                'class' => 'yii\behaviors\TimestampBehavior',
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
//                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
//                ],
//            ],
//        ];
//    }
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

    public function rules() {
        return [
            [['component_id', 'activity_id', 'quarter_number', 'budget_id', 'name', 'unit_of_measure_id', 'unit_cost'], 'required'],
            [['activity_id', 'awpb_template_id', 'quarter_number', 'budget_id', 'input_id', 'status', 'unit_of_measure_id', 'cost_centre_id', 'camp_id', 'district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['unit_cost', 'mo_1', 'mo_2', 'mo_3', 'quarter_quantity', 'mo_1_amount', 'mo_2_amount', 'mo_3_amount', 'quarter_amount'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbComponent::className(), 'targetAttribute' => ['component_id' => 'id']],
            [['unit_of_measure_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbUnitOfMeasure::className(), 'targetAttribute' => ['unit_of_measure_id' => 'id']],
            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbBudget::className(), 'targetAttribute' => ['budget_id' => 'id']],
            [['input_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbInput::className(), 'targetAttribute' => ['input_id' => 'id']],
            [['awpb_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbTemplate::className(), 'targetAttribute' => ['awpb_template_id' => 'id']],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbActivity::className(), 'targetAttribute' => ['activity_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'component_id' => 'Component',
            'activity_id' => 'Activity',
            'awpb_template_id' => 'AWPB Template',
            'budget_id' => 'Budget',
            'input_id' => 'Input',
            'name' => 'Name',
            'quarter' => "",
            'quarter_number'=> "Quarter",
            'unit_cost' => 'Unit Cost',
            'mo_1' => 'Month 1 Qty',
            'mo_2' => 'Month 2 Qty',
            'mo_3' => 'Month 3 Qty',
            'quarter_quantity' => 'Quarter Qty',
            'mo_1_amount' => 'Month 1 Budget',
            'mo_2_amount' => 'Month 3 Budget',
            'mo_3_amount' => 'Month 3 Budget',
            'quarter_amount' => 'Quarter Budget',
            'status' => 'Status',
            'camp_id' => 'Camp',
            'cost_centre_id' => 'Cost Centre',
            'district_id' => 'District ID',
            'province_id' => 'Province ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public function getAwpbActualInput() {
        return $this->hasOne(AwpbActualInput::className(), ['id' => 'input_id']);
    }

    /**
     * Gets query for [[TemplateIndicator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateIndicator() {
        return $this->hasOne(AwpbActivityLine::className(), ['id' => 'template_indicator_id']);
    }

    /**
     * Gets query for [[AwpbTemplate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbTemplate() {
        return $this->hasOne(AwpbTemplate::className(), ['id' => 'awpb_template_id']);
    }

    /**
     * Gets query for [[Activity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActivity() {
        return $this->hasOne(AwpbActivity::className(), ['id' => 'activity_id']);
    }

    /**
     * Gets query for [[Indicator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndicator() {
        return $this->hasOne(AwpbIndicator::className(), ['id' => 'indicator_id']);
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict() {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

    public function getAwpbDistrict() {
        return $this->hasOne(AwpbDistrict::className(), ['district_id' => 'district_id', 'awpb_template_id' => 'awpb_template_id']);
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince() {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy() {
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy() {
        return $this->hasOne(Users::className(), ['id' => 'updated_by']);
    }

}
