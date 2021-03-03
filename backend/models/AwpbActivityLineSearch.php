<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbActivityLine;

/**
 * AwpbActivityLineSearch represents the model behind the search form of `backend\models\AwpbActivityLine`.
 */
class AwpbActivityLineSearch extends AwpbActivityLine
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'activity_id',  'unit_of_measure_id', 'district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'safe'],
            [['unit_cost', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_quantity'], 'number'],
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
        $query = AwpbActivityLine::find();

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
            'activity_id' => $this->activity_id,
            'unit_of_measure_id' => $this->unit_of_measure_id,
            'unit_cost' => $this->unit_cost,
            'quarter_one_quantity' => $this->quarter_one_quantity,
            'quarter_two_quantity' => $this->quarter_two_quantity,
            'quarter_three_quantity' => $this->quarter_three_quantity,
            'quarter_four_quantity' => $this->quarter_four_quantity,
            'total_quantity' => $this->total_quantity,
            'district_id' => $this->district_id,
            'province_id' => $this->province_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name ]);

        return $dataProvider;
    }
}
