<?php

namespace backend\models;


use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "awpb_budget".
 *
 * @property int $id
 * @property int $component_id
 * @property int $output_id
 * @property int $activity_id
 * @property int $awpb_template_id
 * @property int $indicator_id
 * @property string|null $name
 * @property float|null $unit_cost
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
 * @property float $total_quantity
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
 * @property float|null $quarter_one_actual
 * @property float|null $quarter_two_actual
 * @property float|null $quarter_three_actual
 * @property float|null $quarter_four_actual
 * @property int $status
 * @property int|null $number_of_females
 * @property int|null $number_of_males
 * @property int|null $number_of_young_people
 * @property int|null $number_of_not_young_people
 * @property int|null $number_of_women_headed_households
 * @property int|null $number_of_non_women_headed_households
 * @property int|null $number_of_household_members
 * @property float|null $number_of_females_actual
 * @property float|null $number_of_males_actual
 * @property float|null $number_of_young_people_actual
 * @property float|null $number_of_not_young_people_actual
 * @property float|null $number_of_women_headed_households_actual
 * @property float|null $number_of_non_women_headed_households_actual
 * @property float|null $number_of_household_members_actual
 * @property int|null $camp_id
 * @property int|null $district_id
 * @property int|null $province_id
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbTemplate $awpbTemplate
 * @property AwpbComponent $component
 * @property AwpbOutput $output
 * @property AwpbActivity $activity
 * @property AwpbIndicator $indicator
 * @property District $district
 * @property Province $province
 * @property Camp $camp
 * @property AwpbInput[] $awpbInputs
 */
