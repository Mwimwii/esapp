<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfScreening;

/**
 * MgfScreeningSearch represents the model behind the search form of `frontend\models\MgfScreening`.
 */
class MgfScreeningSearch extends MgfScreening{
    /**
     * {@inheritdoc}
     */
    public function rules(){
        return [
            [['id', 'conceptnote_id', 'organisation_id'], 'integer'],
            [['satisfactory',], 'safe'],
            [['criterion', 'approve_submittion', 'verified_by'], 'safe'],
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
        $query = MgfScreening::find();

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
            'conceptnote_id' => $this->conceptnote_id,
            'organisation_id' => $this->organisation_id,
            'satisfactory' => $this->satisfactory,
            'approve_submittion' => $this->approve_submittion,
        ]);

        $query->andFilterWhere(['like', 'criterion', $this->criterion])
            ->andFilterWhere(['like', 'verified_by', $this->verified_by]);

        return $dataProvider;
    }
}
