<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities;

/**
 * MeCampSubprojectRecordsMonthlyPlannedActivitiesSearch represents the model behind the search form of `backend\models\MeCampSubprojectRecordsMonthlyPlannedActivities`.
 */
class MeCampSubprojectRecordsMonthlyPlannedActivitiesSearch extends MeCampSubprojectRecordsMonthlyPlannedActivities {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'work_effort_id', 'activity_id', 'faabs_id', 'beneficiary_target_total', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['zone', 'activity_target', 'beneficiary_target_women', 'beneficiary_target_youth', 'beneficiary_target_women_headed'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = MeCampSubprojectRecordsMonthlyPlannedActivities::find();

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
            // 'camp_id' => $this->camp_id,
            'activity_id' => $this->activity_id,
            'faabs_id' => $this->faabs_id,
            'beneficiary_target_total' => $this->beneficiary_target_total,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'zone', $this->zone])
                ->andFilterWhere(['like', 'activity_target', $this->activity_target])
                ->andFilterWhere(['like', 'beneficiary_target_women', $this->beneficiary_target_women])
                ->andFilterWhere(['like', 'beneficiary_target_youth', $this->beneficiary_target_youth])
                ->andFilterWhere(['like', 'beneficiary_target_women_headed', $this->beneficiary_target_women_headed]);

        return $dataProvider;
    }

}
