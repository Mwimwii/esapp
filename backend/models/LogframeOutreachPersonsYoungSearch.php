<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LogframeOutreachPersonsYoung;

/**
 * LogframeOutreachPersonsYoungSearch represents the model behind the search form of `backend\models\LogframeOutreachPersonsYoung`.
 */
class LogframeOutreachPersonsYoungSearch extends LogframeOutreachPersonsYoung
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['year', 'indicator',  'yr_target', 'yr_results', 'young_not_young', 'cumulative', 'cumulative_percentage'], 'safe'],
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
        $query = LogframeOutreachPersonsYoung::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'young_not_young' => $this->young_not_young,
        ]);

        $query->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'indicator', $this->indicator])
            ->andFilterWhere(['like', 'yr_target', $this->yr_target])
            ->andFilterWhere(['like', 'yr_results', $this->yr_results])
           // ->andFilterWhere(['like', 'young_not_young', $this->young_not_young])
            ->andFilterWhere(['like', 'cumulative', $this->cumulative])
            ->andFilterWhere(['like', 'cumulative_percentage', $this->cumulative_percentage]);

        return $dataProvider;
    }
}
