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
            [['id', 'activity_id', 'status', 'district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'safe'],
            [['unit_cost', 'mo_1', 'mo_2', 'mo_3', 'mo_4', 'mo_5', 'mo_6', 'mo_7', 'mo_8', 'mo_9', 'mo_10', 'mo_11', 'mo_12', 'quarter_one_quantity', 'quarter_two_quantity', 'quarter_three_quantity', 'quarter_four_quantity', 'total_quantity', 'total_amount'], 'number'],
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
            'total_amount' => $this->total_amount,
            'status' => $this->status,
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
