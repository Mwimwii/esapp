<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MgfProjectEvaluation;

/**
 * MgfProjectEvaluationSearch represents the model behind the search form of `frontend\models\MgfProjectEvaluation`.
 */
class MgfProjectEvaluationSearch extends MgfProjectEvaluation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proposal_id', 'organisation_id', 'status'], 'integer'],
            [['window', 'observation', 'declaration', 'totalscore', 'decision', 'date_created', 'date_submitted', 'date_reviewed', 'reviewedby', 'signature'], 'safe'],
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
        $query = MgfProjectEvaluation::find();

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
            'date_submitted' => $this->date_submitted,
            'date_reviewed' => $this->date_reviewed,
        ]);

        $query->andFilterWhere(['like', 'window', $this->window])
            ->andFilterWhere(['like', 'observation', $this->observation])
            ->andFilterWhere(['like', 'declaration', $this->declaration])
            ->andFilterWhere(['like', 'totalscore', $this->totalscore])
            ->andFilterWhere(['like', 'decision', $this->decision])
            ->andFilterWhere(['like', 'reviewedby', $this->reviewedby])
            ->andFilterWhere(['like', 'signature', $this->signature]);

        return $dataProvider;
    }
}
