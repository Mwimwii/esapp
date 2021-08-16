<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfVariableFixedCostTotals;

/**
 * MgfVariableFixedCostTotalsSearch represents the model behind the search form of `frontend\models\MgfVariableFixedCostTotals`.
 */
class MgfVariableFixedCostTotalsSearch extends MgfVariableFixedCostTotals
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['total_yr1_value', 'total_yr2_value', 'total_yr3_value', 'total_yr4_value'], 'number'],
            [['date_created', 'date_update'], 'safe'],
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
        $query = MgfVariableFixedCostTotals::find();

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
            'total_yr1_value' => $this->total_yr1_value,
            'total_yr2_value' => $this->total_yr2_value,
            'total_yr3_value' => $this->total_yr3_value,
            'total_yr4_value' => $this->total_yr4_value,
            'proposal_id' => $this->proposal_id,
            'date_created' => $this->date_created,
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
