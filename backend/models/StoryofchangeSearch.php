<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Storyofchange;

/**
 * StoryofchangeSearch represents the model behind the search form of `backend\models\Storyofchange`.
 */
class StoryofchangeSearch extends Storyofchange
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'status', 'paio_review_status', 'ikmo_review_status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title', 'interviewee_names', 'interviewer_names', 'date_interviewed', 'introduction', 'challenge', 'actions', 'results', 'conclusions', 'sequel', 'paio_comments', 'ikmo_comments'], 'safe'],
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
        $query = Storyofchange::find();

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
            'category_id' => $this->category_id,
            'date_interviewed' => $this->date_interviewed,
            'status' => $this->status,
            'paio_review_status' => $this->paio_review_status,
            'ikmo_review_status' => $this->ikmo_review_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'interviewee_names', $this->interviewee_names])
            ->andFilterWhere(['like', 'interviewer_names', $this->interviewer_names])
            ->andFilterWhere(['like', 'introduction', $this->introduction])
            ->andFilterWhere(['like', 'challenge', $this->challenge])
            ->andFilterWhere(['like', 'actions', $this->actions])
            ->andFilterWhere(['like', 'results', $this->results])
            ->andFilterWhere(['like', 'conclusions', $this->conclusions])
            ->andFilterWhere(['like', 'sequel', $this->sequel])
            ->andFilterWhere(['like', 'paio_comments', $this->paio_comments])
            ->andFilterWhere(['like', 'ikmo_comments', $this->ikmo_comments]);

        return $dataProvider;
    }
}
