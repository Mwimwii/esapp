<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MeBackToOfficeReport;

/**
 * MeBackToOfficeReportSearch represents the model behind the search form of `backend\models\MeBackToOfficeReport`.
 */
class MeBackToOfficeReportSearch extends MeBackToOfficeReport
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'created_by', 'updated_by','status'], 'integer'],
            [['start_date', 'end_date', 'name_of_officer', 'team_members', 'key_partners', 'purpose_of_assignment', 'summary_of_assignment_outcomes', 'key_findings', 'key_recommendations', 'copy_sent_to', 'annexes'], 'safe'],
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
        $query = MeBackToOfficeReport::find();

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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name_of_officer', $this->name_of_officer])
            ->andFilterWhere(['like', 'team_members', $this->team_members])
            ->andFilterWhere(['like', 'key_partners', $this->key_partners])
            ->andFilterWhere(['like', 'purpose_of_assignment', $this->purpose_of_assignment])
            ->andFilterWhere(['like', 'summary_of_assignment_outcomes', $this->summary_of_assignment_outcomes])
            ->andFilterWhere(['like', 'key_findings', $this->key_findings])
            ->andFilterWhere(['like', 'key_recommendations', $this->key_recommendations])
            ->andFilterWhere(['like', 'copy_sent_to', $this->copy_sent_to])
            ->andFilterWhere(['like', 'annexes', $this->annexes]);

        return $dataProvider;
    }
}
