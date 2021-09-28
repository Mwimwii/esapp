<?php

namespace frontend\models;
use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfCostsFinancingPlan;

/**
 * MgfCostsFinancingPlanSearch represents the model behind the search form of `frontend\models\MgfCostsFinancingPlan`.
 */
class MgfCostsFinancingPlanSearch extends MgfCostsFinancingPlan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'componentid', 'activityid','item_no','created_by', 'updated_by'], 'integer'],
            [['input_name', 'date_created', 'date_update'], 'safe'],
            [['total_Project_cost', 'Applicant_in_kind', 'Applicant_in_cash', 'total_contribution', 'mgf_grant', 'other_sources', 'total', 'mgf_as_percent'], 'number'],
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
       // $query = MgfCostsFinancingPlan::find();
       $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfCostsFinancingPlan::find()->where(['proposal_id'=>$proposal->id]);
        //$query = MgfImplementationSchedule::find();

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
            'componentid' => $this->componentid,
            'activityid' => $this->activityid,
            'total_Project_cost' => $this->total_Project_cost,
            'Applicant_in_kind' => $this->Applicant_in_kind,
            'Applicant_in_cash' => $this->Applicant_in_cash,
            'total_contribution' => $this->total_contribution,
            'mgf_grant' => $this->mgf_grant,
            'other_sources' => $this->other_sources,
            'total' => $this->total,
            'mgf_as_percent' => $this->mgf_as_percent,
            'date_created' => $this->date_created,
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'input_name', $this->input_name]);

        return $dataProvider;
    }
}