class AwpbBudget_1 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	const STATUS_DRAFT = 0;
    const STATUS_SUBMITTED = 1;
    const STATUS_REVIEWED = 2;
    const STATUS_APPROVED = 3;
    const STATUS_MINISTRY = 4;
    public static function tableName()
    {
        return 'awpb_budget';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['component_id',  'activity_id', 'awpb_template_id', 'cost_centre_id'], 'required'],
            [['component_id', 'output_id', 'activity_id', 'awpb_template_id', 'indicator_id','cost_centre_id', 'status', 'number_of_females', 'number_of_males', 'number_of_young_people', 'number_of_not_young_people', 'number_of_women_headed_households', 'number_of_non_women_headed_households', 'number_of_household_members', 'camp_id', 'district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['unit_cost', 'mo_1', 'mo_2', 'mo_3', 'mo_4', 'mo_5', 'mo_6', 'mo_7', 'mo_8', 'mo_9', 'mo_10', 'mo_11', 'mo_12', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_quantity', 'mo_1_amount', 'mo_2_amount', 'mo_3_amount', 'mo_4_amount', 'mo_5_amount', 'mo_6_amount', 'mo_7_amount', 'mo_8_amount', 'mo_9_amount', 'mo_10_amount', 'mo_11_amount', 'mo_12_amount', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount', 'mo_1_actual', 'mo_2_actual', 'mo_3_actual', 'mo_4_actual', 'mo_5_actual', 'mo_6_actual', 'mo_7_actual', 'mo_8_actual', 'mo_9_actual', 'mo_10_actual', 'mo_11_actual', 'mo_12_actual', 'quarter_one_actual', 'quarter_two_actual', 'quarter_three_actual', 'quarter_four_actual', 'number_of_females_actual', 'number_of_males_actual', 'number_of_young_people_actual', 'number_of_not_young_people_actual', 'number_of_women_headed_households_actual', 'number_of_non_women_headed_households_actual', 'number_of_household_members_actual'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['awpb_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbTemplate::className(), 'targetAttribute' => ['awpb_template_id' => 'id']],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbComponent::className(), 'targetAttribute' => ['component_id' => 'id']],
            [['output_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbOutput::className(), 'targetAttribute' => ['output_id' => 'id']],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbActivity::className(), 'targetAttribute' => ['activity_id' => 'id']],
            [['indicator_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbIndicator::className(), 'targetAttribute' => ['indicator_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['camp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Camps::className(), 'targetAttribute' => ['camp_id' => 'id']],
            [['cost_centre_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbCostCentre::className(), 'targetAttribute' => ['cost_centre_id' => 'id']],
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
            'awpb_template_id' => 'Template',
            'indicator_id' => 'Indicator',
            'cost_centre_id'=>"Cost Centre",
            'name' => 'Name',
             'unit_of_measure_id' => 'Unit Of Measure',
            'unit_cost' => 'Unit Cost',
            'mo_1' => 'Jan',
            'mo_2' => 'Feb',
            'mo_3' => 'Mar',
            'mo_4' => 'Apr',
            'mo_5' => 'May',
            'mo_6' => 'Jun',
            'mo_7' => 'Jul',
            'mo_8' => 'Aug',
            'mo_9' => 'Sep',
            'mo_10' => 'Oct',
            'mo_11' => 'Nov',
            'mo_12' => 'Dec',
         'quarter_one_quantity' => 'Q1 Qty',
            'quarter_two_quantity' => 'Q2 Qty',
            'quarter_three_quantity' => 'Q3 Qty',
            'quarter_four_quantity' => 'Q4 Qty',
            'total_quantity' => 'Total Quantity',
     'mo_1_amount' => 'Jan Amt',
            'mo_2_amount' => 'Feb Amt',
            'mo_3_amount' => 'Mar Amt',
            'mo_4_amount' => 'Apr Amt',
            'mo_5_amount' => 'May Amt',
            'mo_6_amount' => 'Jun Amt',
            'mo_7_amount' => 'Jul Amt',
            'mo_8_amount' => 'Aug Amt',
            'mo_9_amount' => 'Sep Amt',
            'mo_10_amount' => 'Oct Amt',
            'mo_11_amount' => 'Nov Amt',
            'mo_12_amount' => 'Dec Amt',
           'quarter_one_amount' => 'Q1 Amount',
            'quarter_two_amount' => 'Q2 Amount',
            'quarter_three_amount' => 'Q3 Amount',
            'quarter_four_amount' => 'Q4 Amount',
            'total_amount' => 'Total Amount',
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
            'quarter_one_actual' => 'Quarter One Actual',
            'quarter_two_actual' => 'Quarter Two Actual',
            'quarter_three_actual' => 'Quarter Three Actual',
            'quarter_four_actual' => 'Quarter Four Actual',
            'status' => 'Status',
            'number_of_females' => 'Number Of Females',
            'number_of_males' => 'Number Of Males',
            'number_of_young_people' => 'Number Of Young People',
            'number_of_not_young_people' => 'Number Of Not Young People',
            'number_of_women_headed_households' => 'Number Of Women Headed Households',
            'number_of_non_women_headed_households' => 'Number Of Non Women Headed Households',
            'number_of_household_members' => 'Number Of Household Members',
            'number_of_females_actual' => 'Number Of Females Actual',
            'number_of_males_actual' => 'Number Of Males Actual',
            'number_of_young_people_actual' => 'Number Of Young People Actual',
            'number_of_not_young_people_actual' => 'Number Of Not Young People Actual',
            'number_of_women_headed_households_actual' => 'Number Of Women Headed Households Actual',
            'number_of_non_women_headed_households_actual' => 'Number Of Non Women Headed Households Actual',
            'number_of_household_members_actual' => 'Number Of Household Members Actual',
            'camp_id' => 'Camp ID',
            'district_id' => 'District ID',
            'province_id' => 'Province ID',
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
     * Gets query for [[Camp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCamp()
    {
        return $this->hasOne(Camp::className(), ['id' => 'camp_id']);
    }

       public function getCostCentre()
    {
        return $this->hasOne(AwpbCostCentre::className(), ['id' => 'cost_centre_id']);
    }
    /**
     * Gets query for [[AwpbInputs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbInputs()
    {
        return $this->hasMany(AwpbInput::className(), ['budget_id' => 'id']);
    }
}
