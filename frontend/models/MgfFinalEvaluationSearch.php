<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfFinalEvaluation;

/**
 * MgfFinalEvaluationSearch represents the model behind the search form of `frontend\models\MgfFinalEvaluation`.
 */
class MgfFinalEvaluationSearch extends MgfFinalEvaluation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proposal_id', 'organisation_id', 'status'], 'integer'],
            [['finalscore', 'decision', 'date_created'], 'safe'],
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
        $query = MgfFinalEvaluation::find();

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
            'proposal_id' => $this->proposal_id,
            'organisation_id' => $this->organisation_id,
            'status' => $this->status,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'finalscore', $this->finalscore])
            ->andFilterWhere(['like', 'decision', $this->decision]);

        return $dataProvider;
    }
}
