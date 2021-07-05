<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MeFaabsCategoryAFarmers;

/**
 * MeFaabsCategoryAFarmersSearch represents the model behind the search form of `backend\models\MeFaabsCategoryAFarmers`.
 */
class MeFaabsCategoryAFarmersSearch extends MeFaabsCategoryAFarmers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'faabs_group_id', 'status', 'household_size', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title','first_name', 'other_names', 'last_name', 'sex', 'dob', 'nrc',
                'marital_status', 'contact_number', 'relationship_to_household_head',
                'registration_date', 'village', 'chiefdom', 'block', 'zone', 'commodity','province_id', 'district_id', 'camp_id'], 'safe'],
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
        $query = MeFaabsCategoryAFarmers::find();

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
            'faabs_group_id' => $this->faabs_group_id,
            'dob' => $this->dob,
            'registration_date' => $this->registration_date,
            'status' => $this->status,
            'household_size' => $this->household_size,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'other_names', $this->other_names])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'nrc', $this->nrc])
            ->andFilterWhere(['like', 'marital_status', $this->marital_status])
            ->andFilterWhere(['like', 'contact_number', $this->contact_number])
            ->andFilterWhere(['like', 'relationship_to_household_head', $this->relationship_to_household_head])
            ->andFilterWhere(['like', 'village', $this->village])
            ->andFilterWhere(['like', 'chiefdom', $this->chiefdom])
            ->andFilterWhere(['like', 'block', $this->block])
            ->andFilterWhere(['like', 'zone', $this->zone])
            ->andFilterWhere(['like', 'commodity', $this->commodity]);

        return $dataProvider;
    }
}
