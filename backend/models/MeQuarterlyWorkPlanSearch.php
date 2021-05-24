<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MeQuarterlyWorkPlan;

/**
 * MeQuarterlyWorkPlanSearch represents the model behind the search form of `backend\models\MeQuarterlyWorkPlan`.
 */
class MeQuarterlyWorkPlanSearch extends MeQuarterlyWorkPlan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'activity_id', 'province_id', 'district_id', 'month', 'status', 'district_approval_status', 'provincial_approval_status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['quarter', 'year', 'Remarks', 'esapp_comments'], 'safe'],
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
        $query = MeQuarterlyWorkPlan::find();

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
            'activity_id' => $this->activity_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'month' => $this->month,
            'status' => $this->status,
            'district_approval_status' => $this->district_approval_status,
            'provincial_approval_status' => $this->provincial_approval_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'quarter', $this->quarter])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'Remarks', $this->Remarks])
            ->andFilterWhere(['like', 'esapp_comments', $this->esapp_comments]);

        return $dataProvider;
    }
}
