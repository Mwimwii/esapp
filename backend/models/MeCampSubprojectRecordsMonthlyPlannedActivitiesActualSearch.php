<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual;

/**
 * MeCampSubprojectRecordsMonthlyPlannedActivitiesActualSearch represents the model behind the search form of `backend\models\MeCampSubprojectRecordsMonthlyPlannedActivitiesActual`.
 */
class MeCampSubprojectRecordsMonthlyPlannedActivitiesActualSearch extends MeCampSubprojectRecordsMonthlyPlannedActivitiesActual
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'planned_activity_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['hours_worked_field', 'hours_worked_office', 'hours_worked_total', 'achieved_activity_target', 'beneficiary_target_achieved_total', 'beneficiary_target_achieved_women', 'beneficiary_target_achieved_youth', 'beneficiary_target_achieved_women_headed', 'remarks', 'year', 'month'], 'safe'],
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
        $query = MeCampSubprojectRecordsMonthlyPlannedActivitiesActual::find();

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
            'planned_activity_id' => $this->planned_activity_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'hours_worked_field', $this->hours_worked_field])
            ->andFilterWhere(['like', 'hours_worked_office', $this->hours_worked_office])
            ->andFilterWhere(['like', 'hours_worked_total', $this->hours_worked_total])
            ->andFilterWhere(['like', 'achieved_activity_target', $this->achieved_activity_target])
            ->andFilterWhere(['like', 'beneficiary_target_achieved_total', $this->beneficiary_target_achieved_total])
            ->andFilterWhere(['like', 'beneficiary_target_achieved_women', $this->beneficiary_target_achieved_women])
            ->andFilterWhere(['like', 'beneficiary_target_achieved_youth', $this->beneficiary_target_achieved_youth])
            ->andFilterWhere(['like', 'beneficiary_target_achieved_women_headed', $this->beneficiary_target_achieved_women_headed])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'month', $this->month]);

        return $dataProvider;
    }
}
