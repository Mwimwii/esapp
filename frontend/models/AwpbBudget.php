<?php

namespace app\models;

use Yii;

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
class AwpbBudget extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
            [['component_id', 'output_id', 'activity_id', 'awpb_template_id', 'indicator_id', 'total_quantity', 'status', 'created_at', 'updated_at'], 'required'],
            [['component_id', 'output_id', 'activity_id', 'awpb_template_id', 'indicator_id', 'status', 'number_of_females', 'number_of_males', 'number_of_young_people', 'number_of_not_young_people', 'number_of_women_headed_households', 'number_of_non_women_headed_households', 'number_of_household_members', 'camp_id', 'district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['unit_cost', 'mo_1', 'mo_2', 'mo_3', 'mo_4', 'mo_5', 'mo_6', 'mo_7', 'mo_8', 'mo_9', 'mo_10', 'mo_11', 'mo_12', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_quantity', 'mo_1_amount', 'mo_2_amount', 'mo_3_amount', 'mo_4_amount', 'mo_5_amount', 'mo_6_amount', 'mo_7_amount', 'mo_8_amount', 'mo_9_amount', 'mo_10_amount', 'mo_11_amount', 'mo_12_amount', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount', 'mo_1_actual', 'mo_2_actual', 'mo_3_actual', 'mo_4_actual', 'mo_5_actual', 'mo_6_actual', 'mo_7_actual', 'mo_8_actual', 'mo_9_actual', 'mo_10_actual', 'mo_11_actual', 'mo_12_actual', 'quarter_one_actual', 'quarter_two_actual', 'quarter_three_actual', 'quarter_four_actual', 'number_of_females_actual', 'number_of_males_actual', 'number_of_young_people_actual', 'number_of_not_young_people_actual', 'number_of_women_headed_households_actual', 'number_of_non_women_headed_households_actual', 'number_of_household_members_actual'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['awpb_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbTemplate::className(), 'targetAttribute' => ['awpb_template_id' => 'id']],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbComponent::className(), 'targetAttribute' => ['component_id' => 'id']],
            [['output_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbOutput::className(), 'targetAttribute' => ['output_id' => 'id']],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbActivity::className(), 'targetAttribute' => ['activity_id' => 'id']],
            [['indicator_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbIndicator::className(), 'targetAttribute' => ['indicator_id' => 'id']],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['camp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Camp::className(), 'targetAttribute' => ['camp_id' => 'id']],
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
            'output_id' => 'Output ID',
            'activity_id' => 'Activity ID',
            'awpb_template_id' => 'Awpb Template ID',
            'indicator_id' => 'Indicator ID',
            'name' => 'Name',
            'unit_cost' => 'Unit Cost',
            'mo_1' => 'Mo 1',
            'mo_2' => 'Mo 2',
            'mo_3' => 'Mo 3',
            'mo_4' => 'Mo 4',
            'mo_5' => 'Mo 5',
            'mo_6' => 'Mo 6',
            'mo_7' => 'Mo 7',
            'mo_8' => 'Mo 8',
            'mo_9' => 'Mo 9',
            'mo_10' => 'Mo 10',
            'mo_11' => 'Mo 11',
            'mo_12' => 'Mo 12',
            'quarter_one_quantity' => 'Quarter One Quantity',
            'quarter_two_quantity' => 'Quarter Two Quantity',
            'quarter_three_quantity' => 'Quarter Three Quantity',
            'quarter_four_quantity' => 'Quarter Four Quantity',
            'total_quantity' => 'Total Quantity',
            'mo_1_amount' => 'Mo 1 Amount',
            'mo_2_amount' => 'Mo 2 Amount',
            'mo_3_amount' => 'Mo 3 Amount',
            'mo_4_amount' => 'Mo 4 Amount',
            'mo_5_amount' => 'Mo 5 Amount',
            'mo_6_amount' => 'Mo 6 Amount',
            'mo_7_amount' => 'Mo 7 Amount',
            'mo_8_amount' => 'Mo 8 Amount',
            'mo_9_amount' => 'Mo 9 Amount',
            'mo_10_amount' => 'Mo 10 Amount',
            'mo_11_amount' => 'Mo 11 Amount',
            'mo_12_amount' => 'Mo 12 Amount',
            'quarter_one_amount' => 'Quarter One Amount',
            'quarter_two_amount' => 'Quarter Two Amount',
            'quarter_three_amount' => 'Quarter Three Amount',
            'quarter_four_amount' => 'Quarter Four Amount',
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
