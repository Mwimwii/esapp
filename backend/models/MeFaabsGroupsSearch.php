<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MeFaabsGroups;

/**
 * MeFaabsGroupsSearch represents the model behind the search form of `backend\models\MeFaabsGroups`.
 */
class MeFaabsGroupsSearch extends MeFaabsGroups {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'camp_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'max_farmer_graduation_training_topics'], 'integer'],
            [['name', 'code', 'province_id', 'district_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = MeFaabsGroups::find();

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
            'camp_id' => $this->camp_id,
            'status' => $this->status,
            'max_farmer_graduation_training_topics' => $this->max_farmer_graduation_training_topics,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }

}
