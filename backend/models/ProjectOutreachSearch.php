<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProjectOutreach;

/**
 * ProjectOutreachSearch represents the model behind the search form of `backend\models\ProjectOutreach`.
 */
class ProjectOutreachSearch extends ProjectOutreach
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'district_id', 'quarter', 'number_females', 'number_males', 'number_young', 'number_not_young', 
                'number_women_headed_households','number_non_women_headed_households', 'number_households', 
                'number_household_members', 'created_at', 'updated_at', 
                'created_by', 'updated_by'], 'integer'],
            [['component', 'sub_component', 'year'], 'safe'],
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
        $query = ProjectOutreach::find();

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
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'quarter' => $this->quarter,
            'number_females' => $this->number_females,
            'number_males' => $this->number_males,
            'number_young' => $this->number_young,
            'number_not_young' => $this->number_not_young,
            'number_women_headed_households' => $this->number_women_headed_households,
            'number_non_women_headed_households' => $this->number_non_women_headed_households,
            'number_households' => $this->number_households,
            'number_household_members' => $this->number_household_members,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'component', $this->component])
            ->andFilterWhere(['like', 'sub_component', $this->sub_component])
            ->andFilterWhere(['like', 'year', $this->year]);

        return $dataProvider;
    }
}
