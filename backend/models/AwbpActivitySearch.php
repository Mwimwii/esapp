<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbActivity;

/**
 * AwbpActivitySearch represents the model behind the search form of `backend\models\AwpbActivity`.
 */
class AwbpActivitySearch extends AwpbActivity
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_activity_id', 'component_id', 'awpb_template_id', 'funder_id','unit_of_measure_id', 'expense_category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['activity_code', 'description','gl_account_code'], 'safe'],
             [['year','district_id', 'province_id'], 'safe'],
            [['programme_target','quarter_one_budget', 'quarter_two_budget', 'quarter_three_budget', 'quarter_four_budget', 'total_budget'], 'number'],
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
            'awpb_template_id' => $this->awpb_template_id,
            'unit_of_measure_id' => $this->unit_of_measure_id,
            'quarter_one_budget' => $this->quarter_one_budget,
            'quarter_two_budget' => $this->quarter_two_budget,
            'quarter_three_budget' => $this->quarter_three_budget,
            'quarter_four_budget' => $this->quarter_four_budget,
            'total_budget' => $this->total_budget,
            'funder_id' => $this->funder_id,
            'programme_target'=>$this->programme_target,
            'expense_category_id' => $this->expense_category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'activity_code', $this->activity_code])
        ->andFilterWhere(['like', 'gl_account_code', $this->gl_account_code])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
