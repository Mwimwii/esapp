<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MgfApproval;

/**
 * MgfApprovalSearch represents the model behind the search form of `frontend\models\MgfApproval`.
 */
class MgfApprovalSearch extends MgfApproval{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'application_id', 'conceptnote_id'], 'integer'],
            [['scores', 'review_remark', 'review_submission', 'reviewed_by', 
            'certify_remark', 'certify_submission', 'certified_by', 'district_minutes', 
            'province_minutes', 'pco_minutes', 'approval_remark', 'approve_submittion', 'approved_by'], 'safe'],
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
        $query = MgfApproval::find();

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
            'application_id' => $this->application_id,
            'conceptnote_id' => $this->conceptnote_id,
            'review_submission' => $this->review_submission,
            'certify_submission' => $this->certify_submission,
            'approve_submittion' => $this->approve_submittion,
        ]);

       




        $query->andFilterWhere(['like', 'scores', $this->scores])
            ->andFilterWhere(['like', 'review_remark', $this->review_remark])
            ->andFilterWhere(['like', 'reviewed_by', $this->reviewed_by])
            ->andFilterWhere(['like', 'certify_remark', $this->certify_remark])
            ->andFilterWhere(['like', 'certified_by', $this->certified_by])
            ->andFilterWhere(['like', 'district_minutes', $this->district_minutes])
            ->andFilterWhere(['like', 'province_minutes', $this->province_minutes])
            ->andFilterWhere(['like', 'pco_minutes', $this->pco_minutes])
            ->andFilterWhere(['like', 'approval_remark', $this->approval_remark])
            ->andFilterWhere(['like', 'approved_by', $this->approved_by]);

        return $dataProvider;
    }
}
