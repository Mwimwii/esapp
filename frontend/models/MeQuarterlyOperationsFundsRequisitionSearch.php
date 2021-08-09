<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MeQuarterlyOperationsFundsRequisition;

/**
 * MeQuarterlyOperationsFundsRequisitionSearch represents the model behind the search form of `backend\models\MeQuarterlyOperationsFundsRequisition`.
 */
class MeQuarterlyOperationsFundsRequisitionSearch extends MeQuarterlyOperationsFundsRequisition
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quarter_workplan_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['budget_estimate_month_1', 'budget_estimate_month_2', 'budget_estimate_month_3'], 'safe'],
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
        $query = MeQuarterlyOperationsFundsRequisition::find();

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
            'quarter_workplan_id' => $this->quarter_workplan_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'budget_estimate_month_1', $this->budget_estimate_month_1])
            ->andFilterWhere(['like', 'budget_estimate_month_2', $this->budget_estimate_month_2])
            ->andFilterWhere(['like', 'budget_estimate_month_3', $this->budget_estimate_month_3]);

        return $dataProvider;
    }
}
