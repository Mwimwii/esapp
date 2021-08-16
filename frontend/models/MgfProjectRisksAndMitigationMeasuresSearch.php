<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfProjectRisksAndMitigationMeasures;

/**
 * MgfProjectRisksAndMitigationMeasuresSearch represents the model behind the search form of `frontend\models\MgfProjectRisksAndMitigationMeasures`.
 */
class MgfProjectRisksAndMitigationMeasuresSearch extends MgfProjectRisksAndMitigationMeasures
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['expected_risks', 'consequences_of_risk', 'mitigation_measures_planned', 'date_created', 'date_update'], 'safe'],
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
        $query = MgfProjectRisksAndMitigationMeasures::find();

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
            'date_created' => $this->date_created,
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'expected_risks', $this->expected_risks])
            ->andFilterWhere(['like', 'consequences_of_risk', $this->consequences_of_risk])
            ->andFilterWhere(['like', 'mitigation_measures_planned', $this->mitigation_measures_planned]);

        return $dataProvider;
    }
}
