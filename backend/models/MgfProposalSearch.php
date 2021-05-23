<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MgfProposal;
use Yii;
/**
 * MgfProposalSearch represents the model behind the search form of `frontend\models\MgfProposal`.
 */
class MgfProposalSearch extends MgfProposal{
    /**
     * {@inheritdoc}
     */
    public function rules(){
        return [
            [['id', 'organisation_id', 'project_length', 'is_active', 'province_id', 'district_id','number_reviewers'], 'integer'],
            [['project_title', 'mgf_no', 'applicant_type', 'starting_date','ending_date', 'project_operations', 'any_experience', 'experience_response', 'indicate_partnerships', 'proposal_status', 'date_created', 'date_submitted', 'problem_statement', 'overall_objective'], 'safe'],
            [['totalcost'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(){
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
    public function search($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfProposal::find()->where(['province_id'=>$provinceid]);
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfProposal::find()->where(['district_id'=>$districtid]);
        }else if($usertype=="National user") {
            $query = MgfProposal::find()->joinWith('province')->joinWith('district');
        }else if($usertype=="Applicant") {
            $userid=Yii::$app->user->identity->id;
            $applicant = MgfApplicant::find()->where(['user_id'=>$userid])->one();
            $organisationid=$applicant->organisation_id;
            $query = MgfProposal::find()->where(['organisation_id'=>$organisationid]);
        }else{
            $query = MgfProposal::find()->joinWith('province')->joinWith('district');
        }
        //$query = MgfProposal::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['is_active' => SORT_DESC]],
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
            'organisation_id' => $this->organisation_id,
            'starting_date' => $this->starting_date,
            'project_length' => $this->project_length,
            'date_created' => $this->date_created,
            'date_submitted' => $this->date_submitted,
            'is_active' => $this->is_active,
            'totalcost' => $this->totalcost,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
        ]);

        $query->andFilterWhere(['like', 'project_title', $this->project_title])
            ->andFilterWhere(['like', 'mgf_no', $this->mgf_no])
            ->andFilterWhere(['like', 'applicant_type', $this->applicant_type])
            ->andFilterWhere(['like', 'project_operations', $this->project_operations])
            ->andFilterWhere(['like', 'any_experience', $this->any_experience])
            ->andFilterWhere(['like', 'experience_response', $this->experience_response])
            ->andFilterWhere(['like', 'indicate_partnerships', $this->indicate_partnerships])
            ->andFilterWhere(['like', 'proposal_status', $this->proposal_status])
            ->andFilterWhere(['like', 'problem_statement', $this->problem_statement])
            ->andFilterWhere(['like', 'overall_objective', $this->overall_objective]);
        return $dataProvider;
    }

    public function searchProposals($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfProposal::find()->where(['province_id'=>$provinceid])->where(['proposal_status'=>'Submitted','is_active'=>1])->orWhere(['proposal_status'=>'Under_Review','is_active'=>1]);
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfProposal::find()->where(['district_id'=>$districtid])->where(['proposal_status'=>'Submitted','is_active'=>1])->orWhere(['proposal_status'=>'Under_Review','is_active'=>1]);
        }else if($usertype=="National user") {
            $query = MgfProposal::find()->where(['proposal_status'=>'Submitted','is_active'=>1])->orWhere(['proposal_status'=>'Under_Review','is_active'=>1]);
        }else{
            $query = MgfProposal::find()->where(['proposal_status'=>'Submitted','is_active'=>1])->orWhere(['proposal_status'=>'Under_Review','is_active'=>1]);
        }
        //$query = MgfProposal::find();

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
            'organisation_id' => $this->organisation_id,
            'starting_date' => $this->starting_date,
            'project_length' => $this->project_length,
            'date_created' => $this->date_created,
            'date_submitted' => $this->date_submitted,
            'is_active' => $this->is_active,
            'totalcost' => $this->totalcost,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
        ]);

        $query->andFilterWhere(['like', 'project_title', $this->project_title])
            ->andFilterWhere(['like', 'mgf_no', $this->mgf_no])
            ->andFilterWhere(['like', 'applicant_type', $this->applicant_type])
            ->andFilterWhere(['like', 'project_operations', $this->project_operations])
            ->andFilterWhere(['like', 'any_experience', $this->any_experience])
            ->andFilterWhere(['like', 'experience_response', $this->experience_response])
            ->andFilterWhere(['like', 'indicate_partnerships', $this->indicate_partnerships])
            ->andFilterWhere(['like', 'proposal_status', $this->proposal_status])
            ->andFilterWhere(['like', 'problem_statement', $this->problem_statement])
            ->andFilterWhere(['like', 'overall_objective', $this->overall_objective]);
        return $dataProvider;
    }
}
