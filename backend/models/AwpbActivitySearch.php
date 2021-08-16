<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbActivity;

/**
 * AwpbActivitySearch represents the model behind the search form of `app\models\AwpbActivity`.
 */
class AwpbActivitySearch extends AwpbActivity
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_activity_id','indicator_id', 'component_id', 'unit_of_measure_id', 'expense_category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['activity_code', 'description'], 'safe'],
            [['quarter_one_budget', 'quarter_two_budget', 'quarter_three_budget', 'quarter_four_budget', 'total_budget'], 'number'],
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
        $query = AwpbActivity::find();

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
            'parent_activity_id' => $this->parent_activity_id,
            'component_id' => $this->component_id,
            'indicator_id'=>$this->indicator_id,
            'unit_of_measure_id' => $this->unit_of_measure_id,
            'quarter_one_budget' => $this->quarter_one_budget,
            'quarter_two_budget' => $this->quarter_two_budget,
            'quarter_three_budget' => $this->quarter_three_budget,
            'quarter_four_budget' => $this->quarter_four_budget,
            'total_budget' => $this->total_budget,
            'expense_category_id' => $this->expense_category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'activity_code', $this->activity_code])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
