<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbBudget;

/**
 * AwpbBudgetSearch represents the model behind the search form of `backend\models\AwpbBudget`.
 */

class AwpbBudgetSearch extends AwpbBudget
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'component_id', 'output_id', 'activity_id', 'awpb_template_id', 'indicator_id', 'status', 'number_of_females', 'number_of_males', 'number_of_young_people', 'number_of_not_young_people', 'number_of_women_headed_households', 'number_of_non_women_headed_households', 'number_of_household_members', 'camp_id', 'district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'safe'],

            [['unit_cost', 'mo_1', 'mo_2', 'mo_3', 'mo_4', 'mo_5', 'mo_6', 'mo_7', 'mo_8', 'mo_9', 'mo_10', 'mo_11', 'mo_12', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_quantity', 'mo_1_amount', 'mo_2_amount', 'mo_3_amount', 'mo_4_amount', 'mo_5_amount', 'mo_6_amount', 'mo_7_amount', 'mo_8_amount', 'mo_9_amount', 'mo_10_amount', 'mo_11_amount', 'mo_12_amount', 'quarter_one_amount', 'quarter_two_amount', 'quarter_three_amount', 'quarter_four_amount', 'total_amount', 'mo_1_actual', 'mo_2_actual', 'mo_3_actual', 'mo_4_actual', 'mo_5_actual', 'mo_6_actual', 'mo_7_actual', 'mo_8_actual', 'mo_9_actual', 'mo_10_actual', 'mo_11_actual', 'mo_12_actual', 'quarter_one_actual', 'quarter_two_actual', 'quarter_three_actual', 'quarter_four_actual', 'number_of_females_actual', 'number_of_males_actual', 'number_of_young_people_actual', 'number_of_not_young_people_actual', 'number_of_women_headed_households_actual', 'number_of_non_women_headed_households_actual', 'number_of_household_members_actual'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function scenarios()
    {

        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */

    
    public function searchByYearProvinceDistrict($year, $province_id, $district_id) {

        //Needed for a search filter
        if (!empty($district_id) ||
                !empty($province_id) ||
                !empty($year)) {

            if ((!empty($province_id) && empty($district_id)) || !empty($year)) {
                $awpb_template = \backend\models\AwpbTemplate::findOne(['fiscal_year' => $year]);
                $query = AwpbBudget::find()
                        ->where(["awpb_template_id" => $awpb_template->id])
                        ->andWhere(['province_id' => $province_id])
                        ->andWhere(['district_id' => $district_id]);
            }
            if (!empty($district_id)) {
                $query = AwpbBudget::find()
                        ->Where(['province_id' => $province_id])
                        ->andWhere(['district_id' => $district_id]);
            }
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
    
    
    public function search($params)
    {

        $query = AwpbBudget::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'component_id' => $this->component_id,
            'output_id' => $this->output_id,
            'activity_id' => $this->activity_id,
            'awpb_template_id' => $this->awpb_template_id,
            'indicator_id' => $this->indicator_id,
            'unit_cost' => $this->unit_cost,
            'mo_1' => $this->mo_1,
            'mo_2' => $this->mo_2,
            'mo_3' => $this->mo_3,
            'mo_4' => $this->mo_4,
            'mo_5' => $this->mo_5,
            'mo_6' => $this->mo_6,
            'mo_7' => $this->mo_7,
            'mo_8' => $this->mo_8,
            'mo_9' => $this->mo_9,
            'mo_10' => $this->mo_10,
            'mo_11' => $this->mo_11,
            'mo_12' => $this->mo_12,
            'quarter_one_quantity' => $this->quarter_one_quantity,
            'quarter_two_quantity' => $this->quarter_two_quantity,
            'quarter_three_quantity' => $this->quarter_three_quantity,
            'quarter_four_quantity' => $this->quarter_four_quantity,
            'total_quantity' => $this->total_quantity,
            'mo_1_amount' => $this->mo_1_amount,
            'mo_2_amount' => $this->mo_2_amount,
            'mo_3_amount' => $this->mo_3_amount,
            'mo_4_amount' => $this->mo_4_amount,
            'mo_5_amount' => $this->mo_5_amount,
            'mo_6_amount' => $this->mo_6_amount,
            'mo_7_amount' => $this->mo_7_amount,
            'mo_8_amount' => $this->mo_8_amount,
            'mo_9_amount' => $this->mo_9_amount,
            'mo_10_amount' => $this->mo_10_amount,
            'mo_11_amount' => $this->mo_11_amount,
            'mo_12_amount' => $this->mo_12_amount,
            'quarter_one_amount' => $this->quarter_one_amount,
            'quarter_two_amount' => $this->quarter_two_amount,
            'quarter_three_amount' => $this->quarter_three_amount,
            'quarter_four_amount' => $this->quarter_four_amount,
            'total_amount' => $this->total_amount,
            'mo_1_actual' => $this->mo_1_actual,
            'mo_2_actual' => $this->mo_2_actual,
            'mo_3_actual' => $this->mo_3_actual,
            'mo_4_actual' => $this->mo_4_actual,
            'mo_5_actual' => $this->mo_5_actual,
            'mo_6_actual' => $this->mo_6_actual,
            'mo_7_actual' => $this->mo_7_actual,
            'mo_8_actual' => $this->mo_8_actual,
            'mo_9_actual' => $this->mo_9_actual,
            'mo_10_actual' => $this->mo_10_actual,
            'mo_11_actual' => $this->mo_11_actual,
            'mo_12_actual' => $this->mo_12_actual,
            'quarter_one_actual' => $this->quarter_one_actual,
            'quarter_two_actual' => $this->quarter_two_actual,
            'quarter_three_actual' => $this->quarter_three_actual,
            'quarter_four_actual' => $this->quarter_four_actual,
            'status' => $this->status,
            'number_of_females' => $this->number_of_females,
            'number_of_males' => $this->number_of_males,
            'number_of_young_people' => $this->number_of_young_people,
            'number_of_not_young_people' => $this->number_of_not_young_people,
            'number_of_women_headed_households' => $this->number_of_women_headed_households,
            'number_of_non_women_headed_households' => $this->number_of_non_women_headed_households,
            'number_of_household_members' => $this->number_of_household_members,
            'number_of_females_actual' => $this->number_of_females_actual,
            'number_of_males_actual' => $this->number_of_males_actual,
            'number_of_young_people_actual' => $this->number_of_young_people_actual,
            'number_of_not_young_people_actual' => $this->number_of_not_young_people_actual,
            'number_of_women_headed_households_actual' => $this->number_of_women_headed_households_actual,
            'number_of_non_women_headed_households_actual' => $this->number_of_non_women_headed_households_actual,
            'number_of_household_members_actual' => $this->number_of_household_members_actual,
            'camp_id' => $this->camp_id,
            'district_id' => $this->district_id,
            'province_id' => $this->province_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }


    public function searchByYearProvinceDistrict($year, $province_id, $district_id) {

        //Needed for a search filter
        if (!empty($district_id) ||
                !empty($province_id) ||
                !empty($year)) {

            $awpb_template = \backend\models\AwpbTemplate::findOne(['fiscal_year' => $year]);
            $query = AwpbBudget::find()
                    ->where(["awpb_template_id" => $awpb_template->id]);

            if (!empty($province_id) && empty($district_id) && !empty($year)) {
                $awpb_template = \backend\models\AwpbTemplate::findOne(['fiscal_year' => $year]);
                $query = AwpbBudget::find()
                        ->where(["awpb_template_id" => $awpb_template->id])
                        ->andWhere(['province_id' => $province_id])
                        ->andWhere(['district_id' => $district_id]);
            }
            if (!empty($province_id)) {
                $awpb_template = \backend\models\AwpbTemplate::findOne(['fiscal_year' => $year]);
                $query = AwpbBudget::find()
                        ->where(["province_id" => $province_id])
                        ->andWhere(["awpb_template_id" => $awpb_template->id]);
            }
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }


}
