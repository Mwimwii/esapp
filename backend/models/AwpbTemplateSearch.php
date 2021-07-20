<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbTemplate;

/**
 * AwpbTemplateSearch represents the model behind the search form of `backend\models\AwpbTemplate`.
 */
class AwpbTemplateSearch extends AwpbTemplate
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fiscal_year', 'status', 'quarter','status_activities', 'status_users', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['budget_theme', 'comment', 'guideline_file', 'preparation_deadline_first_draft', 'submission_deadline', 'consolidation_deadline', 'review_deadline', 'preparation_deadline_second_draft', 'review_deadline_pco', 'finalisation_deadline_pco', 'submission_deadline_moa_mfl', 'approval_deadline_jpsc', 'incorpation_deadline_pco_moa_mfl', 'submission_deadline_ifad','comment_deadline_ifad','distribution_deadline'], 'safe'],
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
        $query = AwpbTemplate::find();

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
            'fiscal_year' => $this->fiscal_year,
            'status' => $this->status,
             'quarter' => $this->quarter,
            'status_activities' => $this->status_activities,
            'status_users' => $this->status_users,
            'preparation_deadline_first_draft' => $this->preparation_deadline_first_draft,
            'submission_deadline' => $this->submission_deadline,
            'consolidation_deadline' => $this->consolidation_deadline,
            'review_deadline' => $this->review_deadline,
            'preparation_deadline_second_draft' => $this->preparation_deadline_second_draft,
            'review_deadline_pco' => $this->review_deadline_pco,
            'finalisation_deadline_pco' => $this->finalisation_deadline_pco,
            'submission_deadline_moa_mfl' => $this->submission_deadline_moa_mfl,
            'approval_deadline_jpsc' => $this->approval_deadline_jpsc,
            'incorpation_deadline_pco_moa_mfl' => $this->incorpation_deadline_pco_moa_mfl,
            'submission_deadline_ifad' => $this->submission_deadline_ifad,
            'comment_deadline_ifad'=>$this->comment_deadline_ifad,
            'distribution_deadline'=>$this->distribution_deadline,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'budget_theme', $this->budget_theme])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'guideline_file', $this->guideline_file]);

        return $dataProvider;
    }
}
