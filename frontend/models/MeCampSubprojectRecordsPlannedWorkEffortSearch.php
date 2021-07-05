<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MeCampSubprojectRecordsPlannedWorkEffort;

/**
 * MeCampSubprojectRecordsPlannedWorkEffortSearch represents the model behind the search form of `backend\models\MeCampSubprojectRecordsPlannedWorkEffort`.
 */
class MeCampSubprojectRecordsPlannedWorkEffortSearch extends MeCampSubprojectRecordsPlannedWorkEffort
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'camp_id', 'year', 'days_in_month', 'days_field', 'days_office', 'days_total', 'days_other_non_esapp_activities', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['month'], 'safe'],
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
        $query = MeCampSubprojectRecordsPlannedWorkEffort::find();

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
            'camp_id' => $this->camp_id,
            'year' => $this->year,
            'days_in_month' => $this->days_in_month,
            'days_field' => $this->days_field,
            'days_office' => $this->days_office,
            'days_total' => $this->days_total,
            'days_other_non_esapp_activities' => $this->days_other_non_esapp_activities,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'month', $this->month]);

        return $dataProvider;
    }
}
