<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfInputCost;

/**
 * MgfInputCostSearch represents the model behind the search form of `frontend\models\MgfInputCost`.
 */
class MgfInputCostSearch extends MgfInputCost
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'item_no', 'activity_id', 'createdby'], 'integer'],
            [['input_name'], 'string'],
            [['unit_cost', 'total_cost','project_year_1', 'project_year_2', 'project_year_3', 'project_year_4','project_year_5', 'project_year_6', 'project_year_7', 'project_year_8'], 'number'],
            [['comment', 'date_created'], 'safe'],
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
        $query = MgfInputCost::find();

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
            'item_no' => $this->item_no,
            'input_name' => $this->input_name,
            'unit_cost' => $this->unit_cost,
            'project_year_1' => $this->project_year_1,
            'project_year_2' => $this->project_year_2,
            'project_year_3' => $this->project_year_3,
            'project_year_4' => $this->project_year_4,
            'project_year_5' => $this->project_year_5,
            'project_year_6' => $this->project_year_6,
            'project_year_7' => $this->project_year_7,
            'project_year_8' => $this->project_year_8,
            'total_cost' => $this->total_cost,
            'activity_id' => $this->activity_id,
            'date_created' => $this->date_created,
            'createdby' => $this->createdby,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
