<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MeFaabsTrainingTopics;

/**
 * MeFaabsTrainingTopicsSearch represents the model behind the search form of `backend\models\MeFaabsTrainingTopics`.
 */
class MeFaabsTrainingTopicsSearch extends MeFaabsTrainingTopics
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['topic', 'output_level_indicator', 'category','subcomponent'], 'safe'],
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
        $query = MeFaabsTrainingTopics::find();

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
        ]);

        $query->andFilterWhere(['like', 'topic', $this->topic])
            ->andFilterWhere(['like', 'output_level_indicator', $this->output_level_indicator])
            ->andFilterWhere(['like', 'subcomponent', $this->subcomponent])
            ->andFilterWhere(['like', 'category', $this->category]);

        return $dataProvider;
    }
}
