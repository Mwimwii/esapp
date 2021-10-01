<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\Models\AwpbFundsRequisition;

/**
 * AwpbActualInputSearch represents the model behind the search form of `backend\Models\AwpbActualInput`.
 */
class AwpbFundsRequisitionSearch extends AwpbFundsRequisition
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'component_id',  'activity_id', 'awpb_template_id',  'budget_id', 'input_id', 'quarter_number', 'unit_of_measure_id', 'status', 'cost_centre_id', 'camp_id', 'district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'safe'],
            [['unit_cost', 'mo_1', 'mo_2', 'mo_3', 'quarter_quantity', 'quarter_amount', 'mo_1_amount', 'mo_2_amount', 'mo_3_amount', 'mo_1_actual', 'mo_2_actual', 'mo_3_actual'], 'number'],
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
    public function search($params)
    {
        $query = AwpbFundsRequisition::find();

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
           
            'budget_id' => $this->budget_id,
            'input_id' => $this->input_id,
            'quarter_number' => $this->quarter_number,
            'unit_of_measure_id' => $this->unit_of_measure_id,
            'unit_cost' => $this->unit_cost,
            'mo_1' => $this->mo_1,
            'mo_2' => $this->mo_2,
            'mo_3' => $this->mo_3,
            'quarter_quantity' => $this->quarter_quantity,
            'quarter_amount' => $this->quarter_amount,
            'mo_1_amount' => $this->mo_1_amount,
            'mo_2_amount' => $this->mo_2_amount,
            'mo_3_amount' => $this->mo_3_amount,
            'mo_1_actual' => $this->mo_1_actual,
            'mo_2_actual' => $this->mo_2_actual,
            'mo_3_actual' => $this->mo_3_actual,
            'status' => $this->status,
            'cost_centre_id' => $this->cost_centre_id,
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
}
